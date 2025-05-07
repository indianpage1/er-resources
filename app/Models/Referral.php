<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'referred_user_id', 'referral_code', 'reward_amount'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Referred User
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
