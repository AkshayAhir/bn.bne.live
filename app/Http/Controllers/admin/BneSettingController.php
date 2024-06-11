<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BneSetting;
class BneSettingController extends Controller
{
    public function index(){
        return view('admin.pages.bne-setting');
    }
    public function allpermission(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'title',
            2 =>'permission',
            3=> 'action',
        );
        $totalDataRecord = BneSetting::count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = BneSetting::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  BneSetting::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = BneSetting::count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                if($post_val->permission == 0){
                    $permission = "Yes";
                }else{
                    $permission = "No";
                }
                $postnestedData['id'] = $post_val->id;
                $postnestedData['title'] = $post_val->title;
                $postnestedData['permission'] = $permission;
                $postnestedData['action'] = '<button class="btn btn-sm btn-primary" id="edit_btn" onclick="editPermission('.$post_val->id.')" data-toggle="modal" data-target="#editPermissionModal"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deletePermission('.$post_val->id.')" data-toggle="modal" data-target="#deletePermissionModal"> <i class="fas fa-trash-alt"></i></button>';
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
    public function addPermission(Request $request){
       $data = array(
            'title' => $request->title,
            'permission'=>$request->permission,
        );
        $add_permission = BneSetting::insert($data);
        if ($add_permission != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function viewPermission(Request $request){
        $permission = BneSetting::where('id', $request->edit_id)->get();
        if (!$permission) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$permission]);
        }
    }
    public function editPermission(Request $request){
        $edit_permission = BneSetting::where('id', $request->edit_id)
            ->update(['title' => $request->edit_title,
                'permission'=>$request->edit_permission,
            ]);
        if ($edit_permission != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deletePermission(Request $request){
        $delete = BneSetting::where('id', $request->delete_id)->delete();
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
}
