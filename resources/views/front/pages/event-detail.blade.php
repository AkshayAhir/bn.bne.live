@extends('front.layout.main')
@section('header')
    <?php
    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    ?>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('title')
    <?php
        function removeTagsFromParagraph($html) {
        // Remove HTML tags from the paragraph, including nested tags
        $cleanedText = preg_replace('/<[^>]*>/', '', $html);
        return $cleanedText;
    }
    $cleanedText = removeTagsFromParagraph($event[0]->event_details);
    ?>
    <title>{{env('APP_NAME')}} | {{ucwords($event[0]->event_name)}}</title>
    <!--<link rel="stylesheet" href="{{asset('front/assets/css/needsharebutton.min.css')}}">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/assisfery/SocialShareJS@1.4/social-share.min.css">
    <?php  $image = explode(',', $event[0]->event_images);?>
    <meta name="title" content="{{ucwords($event[0]->event_name)}}">
    <meta name="description" content="{{$cleanedText}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url('/event-details/'.$event[0]->id)}}">
    <meta property="og:title" content="{{ucwords($event[0]->event_name)}}">
    <meta property="og:description" content="{{$cleanedText}}">
    <meta property="og:image" content="{{ asset('admin/assets/images/event/'.$image[$event[0]->is_feature]) }}">
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:domain" content="bnelive.tuppleapps.com"/>
@endsection
@section('main')
<?php
        use Carbon\Carbon;
        $start = $event[0]->event_date ." ".$event[0]->event_start_time;
        $carbon = Carbon::parse($start);
        $utc = $carbon->utc();
        $event_start_time = $utc->format('Ymd\THis');

        $end = $event[0]->event_date ." ".$event[0]->event_end_time;
        $carbon = Carbon::parse($end);
        $utc = $carbon->utc();
        $event_end_time = $utc->format('Ymd\THis');

//        echo $event_start_time;
        $url = "https://www.google.com/calendar/render?action=TEMPLATE&sf=true&output=xml&text=".ucwords($event[0]->event_name)."&location=".$event[0]->event_location."&dates=".$event_start_time."/".$event_end_time;
    ?>
<!-- Event detail Section start -->
<div><div class="alert alert-danger d-none like_error">Only login user can like.</div></div>
<section class="event_detail_sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 event_detail_left">
                <div class="event_detail_left_inner">
{{--                    <img src="{{ asset('front/assets/images/event.jpg') }}" class="event_detail_img w-100">--}}
                    <?php  $image = explode(',', $event[0]->event_images);?>
                    <img src="{{ asset('admin/assets/images/event/'.$image[$event[0]->is_feature]) }}" class="event_list_img">
                    <div class="event_img_btm_txt">
                        <!--@if(!$event_like)-->
                        <!--<i class="fa-regular fa-heart event_like_icon" onclick="eventLike({{$event[0]->id}})"></i>-->
                        <!--@else-->
                        <!--<i class="fa-solid fa-heart event_like_icon" style="color:red" onclick="eventLike({{$event[0]->id}})"></i>-->
                        <!--@endif-->
                        @if($event[0]->external_ticket_link != null)
                            <a href="{{$event[0]->external_ticket_link}}" target="_blank" class="buy_tickets_btn theme_btn">Buy Tickets</a>
                        @else
                            <a onclick="buyTicket({{$event[0]->id}})" class="buy_tickets_btn theme_btn">Buy Tickets</a>
                        @endif
                    </div>
                    
                    <div class="share_event_txt text-end">
                        <!--<img src="{{ asset('front/assets/images/share.svg') }}" alt=""><span><a href="">Share event</a></span>-->
                        <!--<img src="{{ asset('front/assets/images/share.svg') }}" alt=""><span><a style="cursor: pointer" id="share-event-button" class="share_event need-share-button-default" data-share-icon-style="box" data-share-networks="Mailto,Twitter,Facebook,Linkedin"></a></span>-->
                        <img src="{{ asset('front/assets/images/share.svg') }}" alt=""><span><a style="cursor: pointer" id="share-event-button" onclick="createNewShareBox()">Share event</a></span>
                        <div id="newShareBox" class="ss-circle ss-float" data-ss-content="false"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 event_detail_right">
                <div class="event_detail_box_inner">
                    <h1>{{ucwords($event[0]->event_name)}}</h1>
                    <div class="host_txt d_flex">
                        <img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px">
                        <div class="event_right_txt" ><span>Hosted By </span><a href="{{url('hosted/'.$event[0]->event_host_by)}}" style="display: inline">{{ucwords($event[0]->event_host_by)}}</a></div>
                    </div>
                    <div class="event_schedule_txt d_flex">
                        <img src="{{asset('front/assets/images/clock.svg')}}" alt="" width="20px">
                        <div class="event_right_txt">
                            <div class="event_date_txt"><span>{{ date('l, M dS, Y', strtotime($event[0]->event_date)) }}, {{ date('g:i A', strtotime($event[0]->event_start_time)) }}</span></div>
                            <p>Ends {{ date('D, M dS', strtotime($event[0]->event_date)) }}, {{ date('g:i A', strtotime($event[0]->event_end_time)) }}</p>
                            <p><a href="{{$url}}" target="_blank" id="addToCalender">Add to calendar</a></p>
                        </div>
                    </div>
                    <div class="event_location_txt d_flex">
                        <img class="ticket_icon" src="{{asset('front/assets/images/map.svg')}}" alt="" width="20px">
                        <div class="event_right_txt">
                            <div class="event_date_txt"><span>{{$event[0]->event_location}}</span></div>
                            <p>{!! $event[0]->event_address !!}</p>
                        </div>
                    </div>

                    <div class="tickets_price_list_left">
                        <img class="ticket_icon" src="{{asset('front/assets/images/ticket.svg')}}" alt="" width="20px">
                        <div class="tickets_price_left_list_inner">
                            <p>৳<span class="plan_sale_price">{{$event_ticket}}</span><span class="plan_price">onwards</span></p>
                        </div>
                    </div>
                    <div class="event_btm_detail">
                        <div class="event_btm_detail_title">Event Details</div>
                        <p class="event_details">{!! $event[0]->event_details !!}</p>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--login Modal -->
<div class="modal fade modal-sm" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLongTitle" style="color: black">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user_login">
                    @csrf
                    <div class="form-group">
                        <label for="user_email" class="col-form-label" style="color: black">Email</label>
                        <input type="text" class="form-control border" id="user_email" name="user_email" placeholder="Enter your email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label" style="color: black">Password</label>
                        <input type="password" class="form-control border" id="password" name="password" placeholder="Enter your password" autocomplete="off">
{{--                        <textarea class="form-control" id="message-text"></textarea>--}}
                    </div>
                    <div class="form_group text-center">
                        <button class="form_submit_btn login-theme_btn w-100">Login</button>
                    </div>
                    <p class="text-center text-dark">Don’t have an account? <a href="{{route('user_register')}}" class="text-dark"><b>Register</b></a></p>
                    <p class="text-center text-dark">Continue as a <a class="text-dark guest-user" style="cursor: pointer;"><b>Guest user</b></a></p>
                    <div class="alert alert-danger form_error_alert" style="display: none">
                        Login credentials are incorrect
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Guest user Modal -->
<div class="modal fade modal-sm" id="guestModal" tabindex="-1" role="dialog" aria-labelledby="guestModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guestModalLongTitle" style="color: black">Guest Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="guest_user_login">
                    @csrf
                     <div class="form-group">
                        <label for="user_name" class="col-form-label" style="color: black">First name</label>
                        <input type="text" class="form-control border" id="guest_user_first_name" name="guest_user_first_name" placeholder="Enter your first name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user_name" class="col-form-label" style="color: black">Last name</label>
                        <input type="text" class="form-control border" id="guest_user_last_name" name="guest_user_last_name" placeholder="Enter your last name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="col-form-label" style="color: black">Email</label>
                        <input type="text" class="form-control border" id="guest_user_email" name="guest_user_email" placeholder="Enter your email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user_number" class="col-form-label" style="color: black">Number</label>
                        <input type="text" class="form-control border" id="guest_user_number" name="guest_user_number" placeholder="Enter your number" autocomplete="off">
                    </div>
                    <div class="form_group">
                        <button class="form_submit_btn login-theme_btn w-100">Submit</button>
                    </div>
                    <p class="text-center text-dark">Don’t have an account? <a href="{{route('user_register')}}" class="text-dark"><b>Register</b></a></p>
                    {{--                        <p class="text-center text-dark">Login <a class="text-dark" style="cursor: pointer;"><b>Guest user</b></a></p>--}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/assisfery/SocialShareJS@1.4/social-share.min.js"></script>
    <script>

        function createNewShareBox(){
            // SocialShare.createShareBox("#newShareBox", _link = null, _socials =  null, _showIcon = true, _showContent = true, _clearContainer = true);
    
            // SocialShare.createShareBox("#newShareBox", null, null, true, true, true);
    
            // SocialShare.createShareBox("#newShareBox", "Join me at this event - {{ucwords($event[0]->event_name)}} - {{url('/event-details/'.$event[0]->id)}}", "facebook, twitter, whatsapp");
            SocialShare.createShareBox("#newShareBox", "{{url('/event-details/'.$event[0]->id)}} - {{ucwords($event[0]->event_name)}} - Join me at this event", "facebook, twitter, whatsapp");
        }
        function eventLike(event_id) {
           // alert(event_id);
           var loggedIn={!! json_encode(Auth::check()) !!};
            if(loggedIn){
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': "GET, PUT, POST, DELETE, HEAD, OPTIONS"
                },
                type: 'POST',
                url: "{{ url('event-like') }}/" + event_id,
                processData: false,
                contentType: false,
                success: function(response) {

                    console.log(response);
                    if (response['status'] == 1) {
                        window.location.href="{{ url('event-details') }}/" + event_id
                    }
                    if (response['status'] == 2) {
                        // console.log(response);
                        window.location.href="{{ url('event-details') }}/" + event_id

                    }
                }
            })
            }else{
                $('.alert-danger').removeClass('d-none');
                // $('.alert-danger').html(response.message);
                setTimeout(function() {
                    $('.alert-danger').addClass('d-none');
                        // location.reload();
                    }, 500);
            }
            
        }
    //   new needShareDropdown(document.getElementById('share-event-button'));
       
       var event_id;
        function buyTicket(id){
            event_id=id;
            var loggedIn={!! json_encode(Auth::check()) !!};
            var logged = "{{ Session::get('user') }}";
            if(loggedIn){
                window.location.href="{{ url('buy-ticket') }}/" + event_id
            }else if(logged != "") {
                window.location.href="{{ url('buy-ticket') }}/" + event_id
            }
            else{
                $('#loginModal').modal("show");
            }
        }
        function loginFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#user_email').val() == "") {
                $("#user_email").after(
                    '<span class="error">Email field is required</span>'
                );
                valid = false;
            }
            if ($('#password').val() == "") {
                $("#password").after(
                    '<span class="error">Password field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        function guestLoginFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#guest_user_name').val() == "") {
                $("#guest_user_name").after(
                    '<span class="error">Name field is required</span>'
                );
                valid = false;
            }
            if ($('#guest_user_email').val() == "") {
                $("#guest_user_email").after(
                    '<span class="error">Email field is required</span>'
                );
                valid = false;
            }
            if ($('#guest_user_number').val() == "") {
                $("#guest_user_number").after(
                    '<span class="error">Number field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#user_login').submit(function(event) {
            event.preventDefault();
            {{--var event_id = <?php echo json_encode($event[0]->id); ?>;--}}
            var formData = new FormData($(this)[0]);
            if(loginFieldValidation()){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('checkout-user-login') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response);
                        if (response['status'] == 1) {
                            // console.log(response);
                            $('#loginModal').modal("hide");
                            // checkout();
                            window.location.href="{{ url('buy-ticket') }}/" + event_id
                        }else{
                            $('.form_error_alert').removeAttr('style');
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#loader").fadeOut(300);
                    },500);
                });
            }
        });
        $('#guest_user_login').submit(function(event) {
            event.preventDefault();
            {{--var event_id = <?php echo json_encode($event[0]->id); ?>;--}}
            var formData = new FormData($(this)[0]);
            if(guestLoginFieldValidation()){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('guest-user-login') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response);
                        if (response['status'] == 1) {
                            $('#loginModal').modal("hide");
                            $('#guestModal').modal("hide");
                            window.location.href="{{ url('buy-ticket') }}/" + event_id
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#loader").fadeOut(300);
                    },3000);
                });
            }
        });
        $('.guest-user').on('click',function (){
            $('#loginModal').modal("hide");
            $('#guestModal').modal("show");
        });
    </script>
@endsection