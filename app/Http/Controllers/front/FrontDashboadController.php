<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\BookingHistory;
use App\Models\Event;
use App\Models\Page;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontDashboadController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            //start total sold and total revenue query
            $startdate = Carbon::now()->startOfMonth();
            $enddate = Carbon::now()->addDay();
            $total_tickets_sold = BookingHistory::select(DB::raw("(SUM(qty)) as total_sold, FORMAT(SUM(amount), 2) as total_revenue"))
                ->whereBetween('created_at', [$startdate, $enddate])
                ->whereHas('Event', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })
                ->get();
            //end total sold and total revenue query
    
            //start popular event
            $popular_event = BookingHistory::join(DB::raw('(SELECT SUM(event_tickets.total_ticket) as total_tickets, event_id FROM event_tickets GROUP BY event_id) EventTickets'),
                function($join) {
                    $join->on('booking_histories.event_id', '=', 'EventTickets.event_id');
                })
                ->with('Event:id,event_name,event_date')
                ->select('EventTickets.total_tickets', 'booking_histories.event_id', DB::raw('SUM(booking_histories.qty) as total_sold'))
                ->groupBy('EventTickets.total_tickets','booking_histories.event_id')
                ->orderBy('total_sold', 'desc')
                ->whereHas('Event', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })
                ->get()
                ->toArray();
            //end popular event
    
            //start list of events
            $list_of_event = Event::join(DB::raw('(SELECT SUM(booking_histories.qty) as total_sold, FORMAT(SUM(booking_histories.amount), 2) as total_revenue, event_id FROM booking_histories GROUP BY event_id) BookingHistories'),
                function($join) {
                    $join->on('events.id', '=', 'BookingHistories.event_id');
                })
                ->join(DB::raw('(SELECT SUM(event_tickets.avail_seats) as avail_seats, event_id FROM event_tickets GROUP BY event_id) EventTickets'),
                    function($join) {
                        $join->on('events.id', '=', 'EventTickets.event_id');
                    })
                ->select('EventTickets.avail_seats','BookingHistories.total_sold','BookingHistories.total_revenue','id','event_name')
                ->where('user_id',$user_id)
                ->limit(10)
                ->get()
                ->toArray();
            $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
            //end list of events
            return view('front.pages.dashboard',compact('total_tickets_sold','popular_event','list_of_event','page'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function dateChange(Request $request){
        $user_id = Auth::user()->id;
        $data = explode( ' - ', $request->date );
        if($data[0] == $data[1]){
            $startDate = date("Y-m-d", strtotime($data[0]));
        }else{
            $startDate = Carbon::parse( $data[0])->subDays(1)->format('Y-m-d');
        }
        $endDateRecord=Carbon::parse( $data[1])->addDays(1)->format('Y-m-d');
        $endDate= $data[1];
        $dateRange = collect();
        $currentDate = Carbon::now()->format('Y-m-d');
        for ($date = Carbon::parse($startDate); $date->lte($endDate); $date->addDay()) {
            if ($date->format('Y-m-d') !== $currentDate) {
                $dateRange->push($date->toDateString());
            }else{
                $dateRange->push($date->toDateString());
            }
        }
        $dateRange->toArray();
        $current_date_wise = BookingHistory::select(DB::raw("DATE(created_at) as date, REPLACE(FORMAT(SUM(amount), 2), ',', '') as sum_data"))
            ->whereBetween('created_at', [$startDate, $endDateRecord])
            ->groupBy('date')
            ->whereHas('Event', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->pluck('sum_data', 'date');
        $current_date_wiseData = $dateRange->map(function ($date) use ($current_date_wise) {
            $formattedDate = Carbon::parse($date)->toDateString();
            return [
                'date' => $date,
                'sum_data' => isset($current_date_wise[$formattedDate]) ? $current_date_wise[$formattedDate] : 0,
            ];
        });
        $current_date_wiseData->values()->toArray();
        return $current_date_wiseData;
    }
}
