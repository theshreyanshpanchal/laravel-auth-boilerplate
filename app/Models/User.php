<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Enums\VerificationType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles, Billable;

    protected $guarded = [];

    protected $hidden = [ 'password', 'remember_token' ];

    protected function casts(): array
    {
        return [

            'password' => 'hashed',

            'status' => UserStatus::class,

            'email_verified_at' => 'datetime',

            'phone_number_verified_at' => 'datetime'

        ];
    }

    protected $appends = [ 'full_name' ];

    public function getFullNameAttribute()
    {
        return ($this->attributes['first_name'] ?? "N/A") . " " . ($this->attributes['last_name'] ?? "N/A");
    }

    public function otp(): MorphOne
    {
        $type = VerificationType::EMAIL_VERIFICATION;

        return $this->morphOne(Otp::class, 'model')->where('type', $type)->latest();
    }

    public function recentOtp(): ?MorphOne
    {
        $type = VerificationType::EMAIL_VERIFICATION;

        return $this->morphOne(Otp::class, 'model')->where('type', $type)->where('created_at', '>=', now()->subMinutes(10))->latest();
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'model');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeExcludeAdmin(Builder $query): Builder
    {
        return $query->whereDoesntHave('roles', function ($query) { $query->where('name', UserRole::ADMIN->name); });
    }

    public function scopeOnlyAdmin(Builder $query): Builder
    {
        return $query->whereHas('roles', function ($query) { $query->where('name', UserRole::ADMIN->name); });
    }
}
