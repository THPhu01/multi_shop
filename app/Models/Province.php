<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    protected $fillable = [
        'name_quanhuyen',
        'type',
        'matp',

    ];
}
