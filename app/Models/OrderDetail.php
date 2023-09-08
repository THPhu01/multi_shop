<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'qty',
    ];

    public function orderInfo()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function orderProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
