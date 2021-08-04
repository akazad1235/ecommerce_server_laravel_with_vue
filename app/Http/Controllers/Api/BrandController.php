<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand(){
       $data = Brand::get();
       return response()->json(['success'=>$data]);
    }
}
