<?php

// app/Models/SaveWithdrawlAccount.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveWithdrawlAccount extends Model
{
    use HasFactory;

    protected $table = 'savewithdrawlaccount'; // explicitly set table name

    protected $fillable = [
        'user_id',
        'account_holder_name',
        'mobile_number',
        'method',
    ];
}
