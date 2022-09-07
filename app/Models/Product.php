<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'feature_image',
        'category_id',
        'color',
        'size',
        'description',
        'status',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getStatusNameAttribute()
    {
        return ProductStatusEnum::getKey($this->status);
    }
}
