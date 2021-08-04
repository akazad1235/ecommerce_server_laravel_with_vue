<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'price',
        'brand_id',
        'category_id',
        'sub_category_two_id',
        'sub_category_three_id',
        'image',
        'remark',
        'review',
        'product_code',
        'available',
        'status',
        'sort_desc',
        'desc',
        'slug',
        'qty'
    ];

    function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
