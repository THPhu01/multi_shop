<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'image',
        'status',
    ];
    public function sliderCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
