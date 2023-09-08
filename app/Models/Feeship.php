<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    protected $table = 'feeship';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_matp',
        'id_maqh',
        'id_xa',
        'feeship',

    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'id_matp', 'matp');
    }
    public function quanhuyen()
    {
        return $this->belongsTo(Province::class, 'id_maqh', 'maqh');
    }
    public function phuongxa()
    {
        return $this->belongsTo(Wards::class, 'id_xa', 'xaid');
    }
}
