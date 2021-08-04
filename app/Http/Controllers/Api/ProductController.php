<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'showsfdsdf';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'show';
    }

    /**
     * @param $name
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function getProduct($name){
        $getProByCat = Product::get();
        return response()->json(['data'=>$getProByCat, 'status'=>200]);
    }

    public function productDetails($slug){
        $data = Product::where('slug', $slug)->first();
       return response()->json(['success'=>$data]);
    }



    /**
     * @param $type
     */
    public function categoriesFilter($id){
       // $data = Cateories::with(categories)->get();
         $data = Product::where('category_id', $id)->get();
        return response()->json(['success'=>$data]);
    }

    public function categoriesFilterProduct($type){
       $getCatName =  Category::where('name', $type)->first();
      $data = Product::where('category_id',$getCatName->id)->get();
        return response()->json(['success'=>$data]);
    }
    public function brandFilterProduct($id){
        $data = Product::where('brand_id', $id)->get();
        return response()->json(['success'=>$data]);
    }


}
