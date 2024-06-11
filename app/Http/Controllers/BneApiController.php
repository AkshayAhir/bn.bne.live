<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BookingHistory;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
class BneApiController extends Controller
{
     public function userLogin(Request $request){
        request()->validate([
            'user_email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('user_email',$request->user_email)->get();
        $credentials = $request->only('user_email', 'password');
        if(count($user) > 0 && $user[0]->status == 1){
            return response()->json(["message" => 'Your account deactivate', "status" => "0"]);
        }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token =  $user->createToken('token')->accessToken;
            User::where('id', $user->id)->update(["token" => $token]);
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$user], 200);
        }else{
            return response()->json(['message'=>'Login credentials are incorrect', 'status'=>'0']);
        }
    }
    public function adminLogin(Request $request){
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin');
            $admin = Admin::where('email',$request->email)->get();
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$admin], 200);
        }
        return response()->json(['message'=>'Invalid Login...!', 'status'=>'0']);
    }
    public function adminScanTicket(Request $request){
        if($request->transaction_oder_id != null){
            $transaction_id = Transaction::where('transaction_oder_id',$request->transaction_oder_id)->value('id');
            $booking_id = BookingHistory::where('transaction_id',transaction_oder_id)->value('id');
            $booking = BookingHistory::with('Event:id,event_name','EventTicket:id,ticket_name','User:id,user_first_name,user_last_name,user_email')->where('id', $booking_id)->get();
            if(Transaction::where('transaction_oder_id',$request->transaction_oder_id)->where('ticket_scan_status',0)->exists()){
                // return "not scan";
                $data = Transaction::where('transaction_oder_id',$request->transaction_oder_id)->update(['ticket_scan_status'=>1]);
                if ($data != 1) {
                    return response()->json(['message'=>'fail', 'status'=>'0']);
                }
                return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
            }
            else{
                return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0' ,'data'=>$booking]);
            }
        }else{
            $booking_id = BookingHistory::where('transaction_id',$request->transaction_id)->value('id');
            $booking = BookingHistory::with('Event:id,event_name','EventTicket:id,ticket_name','User:id,user_first_name,user_last_name,user_email')->where('id', $booking_id)->get();
            if(Transaction::where('id',$request->transaction_id)->where('ticket_scan_status',0)->exists()){
                // return "not scan";
                $data = Transaction::where('id',$request->transaction_id)->update(['ticket_scan_status'=>1]);
                if ($data != 1) {
                    return response()->json(['message'=>'fail', 'status'=>'0']);
                }
                return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
            }
            else{
                return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0' ,'data'=>$booking]);
            }
        }
        
    }
    public function userScanTicket(Request $request){
        if($request->transaction_order_id != null){
            // $user = Auth::guard('api')->user()->id;
            $transaction_id = Transaction::where('transaction_order_id',$request->transaction_order_id)->value('id');
            $booking_data = BookingHistory::where('transaction_id',$transaction_id)->get();
            $booking = BookingHistory::with('Event:id,event_name','EventTicket:id,ticket_name','User:id,user_first_name,user_last_name,user_email')->where('id', $booking_data[0]->id)->get();
            // $user_id = Event::where('id',$booking_data[0]->event_id)->value('user_id');
            if(Auth::guard('api')->user()->is_admin){
                if(Transaction::where('transaction_order_id',$request->transaction_order_id)->where('ticket_scan_status',0)->exists()){
                    // return "not scan";
                    $data = Transaction::where('transaction_order_id',$request->transaction_order_id)->update(['ticket_scan_status'=>1]);
                    if ($data != 1) {
                        return response()->json(['message'=>'fail', 'status'=>'0']);
                    }
                    return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
                }
                else{
                    return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0', 'data'=>$booking]);
                }
            }else{
                return response()->json(['message'=>"You don't have a permission. Please contact admin.", 'status'=>'0']);
            }
            //     if($user_id == $user){
            //         if(Transaction::where('transaction_order_id',$request->transaction_order_id)->where('ticket_scan_status',0)->exists()){
            //             // return "not scan";
            //             $data = Transaction::where('transaction_order_id',$request->transaction_order_id)->update(['ticket_scan_status'=>1]);
            //             if ($data != 1) {
            //                 return response()->json(['message'=>'fail', 'status'=>'0']);
            //             }
            //             return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
            //         }
            //         else{
            //             return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0']);
            //         }
            //     }else{
            //         return response()->json(['message'=>'This event not created by you', 'status'=>'0']);
            //     }
            // }
        }else{
            // $user = Auth::guard('api')->user()->id;
            $booking_data = BookingHistory::where('transaction_id',$request->transaction_id)->get();
            $booking = BookingHistory::with('Event:id,event_name','EventTicket:id,ticket_name','User:id,user_first_name,user_last_name,user_email')->where('id', $booking_data[0]->id)->get();
            // $user_id = Event::where('id',$booking_data[0]->event_id)->value('user_id');
            if(Auth::guard('api')->user()->is_admin){
                if(Transaction::where('id',$request->transaction_id)->where('ticket_scan_status',0)->exists()){
                    // return "not scan";
                    $data = Transaction::where('id',$request->transaction_id)->update(['ticket_scan_status'=>1]);
                    if ($data != 1) {
                        return response()->json(['message'=>'fail', 'status'=>'0']);
                    }
                    return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
                }
                else{
                    return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0', 'data'=>$booking]);
                }
            }else{
                return response()->json(['message'=>"You don't have a permission. Please contact admin.", 'status'=>'0']);
            }
            //     if($user_id == $user){
            //         if(Transaction::where('id',$request->transaction_id)->where('ticket_scan_status',0)->exists()){
            //             // return "not scan";
            //             $data = Transaction::where('id',$request->transaction_id)->update(['ticket_scan_status'=>1]);
            //             if ($data != 1) {
            //                 return response()->json(['message'=>'fail', 'status'=>'0']);
            //             }
            //             return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$booking]);
            //         }
            //         else{
            //             return response()->json(['message'=>'QR Code is allready scanned', 'status'=>'0','data'=>$booking]);
            //         }
            //     }else{
            //         return response()->json(['message'=>'This event not created by you', 'status'=>'0']);
            //     }
            // }
        }
        
    }
    public function eventList(Request $request){
        $user_id = $request->user_id;
        $events = Event::where('status', 0)
            ->where(function ($query) use ($user_id) {
                if ($user_id != null) {
                    $query->where('user_id', $user_id);
                }
            })
            ->get();
        $finalData = array();
        foreach ($events as $event ){
            $data = EventTicket::leftJoin(DB::raw('
                (SELECT
                    booking_histories.ticket_id,
                    SUM(booking_histories.qty) as total_sold,
                    SUM(if(transactions.ticket_scan_status = 1, booking_histories.qty, 0)) AS scannedCount,
                    SUM(if(transactions.ticket_scan_status = 0, booking_histories.qty, 0)) AS unscannedCount
                FROM
                    booking_histories
                    JOIN transactions ON transactions.id = booking_histories.transaction_id
                    JOIN event_tickets ON event_tickets.id = booking_histories.ticket_id

                GROUP BY
                    booking_histories.ticket_id) subTable'),
                        function ($join) {
                            $join->on('event_tickets.id', '=', 'subTable.ticket_id');
                        })
                        ->select('event_tickets.id','event_tickets.total_ticket','event_tickets.ticket_name', 'subTable.total_sold' ,'subTable.scannedCount', 'subTable.unscannedCount')
                        ->where('event_id', $event->id)
                        ->get();
                $event['tickets']=$data;
                array_push($finalData, $event);
        }
        if ($event) {
            return response()->json(['message' => 'success', 'status' => '1', 'data' => $finalData]);
        } else {
            return response()->json(['message' => 'fail', 'status' => '0']);
        }
    }
    public function bookingHistory(Request $request){
        $event_id = $request->event_id;
        $user_id = $request->user_id;
        $BookingHistory = BookingHistory::with('User:id,user_email,user_first_name,user_number','Transaction','Event','EventTicket','Coupon')
        ->where(function($query) use ($event_id,$user_id)  {
            if($event_id != null) {
                $query->where('event_id',$event_id);
            }
            if($user_id != null) {
                $query->where('user_id',$user_id);
            }
        })->get();
        if($BookingHistory){
            return response()->json(['message'=>'success', 'status'=>'1' , 'data'=>$BookingHistory]);
        }else{
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
    public function userAccess(Request $request){
        $user = User::where('id',$request->user_id)->update(['is_admin'=>1]);
        if($user){
            return response()->json(['message'=>'User admin Access successfully', 'status'=>'1']);
        }else{
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
    public function userList(Request $request){
        if($request->event_id == null){
            $user = User::all();
            if($user){
                return response()->json(['message'=>'success', 'status'=>'1','data'=>$user]);
            }else{
                return response()->json(['message'=>'fail', 'status'=>'0']);
            } 
        }else{
            $user = BookingHistory::with('User:id,user_first_name,user_last_name,user_email','EventTicket:id,ticket_name','Transaction:id,transaction_oder_id,ticket_scan_status')->where('event_id',$request->event_id)->get();
            if($user){
                return response()->json(['message'=>'success', 'status'=>'1','data'=>$user]);
            }else{
                return response()->json(['message'=>'fail', 'status'=>'0']);
            } 
        }
        
    }
}
