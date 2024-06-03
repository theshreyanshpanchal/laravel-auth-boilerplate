<?php

namespace App\Http\Controllers\Web;

use App\Enums\StripeProductType;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Purchase;
use App\Services\StripeService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public $service;

    public function __construct(StripeService $service)
    {
        $this->service = $service;
    }

    public function view(): View
    {
        $user = Auth::user();

        $purchases = $user->purchases->pluck('product_id')->toArray() ?? [];

        $products = Plan::where('type', StripeProductType::ONE_TIME)->get();

        if (! ($user->roles->first()->name === UserRole::ADMIN->value)) {

            return view('pages.product.view', [

                'user' => $user,

                'purchases' => $purchases,

                'products' => $products

            ]);

        }

        return view('pages.product.view', [ 'products' => $products ]);

    }

    public function show(string $id): View
    {
        $user = Auth::user();

        $stripePrices = $user->purchases->pluck('stripe_price')->toArray() ?? [];

        if (in_array($id, $stripePrices)) {

            return view('pages.product.show');

        }

        return view('pages.product.purchase', [

            'user' => $user,

            'intent' => $user->createSetupIntent(),

            'id' => $id

        ]);
    }

    public function purchase(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $paymentMethod = $request->input('payment_method');

        $productId = $request->input('id');

        $user->createOrGetStripeCustomer();

        $user->updateDefaultPaymentMethod($paymentMethod, []);

        $plan = Plan::where('plan_id', $productId)->first();

        $amount = $plan->amount;

        try {

            $user->charge($amount, $paymentMethod, [ 'return_url' => route('view:products') ]);

        } catch (Exception $e) {

            return redirect('products')->withErrors(['message' => 'Error purchasing product: ' . $e->getMessage()]);

        }

        Purchase::create([
            'user_id' => $user->id,
            'stripe_price' => $plan->plan_id,
            'product_id' => $plan->product_id,
            'amount' => $amount,
            'currency' => $plan->currency,
        ]);

        return redirect('products')->withSuccess('Product purchased successfully.');
    }
}
