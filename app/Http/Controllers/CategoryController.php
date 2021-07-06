<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
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

        return Inertia::render('Categories/index',  ['data' => $param]);
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
        return Inertia::render('Categories/create');
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
     $data['created_by'] = Auth::user()->id;


        if ($request->create_another == 1){
            Category::create($data);
            return Redirect::back()->with('message', 'Categories Created successfully');

        }else{

            return Redirect::route('categories.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $id)
    {
        $data = Category::find($id);

        return Inertia::render('Categories/view', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        $data =  Category::find($id);
        return Inertia::render('Categories/edit', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        $data =  $request->all();
        $getData = Category::find($id);
        $data['updated_by'] = Auth::user()->id;
        $getData->update($data);

        return Inertia::render('Categories/view', ['data'=>$getData]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $data = Category::find($id);
        $data->delete($data);
        return redirect()->back();
    }
}
