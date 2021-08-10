<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerMailVerify;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      //  $data = $request->all();
        $fName =  $request->fname;
        $lName= $request->lname;
        $name = $fName." ".$lName;
        $phone = $request->phone;
        $email = $request->email;
        $code = mt_rand(00001, 999999);

        Customer::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'email_verified_code' => $code
        ]);
       // Mail::to($email)->send(new CustomerMailVerify($email, $code, $fName));
        return 'ok' ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $otp
     */
    public function otpVerify($otp){
        $getCustomer = Customer::where('email_verified_code', $otp)->first();
        if ($getCustomer !=null){
            return response()->json(['success'=>$getCustomer->email_verified_code, 'status'=>200]);
        }else{
             return response()->json(['error'=>'Invalid Your Otp', 'status'=>404]);
        }
    }

    /**
     * @param Request $request
     */
    public function customerPassword(Request $request){
     // return $request->all();
       $getCustomer = Customer::where('email_verified_code', $request->otp)->first();
        if ($getCustomer !=null){
            $getCustomer->email_verified_code = 1234;
            $getCustomer->password = Hash::make($request->password);
            $getCustomer->status = 1;
            $getCustomer->save();
            return response()->json(['success'=>$getCustomer->email_verified_code, 'status'=>200]);
        }else{
            return response()->json(['error'=>'Invalid Your Otp', 'status'=>404]);
        }
    }

    public function login(Request $request){
        //return $request->password;
      //  $pass = hash::check('password', $request->password);

       $getCustomer = Customer::where('email', $request->email)->first();

       if ($getCustomer !=null && Hash::check($request->password, $getCustomer->password)){
           return response()->json(['success'=>'well done, you are a valid Customer', 'status'=>200, 'data'=>$getCustomer]);
       }else{
           return response()->json(['error'=>'Invalid user email & password', 'status'=>404]);
       }
    }
    public function checkEmail($email){
        $getCustomer = Customer::where('email', $email)->first();
        if ($getCustomer !=null){
            return response()->json(['success'=>'d','status'=>200, 'data'=>$getCustomer]);
        }else{
            return response()->json(['error'=>'Invalid user email', 'status'=>404]);
        }


    }
}
