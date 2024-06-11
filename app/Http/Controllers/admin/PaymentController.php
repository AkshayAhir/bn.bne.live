<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;

class PaymentController extends Controller
{
    public function index(){
        $data = PaymentSetting::get();
        return view('admin.pages.payment',compact('data'));
    }
    public function bnePayment(Request $request){
        // dd($request->payment_setting);
        $request->validate([
            'payment_setting' => 'required|in:0,1', // Assuming only 0 and 1 are valid values
        ]);

        // Insert or create the record in the database
        PaymentSetting::updateOrCreate(
            ['id' => 1],
            ['payment_gateway' => $request->payment_setting]);

            return response()->json(['message'=>'success', 'status'=>'1']);
    } 
}
