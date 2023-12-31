<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $table = 'product_gallery';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'name',
        'image',
    ];

    public function productGallery()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
