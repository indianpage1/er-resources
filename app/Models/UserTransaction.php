<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'user_transactions';

    // Specify the columns that are mass assignable
protected $fillable = [
    'user_id',
    'user_name',
    'payment_screenshot',
    'plan_amount',
    'plan_Name',
    'plan_id',
    'status',
];
}
