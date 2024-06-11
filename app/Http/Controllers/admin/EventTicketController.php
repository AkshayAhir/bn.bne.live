<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTicket;
class EventTicketController extends Controller
{
    public function index(){
        $event = Event::where('status',0)->get();
        return view('admin.pages.event_ticket',compact('event'));
    }
    public function allticket(Request $request) {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'event_tickets.id',
            1 =>'events.event_name',
            2 =>'ticket_name',
            3 =>'ticket_cost',
            4 =>'total_ticket',
            5=> 'avail_seats',
            6=> 'ticket_fee',
            7=> 'description',
            8=> 'action',
        );
        $totalDataRecord = EventTicket::where('status',0)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value'))) {
            $post_data = EventTicket::
                join('events', 'events.id', '=', 'event_tickets.event_id')
                ->select('events.event_name','event_tickets.*')
                ->where('event_tickets.status',0)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  EventTicket:: join('events', 'events.id', '=', 'event_tickets.event_id')
                ->select('events.event_name','event_tickets.*')->where('events.event_name','LIKE',"%{$search_text}%")
                ->where('event_tickets.status',0)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
            $totalFilteredRecord = EventTicket:: join('events', 'events.id', '=', 'event_tickets.event_id')
                ->select('events.event_name','event_tickets.*')->where('events.event_name','LIKE',"%{$search_text}%")
                ->where('event_tickets.status',0)
                ->count();
        }
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                $postnestedData['id'] = $post_val->id;
                $postnestedData['event_name'] = $post_val->event_name;
                $postnestedData['ticket_name'] = $post_val->ticket_name;
                $postnestedData['ticket_cost'] = $post_val->ticket_cost;
                $postnestedData['total_ticket'] = $post_val->total_ticket;
                $postnestedData['avail_seats'] = $post_val->avail_seats;
                $postnestedData['ticket_fee'] = $post_val->ticket_fee;
                $postnestedData['description'] = $post_val->description;
                $postnestedData['action'] = '<button class="btn btn-sm btn-primary" id="edit_btn" onclick="editEventTicket('.$post_val->id.')" data-toggle="modal" data-target="#editEventTicketModal"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deleteEventTicket('.$post_val->id.')" data-toggle="modal" data-target="#deleteEventTicketModal"> <i class="fas fa-trash-alt"></i></button>';
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
    public function addEventTicket(Request $request){
        $data = array(
            'event_id' => $request->event_id,
            'ticket_name'=>$request->ticket_name,
            'ticket_cost' => $request->ticket_cost,
            'total_ticket'=>$request->avail_seats,
            'avail_seats' => $request->avail_seats,
            'ticket_fee' => $request->ticket_fee,
            'description' => $request->description,
        );
        if (isset($request['apply_free_ticket'])) {
            $data['free_tier_ticket'] = $request['apply_free_ticket'];
        }
        $add_ticket = EventTicket::insert($data);
        if ($add_ticket != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function editEventTicket(Request $request, $id) {
        if (isset($request['edit_apply_free_ticket'])) {
            $free_tier_ticket = $request['edit_apply_free_ticket'];
        }else{
            $free_tier_ticket = 0;
        }
        $edit_event_ticket = EventTicket::where('id', $id)
            ->update(['event_id' => $request->edit_event_id,
                'ticket_name'=>$request->edit_ticket_name,
                'ticket_cost' => $request->edit_ticket_cost,
                'total_ticket' => $request->edit_total_ticket,
                'avail_seats' => $request->edit_avail_seats,
                'ticket_fee' => $request->edit_ticket_fee,
                'description' => $request->edit_description,
                'free_tier_ticket'=>$free_tier_ticket
            ]);
        if ($edit_event_ticket != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function viewEventTicket($id) {
        $event = EventTicket::where('id', $id)->get();
        if (!$event) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1', 'data'=>$event]);
        }
    }
    public function deleteEventTicket($id) {
        $delete = EventTicket::where('id', $id)->update(['status'=>1]);
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
}