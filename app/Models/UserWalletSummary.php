<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWalletSummary extends Model
{
    protected $fillable = [
        'user_id',
        'total_earning',
        'total_withdrawal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
