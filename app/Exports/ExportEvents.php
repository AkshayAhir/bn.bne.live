<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\BookingHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportEvents implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $event_id;

    public function __construct(int $id)
    {
        $this->event_id = $id;
    }
    public function headings(): array
    {
        return [
            "ID", "Event Name","User First Name","User Last  Name","User Email","User phone","Ticket type","Ticket Price","Ticket Qty","Transaction ID","Date"
        ];
    }
    public function collection()
    {
        $collect_data = [];
        $post_data = BookingHistory::with('Transaction:id,transaction_order_id,created_at')
            ->with('User:id,user_first_name,user_last_name,user_email,user_number')
            ->with('EventTicket:id,ticket_name')
            ->with('Event:id,event_name')
            ->where('event_id',$this->event_id)
            ->get();

        foreach(json_decode($post_data, true) as $data) {
            $collect_data[] = [
                "ID" => $data['id'],
                "Event Name" => $data['event']['event_name'],
                "User First Name" => $data['user']['user_first_name'],
                "User Last Name" => $data['user']['user_last_name'],
                "User Email" => $data['user']['user_email'],
                "User Phone" => $data['user']['user_number'],
                "Ticket Type" => $data['event_ticket']['ticket_name'],
                "Ticket Price" => "$".$data['amount'],
                "Ticket Qty"=>$data['qty'],
                "Transaction ID" => $data['transaction']['transaction_order_id'],
                "Date"=>date('Y-m-d',strtotime($data['transaction']['created_at']))
            ];
        }
        return collect($collect_data);
    }
}
