<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'image',
        'status'
    ];
    public function productNameBrand()
    {
        return $this->hasOne(Product::class, 'brand_id', 'id');
    }
}
