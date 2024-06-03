<?php

namespace App\Http\Controllers\Web;

use App\Enums\SocialiteLoginType;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Enums\VerificationType;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ThrottleLogin;
use App\Http\Requests\Web\AuthRequest;
use App\Mail\SendOtp;
use App\Models\Otp;
use App\Models\User;
use App\Services\AccessControlService;
use App\Services\MailService;
use Exception;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Laravel\Socialite\Facades\Socialite;
use Laraverse\Atlas\Client;

class AuthController extends Controller
{
    public $accessControl;

    public $mail;

    public function __construct(AccessControlService $accessControl, MailService $mail)
    {
        $this->accessControl = $accessControl;

        $this->mail = $mail;
    }

    public function loginView(): View
    {
        return view('pages.auth.login');
    }

    public function login(AuthRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        $throttle = app(ThrottleLogin::class);

        if (Cache::has('login_attempts_' . $request->email) && Cache::get('login_attempts_' . $request->email) >= 3) {

            $remainingLockoutTime = Cache::get('login_attempts_' . $request->email . '_time') - time();

            $key = 'lockout_activity_logged';

            if (! Cache::has($key)) {

                event(new Lockout($request));

                Cache::put($key, 1, 120);

            }

            $message = 'Too many login attempts. Please try again in ' . ceil($remainingLockoutTime / 60) . ' minutes.';

            return redirect("login")->withErrors([ 'email-or-password' => $message ]);

        }

        $socialUser = User::query()

            ->where('email', $request->email)

            ->whereNull('password')

            ->where(function (Builder $query) {

                $query->whereNotNull('google_auth_id')->orWhereNotNull('facebook_auth_id');

            })

            ->exists();

        if ($socialUser) {

            $message = 'It looks like you previously used social login. Please log in using your social account.';

            return redirect("login")->withErrors([ 'email-or-password' => $message ]);

        }

        if (Auth::attempt($credentials, $request->remember ?? false)) {

            if (Auth::user()->status === UserStatus::DEACTIVE) {

                $throttle->clearAttempts($request->email);

                $this->logout($request);

                return redirect("login")->withErrors(['email-or-password' => 'Your account is deactivated, Contact administrator to activate account.']);

            }

            if (Auth::user()->status === UserStatus::SUSPENDED) {

                $throttle->clearAttempts($request->email);

                $this->logout($request);

                return redirect("login")->withErrors(['email-or-password' => 'Your account is suspended from the system.']);

            }

            $throttle->clearAttempts($request->email);

            return redirect()->intended('dashboard')->withSuccess('Logged in successfully.');

        }

        $throttle->incrementAttempts($request->email);

        return redirect("login")->withErrors(['email-or-password' => 'Email or password is incorrect.']);
    }

    public function registerView(): View
    {
        return view('pages.auth.register');
    }

    public function register(AuthRequest $request): RedirectResponse
    {
        $user = User::create([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'status' => UserStatus::PENDING

        ]);

        $this->accessControl->assignUserRoleWithPermissions($user, UserRole::USER->value);

        event(new Registered($user));

        Auth::login($user);

        $this->sendOtp();

        return redirect()->intended('verify')->withSuccess('Registered successfully.');
    }

    public function verifyView(): View
    {
        return view('pages.auth.verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $otp = implode('', $request->digits);

        $user = Auth::user();

        $latestOtp = $user->otp;

        if ($latestOtp && $otp && (intval( $latestOtp->otp ) === intval( $otp ))) {

            if ($latestOtp->created_at->diffInMinutes(now()) <= 10) {

                tap($user)->update([ 'email_verified_at' => now(), 'status' => UserStatus::ACTIVE ]);

                event(new Verified($user));

                $latestOtp->delete();

                return redirect()->intended('dashboard')->withSuccess('Logged in successfully.');

            } else {

                return redirect("verify")->withErrors([ 'verify' => 'The OTP has expired. Please regenerate a new OTP.' ]);

            }
        }

        return redirect("verify")->withErrors(['verify' => 'Please provide valid OTP.']);
    }

    public function reverify(): RedirectResponse
    {
        return $this->resendOtp();
    }

    public function resendOtp(): RedirectResponse
    {
        $user = Auth::user();

        $recent = $user->recentOtp;

        if ( $recent ) {

            return redirect("verify")->withSuccess('An OTP has been already resent to your email.');

        }

        $this->sendOtp();

        return redirect("verify")->withSuccess('An OTP has been resent to your email.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login')->withSuccess('Logged out successfully.');
    }

    public function socialiteRedirect(string $provider): mixed
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialiteCallback(string $provider): mixed
    {
        try {
            $socialiteAuthUser = Socialite::driver($provider)->user();

            $column = $this->columnBasedOnProvider($provider);

            $user = User::where($column, $socialiteAuthUser->id)->first();

            if ($user) {

                Auth::login($user);

                return redirect()->intended('dashboard')->withSuccess('Logged in successfully.');

            }

            [$firstName, $lastName] = explode(' ', $socialiteAuthUser->name);

            $newUser = User::updateOrCreate(
                [
                    'email' => $socialiteAuthUser->email,
                ], [
                    $column => $socialiteAuthUser->id,

                    'first_name' => $firstName,

                    'last_name' => $lastName,

                    'email_verified_at' => now(),

                    'status' => UserStatus::ACTIVE
                ]
            );

            $this->accessControl->assignUserRoleWithPermissions($newUser, UserRole::USER->value);

            Auth::login($newUser);

            return redirect()->intended('dashboard')->withSuccess('Logged in successfully.');


        } catch (Exception $e) {

            Log::error($e->getMessage());

            $message = 'Something went wrong.';

            return redirect("login")->withErrors([ 'email-or-password' => $message ]);

        }
    }

    public function resetPasswordView(): View
    {
        return view('pages.auth.send-reset-password-otp');
    }

    public function resetPassword(AuthRequest $request): RedirectResponse
    {

        $email = $request->email;

        $newPassword = $request->password;

        $user = User::where('email', $email)->first();

        $user->password = Hash::make($newPassword);

        $user->save();

        return redirect("login")->withSuccess('Password changed successfully.');

    }

    public function sendResetPasswordOtp(AuthRequest $request): View|RedirectResponse
    {
        $socialUser = User::query()

            ->where('email', $request->email)

            ->whereNull('password')

            ->where(function (Builder $query) {

                $query->whereNotNull('google_auth_id')->orWhereNotNull('facebook_auth_id');

            })

            ->exists();

        if ($socialUser) {

            $message = 'It looks like you previously used social login. You can\'t reset the password.';

            return redirect("reset-password")->withErrors([ 'email-or-password' => $message ]);

        }

        $user = User::query()->where('email', $request->email)->first();

        $this->sendOtp( user: $user );

        return view('pages.auth.verify', [ 'route' => route('verify:reset-password-otp'), 'user' => $user ]);
    }

    public function verifyResetPasswordOtp(AuthRequest $request): View|RedirectResponse
    {
        $otp = implode('', $request->digits);

        $user = User::query()->where('email', $request->email)->first();

        $latestOtp = $user->otp;

        $messageBag = new MessageBag();

        if ($latestOtp && $otp && (intval( $latestOtp->otp ) === intval( $otp ))) {

            if ($latestOtp->created_at->diffInMinutes(now()) <= 10) {

                $latestOtp->delete();

                Session::flash('success', 'OTP verification successful.');

                return view('pages.auth.reset-password', [ 'user' => $user ]);

            } else {

                $errorMessage = 'The OTP has expired. Please regenerate a new OTP.';

                $messageBag->add('verify', $errorMessage);

                return view('pages.auth.verify', [ 'route' => route('verify:reset-password-otp'), 'user' => $user, 'messageBag' => $messageBag ]);

            }
        }

        $errorMessage = 'Please provide valid OTP.';

        $messageBag->add('verify', $errorMessage);

        return view('pages.auth.verify', [ 'route' => route('verify:reset-password-otp'), 'user' => $user, 'messageBag' => $messageBag ]);
    }

    public function profileView(): View
    {
        $client = new Client();

        $countryCodes = $client->getCountries()->pluck('phone_code', 'name')->toArray();

        return view('pages.auth.profile', compact('countryCodes'));
    }

    public function profile(AuthRequest $request): RedirectResponse
    {
        $user = Auth::user();

        tap($user)->update([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'phone_number' => $request->phone_number,

            'phone_number_country_code' => $request->phone_number_country_code,

        ]);

        return redirect("profile")->withSuccess('Profile updated successfully.');
    }

    public function changePasswordView(): View
    {
        return view('pages.auth.change-password');
    }

    public function changePassword(AuthRequest $request): RedirectResponse
    {

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {

            return redirect()->back()->withErrors(['change-password' => 'Please provide the correct old password.']);

        }

        if ($request->new_password === $request->old_password) {

            return redirect()->back()->withErrors(['change-password' => 'New password and old password cannot be the same.']);

        }

        tap($user)->update([ 'password' => Hash::make($request->new_password) ]);

        return redirect('change-password')->withSuccess('Password changed successfully.');

    }

    private function sendOtp(

        ?VerificationType $type = VerificationType::EMAIL_VERIFICATION,

        ?User $user = null

    ): void
    {
        $user = ! is_null($user) ? $user : Auth::user();

        $otp = generateOtp();

        Otp::create([

            'type' => $type,

            'otp' => $otp,

            'model_type' => User::class,

            'model_id' => $user->id,

        ]);

        $this->mail->send( $user->email, ['otp' => $otp], SendOtp::class );
    }

    private function columnBasedOnProvider(string $provider): string
    {
        $column = 'google_auth_id';

        if ($provider == SocialiteLoginType::FACEBOOK->value) {

            $column = 'facebook_auth_id';

        }

        return $column;
    }
}
