<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
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
            $data = Brand::where($where)
                ->latest()
                ->paginate(10)
                ->appends($query);
        }

        $param['query'] = $query;
        $param['data'] = $data;

        return Inertia::render('Brand/index',  ['data' => $param]);
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
        return Inertia::render('Brand/create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $name =  $request->name;
       $logo = $request->file('logo');
       $fileName = rand(0, 999999999) . '_' . date('Ymdhis').'_' . rand(100, 999999999) . '.' .  $logo->getClientOriginalExtension();
       $logo->move(public_path('assets/images/brands/'), $fileName );
       Brand::create([
           'name' =>$name,
           'logo' =>$fileName
       ]);
       return redirect()->back()->with('message', 'Brand added successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
