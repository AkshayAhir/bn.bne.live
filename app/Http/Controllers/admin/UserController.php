<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return view('admin.pages.user');
    }
    public function alluser(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'user_first_name',
            2 =>'user_email',
            3 =>'user_number',
            4=> 'is_guest_user',
            5=> 'set_event_create',
            6=> 'is_admin',
            7=> 'status',
            8=> 'access_request',
            9=> 'action',
        );
        $user_type = $request->user_type;
        $totalDataRecord = User::where(function($query) use ($user_type)  {
                if($user_type != null) {
                    $query->where('is_guest_user',$user_type);
                }
            })
            ->count();

        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $post_data = User::where(function($query) use ($user_type)  {
                    if($user_type != null) {
                        $query->where('is_guest_user',$user_type);
                    }
                })
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  User::where('user_first_name','LIKE',"%{$search_text}%")
                ->where(function($query) use ($user_type)  {
                    if($user_type != null) {
                        $query->where('is_guest_user',$user_type);
                    }
                })
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = User::where('user_first_name','LIKE',"%{$search_text}%")
                ->count();
        }
//        return $post_data;
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
//                if($post_val->event_images != ''){
//                    $image = explode(',', $post_val->event_images);
//                    $images = '<img class="storie_img_thumb" src="'.url('/admin/assets/images/event/'.$image[$post_val->is_feature]).'"alt="">';
//                }else{
//                    $images = '';
//                }
                if($post_val->is_guest_user == 0){
                    $user_type = "User";
                }else{
                    $user_type = "Guest user";
                }
                if($post_val->set_event_create == 0){
                    $event_create = "No";
                }else{
                    $event_create = "Yes";
                }
                if($post_val->status == 0){
                    $status = '<button class="badge bg-success" id="edit_btn" onclick="editStatus(1,'.$post_val->id.')" data-toggle="modal" data-target="#editStatusModal" style="border: none;padding: 5px">Actice</button>';
                }elseif($post_val->status == 1){
                    $status = '<button class="badge bg-danger" id="edit_btn" onclick="editStatus(0,'.$post_val->id.')" data-toggle="modal" data-target="#editStatusModal" style="border: none;padding: 5px;color: white;">Deactive</button>';
                }else{
                    $status = '<p class="badge bg-success" id="edit_btn" style="border: none;padding: 5px">Actice</p>';
                }
                if($post_val->access_request == 1){
                    $access_request = '<button type="button" class="btn btn-primary position-relative" onclick="accessRequest('.$post_val->id.')" data-toggle="modal" data-target="#accessRequestModal">Requested<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle" style="margin-top: -10px;margin-left: 3px;"></span></button>';
                }elseif ($post_val->set_event_create == 1){
                    $access_request = '<button type="button" class="btn btn-success position-relative" >Approved</button>';
                } else{
                    $access_request = '';
                }
                if($post_val->is_admin == 1){
                    $is_admin = '<button class="badge bg-success" onclick="scanPermission(0,'.$post_val->id.')"  data-toggle="modal" data-target="#scanPermissionModal" style="border: none;padding: 5px">Yes</button>';
                }else{
                    $is_admin = '<button class="badge bg-danger" onclick="scanPermission(1,'.$post_val->id.')" data-toggle="modal" data-target="#scanPermissionModal" style="border: none;padding: 5px;color: white;">No</button>'; 
                }


                $postnestedData['id'] = $post_val->id ;
//                $postnestedData['event_image'] = $images;
                $postnestedData['user_first_name'] =  $post_val->user_first_name." ".$post_val->user_last_name;
                $postnestedData['user_email'] = $post_val->user_email;
                $postnestedData['user_number'] = $post_val->user_number;
                $postnestedData['user_type'] = $user_type ;
                $postnestedData['event_create'] = $event_create ;
                $postnestedData['is_admin'] = $is_admin;
                $postnestedData['status'] = $status ;
                $postnestedData['request'] = $access_request;
                $postnestedData['action'] = '<button class="btn btn-sm btn-primary" id="edit_btn" onclick="editUser('.$post_val->id.')" data-toggle="modal" data-target="#editUserModal"> <i class="fa fa-edit"></i></button>';
//                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deleteEvent('.$post_val->id.')" data-toggle="modal" data-target="#deleteEventModal"> <i class="fas fa-trash-alt"></i></button>';
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
    public function viewUser($id){
        $user = User::where('id', $id)->get();
        if (!$user) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$user]);
        }
    }
    public function editUser(Request $request, $id) {
//        return $request;
        $get_image = User::where('id', $id)->value('user_profile_photo');
        if($request->edit_event_images != null){
            $file_name = $request->edit_event_images->getClientOriginalName();
            $imageFileType = $request->edit_event_images->getClientOriginalExtension();
            $file_path = $request->edit_event_images->getPathName();
            $edit_image_name = "event_" . time() . "." . $imageFileType;
            $request->edit_event_images->move(public_path('front/assets/images/user-profile'), $edit_image_name);
            $edit_images[] = $edit_image_name;
        }
        if(empty($edit_images)){
            $edit_event_images = $get_image;
        }else{
            $edit_event_images = implode(',', $edit_images);
        }
//        if($request->edit_event_create != ''){
//            $set_event = 1;
//        }else{
//            $set_event = 0;
//        }
//        return $set_event;
        $edit_user = User::where('id', $id)
            ->update(['user_first_name' => $request->edit_user_first_name,
                'user_last_name' => $request->edit_user_last_name,
                'user_email'=>$request->edit_user_email,
                'user_number'=>$request->edit_user_number,
                'user_profile_photo' => $edit_event_images,
//                'set_event_create'=>$set_event
            ]);
        if ($edit_user != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    function userStatusChange(Request $request){
//        return $request;
        $change = User::where('id', $request->id)->update(['status'=>$request->status]);
        if ($change != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }

    public function requestAccept(Request $request){
        $change = User::where('id', $request->user_id)->update(['set_event_create'=>1 ,'access_request'=>0]);
        if ($change != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function scanPermission(Request $request){
        $change = User::where('id', $request->user_id)->update(['is_admin'=>$request->scan_permission]);
        if ($change != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
}
