<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingHistory;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
class BookingHistoryController extends Controller {
    public function index(){
        return view('admin.pages.booking-history');
    }
    public function allbookinghistory(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
        );
        $totalDataRecord = BookingHistory::count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')
                ->whereHas('User' , function(Builder  $query) use ($search_text){
                    $query->where('user_name','LIKE',"%{$search_text}%");
                })
                ->orwhereHas('Event' , function(Builder  $query) use ($search_text){
                    $query->where('event_name','LIKE',"%{$search_text}%");
                })
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
            $totalFilteredRecord = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')
                ->whereHas('User' , function(Builder  $query) use ($search_text){
                    $query->where('user_name','LIKE',"%{$search_text}%");
                })
                ->orwhereHas('Event' , function(Builder  $query) use ($search_text){
                    $query->where('event_name','LIKE',"%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                $postnestedData['id'] = $post_val->id;
                $postnestedData['user_name'] = $post_val->user['user_first_name'];
                $postnestedData['user_email'] = $post_val->user['user_email'];
                $postnestedData['event_name'] = $post_val->event['event_name'];
                $postnestedData['ticket_name'] = $post_val->EventTicket['ticket_name'];
                $postnestedData['qty'] = $post_val->qty;
                $postnestedData['amount'] = '৳'.$post_val->amount;
                $postnestedData['date'] = date("Y-m-d ", strtotime($post_val->created_at));
                if($post_val->transaction['status'] == "Complete"){
                    $postnestedData['status'] = '<span class="badge bg-success">'.$post_val->transaction['status'].'</span>';
                }elseif($post_val->transaction['status'] == "Pending"){
                    $postnestedData['status'] = '<span class="badge bg-warning">'.$post_val->transaction['status'].'</span>';
                }else{
                    $postnestedData['status'] = '<span class="badge bg-danger">'.$post_val->transaction['status'].'</span>';
                }
                $postnestedData['action'] = '<a href="'.route('view-history-details', ['id' => $post_val->id]).'" ><i class="fa-solid fa-eye"></i></a>';
                $data_val[] = $postnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        echo json_encode($get_json_data);
    }
    public function viewHistoryDetails($id){
        $booking_history = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')->where('id',$id)->get();
        return view('admin.pages.view-history-details',compact('booking_history'));
    }
    public function history($id){
        $event_name = Event::where('id',$id)->value('event_name');
        return view('admin.pages.history',compact('id','event_name'));
    }
    public function eventBookingHistory(Request $request){
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1=>'user_first_name',
            2=>'event_name',
            3=>'ticket_name',
            4=>'qty',
            5=>'amount',
            6=>'status'

        );
        $totalDataRecord = BookingHistory::where('event_id',$request->event_id)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $post_data = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')->where('event_id',$request->event_id)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')->where('event_id',$request->event_id)
                ->whereHas('User' , function(Builder  $query) use ($search_text){
                    $query->where('user_first_name','LIKE',"%{$search_text}%");
                })
                ->orwhereHas('Event' , function(Builder  $query) use ($search_text){
                    $query->where('event_name','LIKE',"%{$search_text}%");
                })
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = BookingHistory::with('User','Transaction','Event','EventTicket','Coupon')->where('event_id',$request->event_id)
                ->whereHas('User' , function(Builder  $query) use ($search_text){
                    $query->where('user_first_name','LIKE',"%{$search_text}%");
                })
                ->orwhereHas('Event' , function(Builder  $query) use ($search_text){
                    $query->where('event_name','LIKE',"%{$search_text}%");
                })
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                $postnestedData['id'] = $post_val->id;
                $postnestedData['user_name'] = $post_val->user['user_first_name'];
                $postnestedData['user_email'] = $post_val->user['user_email'];
                $postnestedData['event_name'] = $post_val->event['event_name'];
                $postnestedData['ticket_name'] = $post_val->EventTicket['ticket_name'];
                $postnestedData['qty'] = $post_val->qty;
                $postnestedData['amount'] = ($post_val->amount != 0) ? '৳' . $post_val->amount : '৳0' ;
                $postnestedData['date'] = date("Y-m-d ", strtotime($post_val->created_at));
                $postnestedData['status'] = '<span class="badge bg-success">'.$post_val->transaction['status'].'</span>';
                $postnestedData['action'] = '<a href="'.route('view-history-details', ['id' => $post_val->id]).'" ><i class="fa-solid fa-eye"></i></a>';
                $data_val[] = $postnestedData;

            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        echo json_encode($get_json_data);
    }
}
