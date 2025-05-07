<?php
// UserPlan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'last_claimed',
        'user_id',
        'plan_id',
        'amount_invested',
        'total_earning', 
        'daily_earning',
        'daily_earning_with_increment',
        'plan_name',
    ];
    

    // Relationship with InvestmentPlan
    public function plan()
    {
        return $this->belongsTo(InvestmentPlan::class, 'plan_id');
    }

    // Relationship with User (if necessary)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
