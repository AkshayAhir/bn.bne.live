<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Coupon;

class EventCouponController extends Controller
{
    public function index(){
        $event = Event::all();
        return view('admin.pages.coupon.event-coupon',compact('event'));
    }
    public function autocomplete(Request $request)
    {
        $data = Event::select("event_name as value", "id")
            ->where('status',0)
            ->where('event_name', 'LIKE', '%'. $request->get('search'). '%')
            ->get();
        return response()->json($data);
    }
    public function alleventcoupon(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'coupon_code',
            2 =>'coupon_value',
            3 =>'event_name',
            4=> 'action',
        );
        $totalDataRecord = Coupon::where('status',0)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = Coupon::offset($start_val)
                ->where('status',0)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  Coupon::where('coupon_name','LIKE',"%{$search_text}%")
                ->where('status',0)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = Coupon::where('coupon_name','LIKE',"%{$search_text}%")->where('status',0)
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                $postnestedData['id'] = $post_val->id ;
                $postnestedData['coupon_code'] = $post_val->coupon_code;
                $postnestedData['coupon_value'] = $post_val->coupon_value."".$post_val->discount_flag;
                $postnestedData['event_name'] = Event::where('id', $post_val->event_id )->value('event_name');
                $postnestedData['no_of_coupon'] = $post_val->no_of_coupon;
                $postnestedData['action'] = '<a href="'.url('admin/view_event_coupon/'.$post_val->id).'" class="btn btn-sm btn-primary" id="edit_btn" > <i class="fa fa-edit"></i></a>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deleteEventCoupon('.$post_val->id.')" data-toggle="modal" data-target="#deleteEventCouponModal"> <i class="fas fa-trash-alt"></i></button>';
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
    public function addViewEventCoupon(Request $request){
        $event = Event::all();
        return view('admin.pages.coupon.add-coupon',compact('event'));
    }
    public function addEventCoupon(Request $request){
        $add_coupon = Coupon::insert(['coupon_code'=>$request->coupon_code,
            'event_id'=>$request->event_id,
            'coupon_value'=>$request->coupon_discount,
            'discount_flag'=>$request->discount_flag,
            'no_of_coupon'=>$request->no_of_coupon,
            'apply_discount'=>$request->apply_discount]);
        if ($add_coupon != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function viewEventCoupon($id){
        $event_coupon = Coupon::with('Event:id,event_name')->where('id', $id)->get();
        return view('admin.pages.coupon.edit-coupon',compact('event_coupon'));
    }
    public function editEventCoupon(Request $request){
        $edit_coupon = Coupon::where('id', $request->id)
            ->update(['coupon_code'=>$request->coupon_code,
                'event_id'=>$request->event_id,
                'coupon_value'=>$request->coupon_discount,
                'discount_flag'=>$request->discount_flag,
                'no_of_coupon'=>$request->no_of_coupon,
                'apply_discount'=>$request->apply_discount]);
        if ($edit_coupon != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deleteEventCoupon($id) {
        $delete = Coupon::where('id', $id)->update(['status'=>1]);
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
}