<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role_id',
        'user_id',
    ];
  
}
