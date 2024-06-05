<?php

namespace App\Http\Controllers\Web;

use App\Enums\StripeProductType;
use App\Enums\TransactionType;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Services\StripeService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public $service;

    public function __construct(StripeService $service)
    {
        $this->service = $service;
    }

    public function view(): View
    {
        $user = Auth::user();

        if (! ($user->roles->first()->name === UserRole::ADMIN->value)) {

            if ($user->subscribed()) {

                $plan = $this->service->currentPlan();

                return view('pages.subscription.show', [

                    'user' => $user,

                    'plan' => $plan

                ]);
            }

            $plans = Plan::where('type', StripeProductType::RECURRING)->get();

            return view('pages.subscription.view', [

                'user' => $user,

                'intent' => $user->createSetupIntent(),

                'plans' => $plans

            ]);

        }

        $users = User::query()

            ->whereHas('subscriptions')

            ->get();

        return view('pages.subscription.list', compact('users'));

    }

    public function subscription(Request $request): mixed
    {
        $user = Auth::user();

        $paymentMethod = $request->input('payment_method');

        $planId = $request->input('plan');

        $plan = Plan::where('plan_id', $planId)->first();

        $user->createOrGetStripeCustomer();

        $user->updateDefaultPaymentMethod($paymentMethod);

        try {

            $user->newSubscription('default', $plan->plan_id)->create($paymentMethod, [ 'email' => $user->email ]);

        } catch (Exception $e) {

            return redirect('dashboard')->withErrors(['message' => 'Error creating subscription: ' . $e->getMessage()]);

        }

        Transaction::create([

            'user_id' => $user->id,

            'stripe_price' => $plan->plan_id,

            'type' => TransactionType::SUBSCRIBED,

            'amount' => $plan->amount,

            'currency' => $plan->currency

        ]);

        return redirect('dashboard')->withSuccess('Subscription created successfully.');
    }

    public function onlyForSubscriber(): View
    {
        return view('pages.subscription.only-for-subscriber');
    }
}
