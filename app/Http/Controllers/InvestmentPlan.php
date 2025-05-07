<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    use HasFactory;

    protected $fillable = ['plan_name', 'amount', 'daily_return', 'withdrawal_limit'];

    // Cast date attributes to Carbon instances
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with UserPlans
    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }
}
