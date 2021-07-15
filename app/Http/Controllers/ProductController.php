<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {

        //dd($request->all());
        $data = [];
        $query = $request->query();
        $where = array();
        $where = $this->getQuery($where, $request);

        if (!empty($request->from_date) && !empty($request->to_date)){
            if (!empty($where)){
                $data = Category::whereBetween('created_at', [$request->from_date, $request->to_date])
                    ->where($where)
                    ->latest()
                    ->paginate(10)
                    ->appends($query);
            }else{

                $data = Category::whereBetween('created_at', [$request->from_date, $request->to_date])
                    ->latest()
                    ->paginate(10)
                    ->appends($query);
            }

        }else{
            $data = Category::where($where)
                ->latest()
                ->paginate(10)
                ->appends($query);
        }

        $param['query'] = $query;
        $param['data'] = $data;

        return Inertia::render('Products/index',  ['data' => $param]);
        //  return Inertia::render('Categories/index');
    }
    // search query builder
    public function getQuery($where, $request)
    {

        if (!empty($request->search_type) && !empty($request->search_text)) {

            if (($request->search_type) == 'name') {
                $where = array_merge(array(['categories.name', 'LIKE', '%' . ($request->search_text) . '%']), $where);
            }

        }

        //   if (!empty($request->organization_id)) {
        //      return $where = array_merge(array(['mail_settings.organization_id', $request->organization_id]), $where);
        //   }

        return $where;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = '';
        return Inertia::render('Products/create', ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
        $data = $request->all();
        $data['product_code']= mt_rand(000001, 999999);
        $data['slug'] = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        $image = $request->file('image');
        $fileName = rand(0, 999999999) . '_' . date('Ymdhis').'_' . rand(100, 999999999) . '.' .  $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/products/'), $fileName );
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->back()->with('message', 'product added sucess');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * @return \Inertia\Response
     */
    public function generates(){
        $data['step'] = 'one';
        $data['brands']=Brand::get();
        $data['categories']=Category::get();
        return Inertia::render('Products/generate',['data'=>$data]);
    }
}
