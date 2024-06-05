<?php

use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('first_name');

            $table->string('last_name');

            $table->string('email');

            $table->string('phone_number')->nullable();

            $table->string('phone_number_country_code')->nullable();

            $table->string('password')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->enum('status', UserStatus::values())->default(UserStatus::ACTIVE);

            $table->rememberToken();

            $table->timestamps();

            $table->softDeletes();

        });

        Schema::create('sessions', function (Blueprint $table) {

            $table->string('id')->primary();

            $table->foreignId('user_id')->nullable()->index();

            $table->string('ip_address', 45)->nullable();

            $table->text('user_agent')->nullable();

            $table->longText('payload');

            $table->integer('last_activity')->index();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');

        Schema::dropIfExists('sessions');
    }
};
