<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'product_comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'name',
        'comment',
        'status',
        'parent_id',
    ];
    public function productComment()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
