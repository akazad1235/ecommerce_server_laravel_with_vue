<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function newProduct($type){
       $data = Product::where('remark', $type)->get();
       return response()->Json(['success'=>$data, 'status'=>200]);
    }
}
