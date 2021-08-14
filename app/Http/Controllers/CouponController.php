<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CouponController extends Controller
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
                $data = Coupon::whereBetween('created_at', [$request->from_date, $request->to_date])
                    ->where($where)
                    ->latest()
                    ->paginate(10)
                    ->appends($query);
            }else{
                $data = Coupon::whereBetween('created_at', [$request->from_date, $request->to_date])
                    ->latest()
                    ->paginate(10)
                    ->appends($query);
            }
        }else{
            $data = Coupon::where($where)
                ->latest()
                ->paginate(10)
                ->appends($query);
        }

        $param['query'] = $query;
        $param['data'] = $data;

        return Inertia::render('Coupons/index',  ['data' => $param]);
        //  return Inertia::render('Categories/index');
    }
    // search query builder
    public function getQuery($where, $request)
    {
        if (!empty($request->search_type) && !empty($request->search_text)) {
            if (($request->search_type) == 'name') {
                $where = array_merge(array(['coupons.name', 'LIKE', '%' . ($request->search_text) . '%']), $where);
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
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();
        $data['customers'] = Customer::get();
        return Inertia::render('Coupons/create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->manual_cp_code;
        $amountType = $request->amount_type;
        $amount = $request->amount;
        $status = $request->status;
        $expiryDate = $request->expiry_date;
        $categories = json_encode($request->categories);
        $brands = json_encode($request->brands);
        $customers = json_encode($request->customers);




        if($request->cpCode == 'manual'){
            $coupon_code = $request->manual_cp_code;
        }else{
           $coupon_code = mt_rand(0000, 9999);
        }
        Coupon::create([
            'amount_type' => $amountType,
            'customer' => $customers,
            'categories' => $categories,
            'brands' => $brands,
            'coupon_code' => $coupon_code,
            'amount' => $amount,
            'expiry_date' => $expiryDate,
            'status' => $status
        ]);
        return redirect()->route('coupons.index')->with('message', 'Coupon added successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
