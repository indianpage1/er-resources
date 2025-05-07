<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'referral_code',
        'referrer_id',
        'main_wallet',
        'referral_wallet',
        'total_referred_users',
        'plan_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'main_wallet' => 'float',
        'referral_wallet' => 'float',
        'total_referred_users' => 'integer',
    ];
    

    public function walletSummary()
    {
        return $this->hasOne(\App\Models\UserWalletSummary::class, 'user_id');
    }

    public function userPlans()
    {
        return $this->hasMany(\App\Models\UserPlan::class, 'user_id', 'id');
    }
    public function latestUserPlan()
{
    return $this->hasOne(\App\Models\UserPlan::class, 'user_id')->latestOfMany();
}


    protected static function booted()
    {
        static::saved(function ($user) {
            if ($user->isDirty('main_wallet')) {
                \App\Models\UserWalletSummary::updateOrCreate(
                    ['user_id' => $user->id],
                    ['total_earning' => $user->main_wallet]
                );
            }
        });
    }
    
}
