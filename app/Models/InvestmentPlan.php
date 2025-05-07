<?php

// InvestmentPlan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    use HasFactory;

    // Make sure to specify the table name if it's not the plural form
    protected $table = 'investment_plans';

    // Define the fillable fields for mass assignment
    protected $fillable = ['id' , 'plan_name', 'amount', 'daily_return', 'withdrawal_limit'];

    // Define any relationships, if needed (e.g., if it has many UserPlans)
    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }
}
