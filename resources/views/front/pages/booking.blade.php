@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Booking history</title>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    @if(Session::has('sent'))
        <div><div class="alert alert-success">{{Session::get('sent')}}</div></div>
    @endif
    @if(Session::has('notSent'))
        <div><div class="alert alert-danger">{{Session::get('notSent')}}</div></div>
    @endif
    <div id="status"></div>
    <!-- Bookings Section start -->
    <section class="event_detail_sec bookings_list_sec">
        <div class="container">
            <div class="bookig_top_heaer">
                <h1 class="bookig_top_heaer_title">My Bookings</h1>
            </div>
            @if($booking->isEmpty())
                <div class="booking_list_row text-center" style="display: block">
                    <h5>You don't have booking</h5>
                </div>
            @else
                @foreach($booking as $bookings)
                    <div class="booking_list_row">
                        <div class="booking_list_left">
                            <div class="booking_list_left_col">
                                <?php  $image = explode(',', $bookings['EventBooking'][0]['event_images']); ?>
                                <img src="{{ asset('admin/assets/images/event/'.$image[$bookings['EventBooking'][0]['is_feature']]) }}" class="booking_list_img w-100">
                            </div>
                            <div class="booking_list_right_col">
                                <div class="booking_list_inner">
                                    <h2>{{$bookings['EventBooking'][0]['event_name']}}</h2>
                                    <div class="bkng_host_txt">
                                        <p class="booking_heading_txt">Hosted By :</p>
                                        <p class="booking_ans_txt">{{$bookings['EventBooking'][0]['event_host_by']}}</p>
                                    </div>
                                    <div class="bkng_schedule_txt">
                                        <p class="booking_heading_txt">Event Date & Time :</p>
                                        <p class="booking_ans_txt">{{ date('D, M dS', strtotime($bookings['EventBooking'][0]['event_date'])) }}, {{ date('g:i A', strtotime($bookings['EventBooking'][0]['event_start_time'])) }}</p>
                                    </div>
                                    <div class="bkng_location_txt">
                                        <p class="booking_heading_txt">Location :</p>
                                        <p class="booking_ans_txt">{{$bookings['EventBooking'][0]['event_location']}}</p>
                                    </div>
                                    <div class="bkng_ticket_txt">
                                        <div class="bkng_ticket_left">
                                            <p class="booking_heading_txt">Total Ticket :</p>
                                            <p class="booking_ans_txt">{{$bookings['qty']}}</p>
                                        </div>
                                    </div>
                                    <div class="bkng_total_box">
                                        <div class="bkng_total_box_inner bkng_ticke_price">
                                            <p class="booking_heading_txt">Ticket Price :</p>
                                            <p class="booking_ans_txt">৳{{$bookings['EventTicket']['ticket_cost'] * $bookings['qty']}}</p>
                                        </div>
                                        <div class="bkng_total_box_inner bkng_convenience_fee">
                                            <p class="booking_heading_txt">Convenience Fees (Inc.tex) :</p>
                                            <p class="booking_ans_txt">৳{{$bookings['EventTicket']['ticket_fee'] * $bookings['qty']}}</p>
                                        </div>
                                         <div class="bkng_total_box_inner bkng_convenience_fee">
                                            <p class="booking_heading_txt">Discount :</p>
                                            <?php $total_fee = $bookings['EventTicket']['ticket_fee'] * $bookings['qty'];
                                                $ticket_price = $bookings['EventTicket']['ticket_cost'] * $bookings['qty'];
                                                $total = $ticket_price + $total_fee;
                                            ?>
                                            <p class="booking_ans_txt">৳{{$total - $bookings['amount']}}</p>
                                        </div>
                                        <div class="bkng_total_box_inner bkng_total_amnt">
                                            <p class="booking_heading_txt">Total Amount :</p>
                                            <p class="booking_ans_txt mb-0">৳{{$bookings['amount']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="booking_list_right">
                            <div class="booking_qr_code_sec">
                                <img class="booking_qr_code_img" src="{{asset('front/assets/images/qrcode/'.$bookings['ticket_booking_qr_code'])}}" alt="">
                            </div>
                            <p class="booking_heading_txt">Booking id :</p>
                            <p class="booking_ans_txt">#{{$bookings['id']}}</p>
                            @if($bookings['ticket_booking_qr_code'] == null)
                                <div class="event_img_btm_txt">
                                    <a onclick="getQrCode({{$bookings['id']}})" class="buy_tickets_btn theme_btn">Get QR Code</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $booking->onEachSide(2)->links('vendor.pagination.bootstrap-4')}}
                </div>
            @endif
        </div>
    </section>
    <!-- Bookings Section end -->
@endsection
@section('scripts')
<script>
    $(document).ready(function (){
        var set = "<?= Session::get('sent')?>";
        var notSent = "<?= Session::get('notSent')?>";
        if(set != "" || notSent!= ""){
            <?php Session::forget('sent'); ?>
            <?php Session::forget('notSent'); ?>
            setTimeout(function() {
                window.location.href="{{ url('booking') }}"
            }, 3000);
        }
    })
    $(document).ready(function() {
        $('.alert-success').delay(3000).fadeOut('slow', function() {
            var urlWithoutQuery = window.location.origin + window.location.pathname;
            history.replaceState(null, null, urlWithoutQuery);
        });
    });
    function getQrCode(booking_id){
         $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{ route('get-qr-code') }}",
            data: {
                booking_id:booking_id,
            },
            success: function(response) {
                if (response['status'] == 1) {
                    $('#status').append('<div><div class="alert alert-success">QR code successfully created </div></div>');
                    setTimeout(function() {
                        window.location.href="{{ url('booking') }}"
                    }, 2000); 
                }else{
                    $('#status').append('<div><div class="alert alert-danger">There was an error. Please try again to generate QR Code.</div></div>');
                    setTimeout(function() {
                        window.location.href="{{ url('booking') }}"
                    }, 2000); 
                }
            }
        }).done(function() {
            setTimeout(function(){
                $("#loader").fadeOut(300);
            },500);
        });
    }
</script>
@endsection