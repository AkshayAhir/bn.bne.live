<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\BookingHistory;
class ScanTicketController extends Controller
{
     public function index(){
        return view('admin.pages.scan-ticket');
    }
    public function scanTicket(Request $request){
        $transaction_id = Transaction::where('transaction_order_id',$request->scanTicket)->value('id');
        $booking_id = BookingHistory::where('transaction_id',$transaction_id)->value('id');
        $booking = BookingHistory::with('EventBooking','EventTicket','User')->where('id', $booking_id)->get();
        if(Transaction::where('transaction_order_id',$request->scanTicket)->where('ticket_scan_status',0)->exists()){
            $data = Transaction::where('transaction_order_id',$request->scanTicket)->update(['ticket_scan_status'=>1]);
            if ($data != 1) {
               return response()->json(['message'=>'fail', 'status'=>'0']);
            }
            return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
        }
        else{
             return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
}