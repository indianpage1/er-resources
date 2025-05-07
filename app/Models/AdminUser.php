<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'admin_users';

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
