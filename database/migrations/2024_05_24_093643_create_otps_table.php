<?php

use App\Enums\VerificationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otps', function (Blueprint $table) {

            $table->id();

            $table->enum('type', VerificationType::values());

            $table->string('otp');

            $table->nullableMorphs('model');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
