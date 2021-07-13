<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubcategoryTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

         $data = $request->all();
         $data['created_by'] = Auth::user()->id;
        Category::create($data);

        if ($request->create_another == 1){
            return redirect()->back()->with('message', 'Category Added Successfully.');
        }else{
            $data['categories']=Category::get();
            $data['step'] ='two';
           //return Inertia::render('Categories/generate', ['data'=>$data]);
//           return redirect()->route('categories.index')->with('message', 'Category Added Successfully.');
         //   return redirect()->back()->with('error', 'Category Added Successfully.');
         //   return redirect()->back()->with('error', 'Category Added Successfully.');
            return redirect()->route('categories.subcategories.one');

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

        $name =  $request->name;
        $getData = Category::find($id);
        $updated_by= Auth::user()->id;
        $getData->update(['name'=>$name, 'updated_by'=>$updated_by]);
      //  return Inertia::render('Categories/create')->with('message', 'Categories Updated Success');
        return Redirect::route('categories.show',$id)->with('message', 'Tasks Updated Successfully.');
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
        return redirect()->back()->with('message', 'Categories Deleted Success');
    }
    /**
     * Create Generate for Category in step one
     */
    public function generate(){
        $data['step'] ='one';
       return Inertia::render('Categories/generate', ['data'=>$data]);
    }
    /**
     * Create Generate for Sub-Category step two
     */
    public function subCategoriesOne(){
        $data['categories']=Category::get();
        $data['step'] ='two';
        return Inertia::render('Categories/generate', ['data'=>$data]);
    }
    /**
     * Store for Sub-Category step two
     */
    public function subCategoriesOneStore(Request $request){
        $data = $request->all();
        $data['categories']=Category::get();
        $data['step'] ='three';
        SubcategoryTwo::create($data);
       // return Inertia::render('Categories/generate', ['data'=>$data]);
        return redirect()->route('categories.subcategories.two');

    }

    public function subCategoriesTwo(){
        $data['categories']=Category::get();
        $data['step'] ='three';
        return Inertia::render('Categories/generate', ['data'=>$data]);
    }

}
