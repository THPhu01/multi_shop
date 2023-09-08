<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'desc',
        'content',
        'price',
        'price_sale',
        'percent',
        'image',
        'thumbnail',
        'status',
    ];

    public function productBrand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Lọc giá sản phẩm 
    public function scopeSort($query)
    {
        if (request()->loc_sp !== null) {
            $loc_sp = request()->loc_sp;
            if ($loc_sp == 'tang_dan') {
                $loc_sp = $query->orderBy('price', 'asc');
            } elseif ($loc_sp == 'giam_dan') {
                $loc_sp = $query->orderBy('price', 'desc');
            }
            return $loc_sp;
        }
    }
}
