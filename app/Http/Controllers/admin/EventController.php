<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EventTicket;
use App\Models\User;
use App\Models\Transaction;
use App\Models\BookingHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Event;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportEvents;
use Mail;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Str;
class EventController extends Controller
{
    public function index(){
        return view('admin.pages.event');
    }
    public function allevent(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'event_images',
            2 =>'event_name',
            3 =>'event_date',
            4=> 'event_location',
            5=> 'event_time',
            6=> 'is_approved',
            7=> 'action',
        );
        $totalDataRecord = Event::where('status',0)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = Event::with('User:id,user_first_name')
                ->where('status',0)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  Event::with('User:id,user_first_name')->where('status',0)->where('event_name','LIKE',"%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
            $totalFilteredRecord = Event::with('User:id,user_first_name')->where('status',0)->where('event_name','LIKE',"%{$search_text}%")
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                if($post_val['user'] == Null){
                    $user_first_name = "admin";
                }else{
                    $user_first_name = $post_val->user['user_first_name'];
                }
                if($post_val->event_images != ''){
                    $image = explode(',', $post_val->event_images);
                    $images = '<img class="storie_img_thumb" src="'.url('/admin/assets/images/event/'.$image[$post_val->is_feature]).'"alt="">';
                }else{
                    $images = '';
                }
                if($post_val->is_approved == 1){
                    $is_approved = '<button class="badge bg-secondary" id="edit_btn" onclick="editIsApproved(0,'.$post_val->id.')" data-toggle="modal" data-target="#editIsApprovedModal" style="border: none;padding: 5px;color:white;">Requested</button>';
                }else{
                    $is_approved = '<button class="badge bg-success" id="edit_btn" style="border: none;padding: 5px">Approved</button>';
                }
                $postnestedData['id'] = $post_val->id ;
                $postnestedData['user_first_name'] = $user_first_name ;
                $postnestedData['event_image'] = $images;
                $postnestedData['event_name'] = $post_val->event_name;
                $postnestedData['event_location'] = $post_val->event_address;
                $postnestedData['event_date'] = $post_val->event_date;
                $postnestedData['event_time'] = date("h:i A", strtotime($post_val->event_start_time)) ." & ". (($post_val->event_end_time) ? date("h:i A", strtotime($post_val->event_end_time)) : '');
                $postnestedData['is_approved'] = $is_approved;
                $postnestedData['action'] = '<button class="btn btn-sm btn-primary" id="edit_btn" onclick="editEvent('.$post_val->id.')" data-toggle="modal" data-target="#editEventModal"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deleteEvent('.$post_val->id.')" data-toggle="modal" data-target="#deleteEventModal"> <i class="fas fa-trash-alt"></i></button>
                <a href="'.url('admin/export/'.$post_val->id).'" class="btn btn-sm btn-success" style="color:white;">Export</a>
                <a href="'.route('send-ticket', ['id' => $post_val->id]).'" class="btn btn-sm btn-primary mt-1" style="color:white;">Send ticket</a>
                <a href="'.route('history', ['id' => $post_val->id]).'" class="btn btn-sm btn-primary mt-1" style="color:white;">History</a>';
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
    public function addEvent(Request $request){
        $file_name = $request->event_images->getClientOriginalName();
        $imageFileType = $request->event_images->getClientOriginalExtension();
        $file_path = $request->event_images->getPathName();
        $image_name = "event_" . time(). "." . $imageFileType;
        $request->event_images->move(public_path('admin/assets/images/event'), $image_name);
        $images[] = $image_name;

        $data = array(
            'event_name' => $request->event_name,
            'event_host_by' => $request->event_host_by,
            'event_details'=>$request->event_details,
            'event_location' => $request->event_location,
            'event_address' => $request->event_address,
            'event_date' => $request->event_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'event_images' => implode(',', $images),
            'is_feature'=>0,
            'external_ticket_link'=> $request->external_ticket_link
        );
        $add_mind_step = Event::insert($data);
        if ($add_mind_step != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function viewEvent($id) {
        $event = Event::where('id', $id)->get();
        if (!$event) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$event]);
        }
    }
    public function editEvent(Request $request, $id) {
        $get_image = Event::where('id', $id)->get();
        if($request->edit_event_images != null){
            $file_name = $request->edit_event_images->getClientOriginalName();
            $imageFileType = $request->edit_event_images->getClientOriginalExtension();
            $file_path = $request->edit_event_images->getPathName();
            $edit_image_name = "event_" . time() . "." . $imageFileType;
            $request->edit_event_images->move(public_path('admin/assets/images/event'), $edit_image_name);
            $edit_images[] = $edit_image_name;
        }
        if(empty($edit_images)){
            $edit_event_images = $get_image[0]['event_images'];
        }else{
            $edit_event_images = implode(',', $edit_images);
        }
        $edit_mind_step = Event::where('id', $id)
            ->update(['event_name' => $request->edit_event_name,
                'event_host_by'=>$request->edit_event_host_by,
                'event_details'=>$request->edit_event_details,
                'event_location' => $request->edit_event_location,
                'event_address' => $request->edit_event_address,
                'event_date' => $request->edit_event_date,
                'event_start_time' => $request->edit_event_start_time,
                'event_end_time' => $request->edit_event_end_time,
                'event_images' => $edit_event_images,
                'is_feature'=>0,
                'external_ticket_link'=> $request->edit_external_ticket_link
            ]);
        if ($edit_mind_step != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deleteEvent($id) {
        $delete = Event::where('id', $id)->update(['status'=>1]);
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deleteEvents(){
        return view('admin.pages.deleted-events');
    }
    public function alldeletedevent(Request $request){
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'id',
            1 =>'event_images',
            2 =>'event_name',
            3 =>'event_date',
            4=> 'event_location',
            5=> 'event_time',
            6=> 'action',
        );
        $totalDataRecord = Event::where('status',1)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = Event::with('User:id,user_first_name')
                ->where('status',1)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  Event::with('User:id,user_first_name')->where('status',1)->where('event_name','LIKE',"%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
            $totalFilteredRecord = Event::with('User:id,user_first_name')->where('status',1)->where('event_name','LIKE',"%{$search_text}%")
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                if($post_val['user'] == Null){
                    $user_first_name = "admin";
                }else{
                    $user_first_name = $post_val->user['user_first_name'];
                }
                if($post_val->event_images != ''){
                    $image = explode(',', $post_val->event_images);
                    $images = '<img class="storie_img_thumb" src="'.url('/admin/assets/images/event/'.$image[$post_val->is_feature]).'"alt="">';
                }else{
                    $images = '';
                }
                $postnestedData['id'] = $post_val->id ;
                $postnestedData['user_first_name'] = $user_first_name ;
                $postnestedData['event_image'] = $images;
                $postnestedData['event_name'] = $post_val->event_name;
                $postnestedData['event_location'] = $post_val->event_address;
                $postnestedData['event_date'] = $post_val->event_date;
                $postnestedData['event_time'] = date("h:i A", strtotime($post_val->event_start_time)) ." & ". date("h:i A", strtotime($post_val->event_end_time));
                $postnestedData['action'] = '<button class="btn btn-submit add_trending_btn" id="edit_btn" onclick="retoreEvent('.$post_val->id.')" data-toggle="modal" data-target="#restoreEventModal">Restore</button>';
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
    public function restoreEvent(Request $request){
        $restore = Event::where('id', $request->restore_id)->update(['status'=>0]);
        if ($restore != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function eventApproved(Request $request){
        $change = Event::where('id', $request->id)->update(['is_approved'=>$request->status]);
        if ($change != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function export($id){
        $event_name= Event::where('id',$id)->value('event_name');
        return Excel::download(new ExportEvents($id), $event_name.'.csv');
    }
    
    public function sendTicket($id){
        $event = Event::where('id',$id)->get();
        $event_ticket = EventTicket::where('event_id',$id)->get();
        return view('admin.pages.send-event-ticket',compact('event','event_ticket'));
    }
    public function sendEventTicket(Request $request){
        if(User::where('user_email',$request->email)->exists()){
            $user_id = User::where('user_email',$request->email)->value('id');
        }else{
            $user = new User();
            $user->user_first_name = $request->name;
            $user->user_email = $request->email;
            $user->save();
            $user_id = $user->id;
        }
        $ticket = EventTicket::where('id',$request->ticket_id)->get();
        $avail_seats = ($ticket[0]->avail_seats - $request->no_of_tickets);
        EventTicket::where('id',$request->ticket_id)->update(['avail_seats'=>$avail_seats]);

        $str=rand();
        $transaction_order_id = sha1($str);

        $transaction = new Transaction;
        $transaction->transaction_order_id = $transaction_order_id;
        $transaction->payment_mode = 'SSLCommerz';
        $transaction->is_confirmed = 1;
        $transaction->status = 'Complete';
        $transaction->amount = 0;
        $transaction->save();

        $transaction_id = $transaction->id;

        $booking_history = new BookingHistory;
        $booking_history->user_id = $user_id;
        $booking_history->transaction_id = $transaction_id;
        $booking_history->event_id = $request->event_id;
        $booking_history->ticket_id = $request->ticket_id;
        $booking_history->qty = $request->no_of_tickets;
        $booking_history->amount = 0;
        $booking_history->save();

        $booking_history_id = $booking_history->id;

        $options = new QROptions(
          [
            'eccLevel' => QRCode::ECC_L,
            'outputType' => QRCode::OUTPUT_IMAGE_JPG,
            'version' => 5,
          ]
        );
        $qrcode = new QRCode($options);
        $imageString = $qrcode->render($transaction_order_id);
        $image_path = time()."_".Str::random(8).".jpg";
        $imagePath = public_path('front/assets/images/qrcode/'.$image_path);
        file_put_contents($imagePath, file_get_contents($imageString));
        
        if(BookingHistory::where('id',$booking_history_id)->update(['ticket_booking_qr_code'=>$image_path])){

            $data = array(
                'name'=>$request->name,
                'email'=>$request->email,
                'event_name'=>$request->event_name,
                'location'=>$request->event_location,
                'date'=>$request->event_date,
                'time'=>$request->event_start_time,
                'ticket'=>$request->no_of_tickets,
                'total'=>0,
                'qrcode'=>$image_path
            );
            $this->sendingMail($data);
            return response()->json(['message'=>'success', 'status'=>'1']);
        } else {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
    public function sendingMail($data){
        $to_email = $data['email'];
        // $to_email = 'ketan.tupple@gmail.com';
        $to_name = $data['name'];
        // $data = array('voucher_code' => 'ketan');
        Mail::send('front.pages.email.sendMail',$data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Event Booking');
            $message->from('info@bne.live', 'BNE Live');
        });
        return response()->json(['message'=>'success', 'status'=>'1']);
    }
}