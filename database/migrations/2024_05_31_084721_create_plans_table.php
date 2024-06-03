<?php

use App\Enums\StripeProductType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {

            $table->id();

            $table->string('plan_id')->nullable();

            $table->string('plan_object')->nullable();

            $table->enum('type', StripeProductType::values());

            $table->integer('amount')->default(0);

            $table->string('billing_scheme')->nullable();

            $table->string('currency')->default('usd');

            $table->string('interval')->nullable();

            $table->integer('interval_count')->nullable();

            $table->string('product_id');

            $table->string('product_name');

            $table->string('product_object');

            $table->string('product_type');

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
