<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryThree extends Model
{
    use HasFactory;
    protected $fillable =['name', 'category_id', 'subcategory_twos_id'];
}
