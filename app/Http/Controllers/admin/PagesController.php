<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;


class PagesController extends Controller
{
    public function Pages(){
        return view('admin.pages.page.pages');
    }
    public function addPages(){
        return view('admin.pages.page.add-pages');
    }
    public function showPage(){
        return view('admin.pages.page.show-pages');
    }

    public function allpage(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'page_title',
            2 =>'page_description',
            3 =>'Permalink',
            4 =>'mata_title',
            5 =>'mata_description',
            6 =>'feature_image',
            7 =>'show_in_footer',
            8 =>'show_in_header',
            9 =>'order_no',
            10 =>'action',
        );
    
        $totalDataRecord = Page::where('status',0)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = Page::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->where('status',0)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  Page::where('status',0)->where('page_title','LIKE',"%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
            $totalFilteredRecord = Page::where('status',0)->where('page_title','LIKE',"%{$search_text}%")
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                $postnestedData['id'] = $post_val->id ;
                $postnestedData['page_title'] = $post_val->page_title;
                $postnestedData['page_description'] = $post_val->page_description;
                $postnestedData['permalink'] = $post_val->permalink;
                $postnestedData['mata_title'] = $post_val->mata_title;
                $postnestedData['mata_description'] = $post_val->mata_description;
                $postnestedData['feature_image'] = $post_val->feature_image;
                $postnestedData['show_in_footer'] = $post_val->show_in_footer;
                $postnestedData['show_in_header'] = $post_val->show_in_header;
                $postnestedData['order_no'] = $post_val->order_no;
                $postnestedData['action'] = '<a href="'.url('/admin/view_page/'.$post_val->id).'" class="btn btn-sm btn-primary" id="edit_btn" > <i class="fa fa-edit"></i></a>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deletePage('.$post_val->id.')" data-toggle="modal" data-target="#deletePageModal"> <i class="fas fa-trash-alt"></i></button>
                <a href="'.url('page/'.$post_val->permalink).'" class="btn btn-sm btn-secondary" target="__blank" id="show_btn" > <i class="fa fa-eye"></i></a>';
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

    public function addPage(Request $request){
        $image_name = null; 
        if($request->feature_image){
            $file_name = $request->feature_image->getClientOriginalName();
            $imageFileType = $request->feature_image->getClientOriginalExtension();
            $file_path = $request->feature_image->getPathName();
            $image_name = "feature_" . time(). "." . $imageFileType;
            $request->feature_image->move(public_path('admin/assets/images/page'), $image_name);
        }
        $data = array(
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
            'permalink'=>$request->permalink,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'show_in_footer' => isset($request->show_in_footer) ? 1 : 0,
            'show_in_header' =>isset($request->show_in_header) ? 1 : 0,
            'order_no' => $request->order_no,
            'feature_image' => $image_name,
            'status' => 0
        );
        // dd($data);
        $add_page = Page::insert($data);
        if ($add_page != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }

    public function deletePage($id){
      $delete = Page::where('id' ,$id)->update(['status' => 1]);
      if($delete != 1){
        return response()->json(['message'=>'fail', 'status'=>0]);
      }else{
        return response()->json(['message'=>'success', 'status'=>1]);
      }
    }
    
    public function viewPage($id){
        $data = Page::where('id', $id)->get(); 
        return view('admin.pages.page.edit-pages',compact('data'));
    }

    public function editPage(Request $request){
        $get_image = Page::where('id',$request->edit_id)->get();
        $edit_image = null;
        if($request->edit_feature_image != null){
            $file_name = $request->edit_feature_image->getClientOriginalName();
            $imageFileType = $request->edit_feature_image->getClientOriginalExtension();
            $file_path = $request->edit_feature_image->getPathName();
            $edit_image_name = "feature_" . time() . "." . $imageFileType;
            $request->edit_feature_image->move(public_path('admin/assets/images/page'), $edit_image_name);
            $edit_image = $edit_image_name;
            
        }
        if($edit_image == null){
            $edit_image = $get_image[0]['feature_image'];
        }
       $update_page = Page::where('id', $request->edit_id)->update([
            'page_title' => $request->edit_page_title,
            'page_description' => $request->page_description,
            'permalink'=>$request->edit_permalink,
            'meta_title' => $request->edit_meta_title,
            'meta_description' => $request->edit_meta_description,
            'show_in_footer' => isset($request->edit_show_in_footer) ? 1 : 0,
            'show_in_header' =>isset($request->edit_show_in_header) ? 1 : 0,
            'order_no' => $request->edit_order_no,
            'feature_image' => $edit_image,
       ]);
        if ($update_page != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }

    public function checkPermalink(Request $request){

        $permalink = strtolower($request->permalink);
    
        if(Page::where('permalink', $permalink)->exists()){
            $count = 1;
            do {
                $new_permalink = $permalink . '-' . $count;
                $count++;
            } while (Page::where('permalink', $new_permalink)->exists());
            return response()->json(['message'=>'success', 'status'=>'1','permalink'=>$new_permalink]);
        } else {
            return response()->json(['message'=>'success', 'status'=>'1','permalink'=>$permalink]);
        }
    }
    
    public function editPermalink(Request $request){
        $edit_permalink = strtolower($request->edit_permalink);
    
        if(Page::where('permalink', $edit_permalink)->exists()){
            $count = 1;
            do {
                $new_permalink = $edit_permalink . '-' . $count;
                $count++;
            } while (Page::where('permalink', $new_permalink)->exists());
            return response()->json(['message'=>'success', 'status'=>'1','permalink'=>$new_permalink]);
        } else {
            return response()->json(['message'=>'success', 'status'=>'1','permalink'=>$edit_permalink]);
        }
    }
}


