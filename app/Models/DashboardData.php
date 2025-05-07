<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardData extends Model
{
    use HasFactory;

    // Define the associated table
    protected $table = 'dashboard_data'; 

    // Define fillable attributes for mass-assignment
    protected $fillable = [
        'total_withdrawals',
        'total_investment',
        'total_users',
        'referral_users',
    ];

    // Cast decimals to ensure correct precision
    protected $casts = [
        'total_withdrawals' => 'decimal:2',
        'total_investment' => 'decimal:2',
        'total_users' => 'integer',
        'referral_users' => 'integer',
    ];

    // Optional: You can add a date format for the timestamps if required
    // protected $dateFormat = 'Y-m-d H:i:s';

    // Optional: You can add relationships if there are any (e.g., if DashboardData belongs to a User)
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
