@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
    <style>
        .bookig_top_heaer_title{
            font-weight: 600!important;
        }
    </style>
@endsection
@section('content')
<section class="event_detail_sec bookings_list_sec" style="padding: 20px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <a href="#" onclick="history.back()" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body" style="background: #f7f7f7; border: 1px solid #e1dede;">
                <div class="bookig_top_heaer">
                    <div class="row">
                        <div class="col-lg-3">User name</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{ucwords($booking_history[0]->User['user_first_name'])}} {{ucwords($booking_history[0]->User['user_last_name'])}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">User email</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->User['user_email']}}</h6>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-3">Event name</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->Event['event_name']}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Event date</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->Event['event_date']}}</h6>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-3">Ticket tier</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->EventTicket['ticket_name']}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">No of Tickets</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->qty}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Total Ticket Price</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">৳{{$booking_history[0]->amount}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Coupon Code</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{ ($booking_history[0]->coupon_id != null) ? $booking_history[0]->Coupon['coupon_code'] : 'Not coupon used' }} </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">QR code Image</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title"><img width="130px;" src="{{asset('front/assets/images/qrcode/'.$booking_history[0]->ticket_booking_qr_code)}}"/> </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Payment ID</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->Transaction['transaction_order_id']}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Date and time of booking</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{$booking_history[0]->created_at}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">Scanned or not scanned</div>
                        <div class="col-lg-9">
                            <h6 class="bookig_top_heaer_title">{{ ($booking_history[0]->Transaction['ticket_scan_status'] == 1) ? 'scanned' : 'Not scanned' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
