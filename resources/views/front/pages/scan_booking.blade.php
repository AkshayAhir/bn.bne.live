@extends('front.layout.scanMain')
@section('title')
    <title>{{env('APP_NAME')}} | Booking history</title>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')

    <!-- Bookings Section start -->
    <section class="event_detail_sec bookings_list_sec">
        <div class="container">
            <div class="booking_list_row">
                <div class="booking_list_left">
                    <div class="booking_list_left_col">
                        <?php  $image = explode(',', $bookings[0]['EventBooking'][0]['event_images']); ?>
                        <img src="{{ asset('admin/assets/images/event/'.$image[$bookings[0]['EventBooking'][0]['is_feature']]) }}" class="booking_list_img w-100">
                    </div>
                    <div class="booking_list_right_col">
                        <div class="booking_list_inner">
                            <h2>{{$bookings[0]['EventBooking'][0]['event_name']}}</h2>
                            <div class="bkng_host_txt">
                                <p class="booking_heading_txt">User name :</p>
                                <p class="booking_ans_txt">{{$bookings[0]['User']['user_name']}}</p>
                            </div>
                            <div class="bkng_host_txt">
                                <p class="booking_heading_txt">User Email :</p>
                                <p class="booking_ans_txt">{{$bookings[0]['User']['user_email']}}</p>
                            </div>
                            <div class="bkng_host_txt">
                                <p class="booking_heading_txt">User phone :</p>
                                <p class="booking_ans_txt">{{$bookings[0]['User']['user_number']}}</p>
                            </div>
                            <div class="bkng_host_txt">
                                <p class="booking_heading_txt">Hosted By :</p>
                                <p class="booking_ans_txt">{{$bookings[0]['EventBooking'][0]['event_host_by']}}</p>
                            </div>
                            <div class="bkng_schedule_txt">
                                <p class="booking_heading_txt">Event Date & Time :</p>
                                <p class="booking_ans_txt">{{ date('D, M dS', strtotime($bookings[0]['EventBooking'][0]['event_date'])) }}, {{ date('g:i A', strtotime($bookings[0]['EventBooking'][0]['event_start_time'])) }}</p>
                            </div>
                            <div class="bkng_location_txt">
                                <p class="booking_heading_txt">Location :</p>
                                <p class="booking_ans_txt">{{$bookings[0]['EventBooking'][0]['event_location']}}</p>
                            </div>
                            <div class="bkng_ticket_txt">
                                <div class="bkng_ticket_left">
                                    <p class="booking_heading_txt">Total Ticket :</p>
                                    <p class="booking_ans_txt">{{$bookings[0]['qty']}}</p>
                                </div>
                            </div>
                            <div class="bkng_total_box">
                                <div class="bkng_total_box_inner bkng_ticke_price">
                                    <p class="booking_heading_txt">Ticket Price :</p>
                                    <p class="booking_ans_txt">${{$bookings[0]['EventTicket']['ticket_cost'] * $bookings[0]['qty']}}</p>
                                </div>
                                <div class="bkng_total_box_inner bkng_convenience_fee">
                                    <p class="booking_heading_txt">Convenience Fees (Inc.tex) :</p>
                                    <p class="booking_ans_txt">${{$bookings[0]['amount'] - $bookings[0]['EventTicket']['ticket_cost'] * $bookings[0]['qty']}}</p>
                                </div>
                                <div class="bkng_total_box_inner bkng_total_amnt">
                                    <p class="booking_heading_txt">Total Amount :</p>
                                    <p class="booking_ans_txt mb-0">${{$bookings[0]['amount']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="booking_list_right">
                    <div class="booking_qr_code_sec">
                        <img class="booking_qr_code_img" src="{{asset('front/assets/images/qrcode/'.$bookings[0]['ticket_booking_qr_code'])}}" alt="">
                    </div>
                    <p class="booking_heading_txt">Booking id :</p>
                    <p class="booking_ans_txt">#{{$bookings[0]['id']}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Bookings Section end -->
@endsection
