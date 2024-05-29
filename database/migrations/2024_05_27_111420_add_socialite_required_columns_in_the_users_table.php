<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('google_auth_id')->after('id')->nullable();

            $table->string('facebook_auth_id')->after('google_auth_id')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('google_auth_id');

            $table->dropColumn('facebook_auth_id');
        
        });
    }
};
