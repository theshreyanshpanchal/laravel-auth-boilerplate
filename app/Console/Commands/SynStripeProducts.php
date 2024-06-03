<?php

namespace App\Console\Commands;

use App\Enums\StripeProductType;
use App\Models\Plan;
use App\Services\StripeService;
use Illuminate\Console\Command;

class SynStripeProducts extends Command
{
    protected $signature = 'sync:stripe-products';

    protected $description = 'Command to sync the stripe products';

    public function handle(StripeService $service): void
    {
        foreach ($service->products() as $product) {

            $retrieved = $service->product($product->product);

            Plan::updateOrCreate(
                [
                    'plan_id' => $product->id,
                ], [

                'plan_object' => $product->object,

                'type' => $product->type,

                'amount' => $product->unit_amount,

                'billing_scheme' => $product->billing_scheme,

                'currency' => $product->currency,

                'interval' => $product['recurring']['interval'] ?? null,

                'interval_count' => $product['recurring']['interval_count'] ?? null,

                'product_id' => $retrieved->id,

                'product_name' => $retrieved->name,

                'product_object' => $retrieved->object,

                'product_type' => $retrieved->type,

            ]);

        }

        $this->newLine();

        $this->comment("Stripe products synced successfully 🔁.");

        $this->newLine();
    }
}
