@extends('front.layout.main')
@section('header')
    <?php
    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    ?>
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
    <!-- Buy Tickets Section start -->
    <section class="buy_tickets_sec">
        <div class="container">
            <div class="row buy_tickets_row">
                <div class="col-lg-8 col-md-8  col-sm-7 col-xs-12 buy_tickets_left">
                    <div class="event_detail_box_inner">
                        <h1>{{ucwords($event[0]->event_name)}}</h1>
                        <div class="event_btm_detail">
                            <p>Ends {{ date('D, M dS', strtotime($event[0]->event_date)) }}, {{ date('g:i A', strtotime($event[0]->event_end_time)) }}</p>
                            <p>{!! $event[0]->event_address !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4  col-sm-5 col-xs-12 buy_tickets_right text-end">
                    <?php  $image = explode(',', $event[0]->event_images); ?>
                    <img src="{{ asset('admin/assets/images/event/'.$image[$event[0]->is_feature]) }}" class="buy_tickets_img">
                </div>
            </div>
            @foreach($event_ticket as $ticket)
                <div class="tickets_price_list">
                    <div class="tickets_price_list_inner">
                        @if($ticket->avail_seats != 0)
                            <div class="tickets_price_list_left">
                                <img class="ticket_icon" src="{{asset('front/assets/images/ticket.svg')}}" alt="" width="20px">
                                <div class="tickets_price_left_list_inner">
                                    <div class="plan_price_title">{{ucfirst($ticket->ticket_name)}} <span class="plan_price">{{$ticket->description}}</span></div>
                                    <p>৳<span class="plan_sale_price">{{$ticket->ticket_cost}}</span><span class="plan_price_fee">@if($ticket->ticket_fee != 0) + </span><span class="plan_price">৳{{$ticket->ticket_fee}}</span><span class="plan_price_fee">Fee</span>@endif</p>
                                </div>
                            </div>
                            <div class="tickets_price_list_right text-end {{strtolower($ticket->ticket_name)}}_plan">
                                <div class="plan_add_content" >
                                    <button class="plan_add_btn Gold_plan_add theme_btn">Add</button>
                                </div>
                                <div class="plan_quantity_content">
                                    <div class="plan_quntity_btns">
                                        <button class="plan_plus_minus_btn minus_btn theme_btn"><i
                                                class="fa-solid fa-minus"></i></button><span class="qty_count">1</span><button class="plan_plus_minus_btn plus_btn theme_btn"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($ticket->avail_seats == 0)
                            <div class="tickets_price_list_left">
                                <img class="ticket_icon" src="{{asset('front/assets/images/ticket.svg')}}" alt="" width="20px">
                                <div class="tickets_price_left_list_inner">
                                    <div class="plan_price_title" style="color:gray;"><strike>{{ucfirst($ticket->ticket_name)}} <span class="plan_price">{{$ticket->description}}</span></strike></div>
                                    <p style="color:gray;"><strike>৳<span class="plan_sale_price">{{$ticket->ticket_cost}}</strike></span><span class="plan_price_fee"> + <strike></span>@if($ticket->ticket_fee != null) <span class="plan_price">৳{{$ticket->ticket_fee}}</span> @else <span class="plan_price">0</span> @endif<span class="plan_price_fee">Fee</strike></span></p>
                                </div>
                            </div>
                            <div class="plan_add_content">
                                <button class="sold_out">Sold out</button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="tickets_price_coupon_list">
                <div class="tickets_price_list_inner">
                    <div class="tickets_price_list_left">
                        <img class="ticket_icon" src="{{asset('front/assets/images/ic-coupon-code.svg')}}" alt="" width="20px">
                        <div class="tickets_price_left_list_inner">
                            <div class="plan_price_title">Enter coupon code</div>
                        </div>
                    </div>
                    <div class="tickets_price_list_right text-end">
                        <div class="coupon_code_field">
                            <input type="text" class="coupon_field form-control coupon_code" name="coupon_code" id="coupon_code" style="color: white!important;" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row checkout_row">
                <div class="checkout_sec_inner">
                    <div class="d-flex">
                        <div class="pe-2">
                            <input type="checkbox" id="accept" value="1" data-toggle="tooltip" title="Please accept the Terms & Conditions before proceeding.">
                        </div>
                        <div> 
                             <p>I accept the <a href="{{route('termsConditions')}}" class="accept_checkbox" >Terms & Conditions</a>, <a href="{{route('privacyPolicy')}}" class="accept_checkbox">Privacy<br>Policy</a>,
                                <a href="{{route('refundPolicy')}}" class="accept_checkbox">Return Refund Policy</a>  and  <a href="{{route('cancellationPolicy')}}" class="accept_checkbox">Cancellation Policy</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout_sec">
        <div class="container">
            <div class="row checkout_row">
                <div class="checkout_sec_inner">
                    <div class="checkout_sec_left">
                        <div class="checkout_total">৳0</div>
                        <p style="display: inline;">Discount: </p><p class="checkout_discount" style="display: inline;">৳0</p><br>
                        <p style="display: inline;">Total price: </p><p class="checkout_total_price" style="display: inline;">৳0</p><br>
                        <p class="checkout_ticket" style="display: inline;"></p><p style="display: inline;"> Ticket</p>
                    </div>
                    <button class="checkout_sec_right buy_tickets_btn theme_btn" disabled="disabled" style="background-color: #00000061; "><span class="checkout_btn" style="color: #ffffff61">Checkout</span></button>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function($) {

        });
        var tickets = <?php echo $event_ticket; ?>;
        let selected_tickets;
        // this is working solution
        $( ".tickets_price_list ").each(function(index, element) {
            $(this).find('.plan_add_btn').on("click", function(){
                $(this).hide();
                $(element).find(".plan_quantity_content").show();
                $('.checkout_sec_right').removeAttr('disabled');
                $('.checkout_sec_right').removeAttr('style');
                $('.checkout_btn').removeAttr('style');
                $('.coupon_code').removeAttr('readonly');
                $('#coupon_code').val('');
                $('.checkout_discount').text('৳0');
                $('#coupon_code').removeClass('is-invalid');
                $('#coupon_code').removeClass('is-valid');
                
                $(element).find('.plus_btn').removeAttr('disabled').removeAttr('style');
                $('.checkout_ticket').text(1);
                var value = parseFloat($(element).find(".plan_sale_price").text());
                var feeText = $(element).find(".plan_price").text();
                var feeMatch = feeText.match(/(\d+\.\d+)/);
                var fee = feeMatch ? parseFloat(feeMatch[1]) : 0;
                var result =((value) + (fee));
                $('.checkout_total').text('৳'+result.toFixed(2));
                $('.checkout_total_price').text('৳'+result.toFixed(2));
                updateLayout(index,element);
                selected_tickets = tickets[index];
                selected_tickets['ticket_price'] = result;
                
                if(selected_tickets['free_tier_ticket'] == 0){
                    $('.coupon_code').removeAttr('readonly');
                }else{
                    $('.coupon_code').prop('readonly',true);
                }
                // console.log(selected_tickets);
            });
            $(this).find('.plus_btn').on("click", function(){
                // $(this).hide()
                var available_tickets = selected_tickets['avail_seats'];
                let plus_val = $(this).siblings(".qty_count");
                if(selected_tickets['free_tier_ticket'] == 1){
                    if(parseInt(plus_val.text()) + 1 >= 10){
                        $(element).find('.plus_btn').attr('disabled','disabled').css('color','gray');
                    }
                }
                if(parseInt(plus_val.text()) + 1 <= available_tickets){
                    plus_val.text(parseInt(plus_val.text()) + 1);
                    $('.checkout_ticket').text(parseInt(plus_val.text()));
                    var value = parseFloat($(element).find(".plan_sale_price").text());
                    var feeText = $(element).find(".plan_price").text();
                    var feeMatch = feeText.match(/(\d+\.\d+)/);
                    var fee = feeMatch ? parseFloat(feeMatch[1]) : 0;
                    var result =((value) + (fee));
                    var total = ((result) * (parseInt(plus_val.text())));
                    $('.checkout_total').text('৳'+total.toFixed(2));
                    $('.checkout_total_price').text('৳'+total.toFixed(2));
                    selected_tickets['qty']=parseInt(plus_val.text());
                    selected_tickets['ticket_price'] = total;
                }else{
                    $(element).find('.plus_btn').attr('disabled','disabled').css('color','gray');
                }
            });
            $(this).find('.minus_btn').on("click", function(){
                $(element).find('.plus_btn').removeAttr('disabled').removeAttr('style');
                let minus_val = $(this).siblings(".qty_count");
                minus_val.text(parseInt(minus_val.text()) - 1);
                $('.checkout_ticket').text(parseInt(minus_val.text()));
                var value = parseFloat($(element).find(".plan_sale_price").text());
                var feeText = $(element).find(".plan_price").text();
                var feeMatch = feeText.match(/(\d+\.\d+)/);
                var fee = feeMatch ? parseFloat(feeMatch[1]) : 0;
                var result =((value) + (fee));
                var total = ((result) * (parseInt(minus_val.text())));
                $('.checkout_total').text('৳'+total.toFixed(2));
                 $('.checkout_total_price').text('৳'+total.toFixed(2));
                selected_tickets['qty']=parseInt(minus_val.text());
                selected_tickets['ticket_price'] = total;
                if (parseInt(minus_val.text()) == "0") {
                    $('.checkout_sec_right').attr('disabled','disabled');
                    $('.checkout_sec_right').css('background-color','#00000061');
                    $('.checkout_btn').css('color','#ffffff61');
                    $('.checkout_ticket').text("");
                    $(element).find(".plan_quantity_content").hide();
                    $(element).find(".plan_add_btn").show();
                    minus_val.text(1);
                    $('.coupon_code').attr('readonly', true);
                }
            });
        });
        function updateLayout(mindex,element) {
            $( ".tickets_price_list ").each(function(index, element) {
                if(mindex != index){
                    $(element).find(".plan_quantity_content").hide();
                    $(element).find(".plan_add_btn").show();
                    $(this).siblings(".qty_count").text(1);
                    tickets[index]['qty']=0;
                }else{
                    $(".qty_count").text(1);
                    tickets[index]['qty']=1;
                }
            })
        }
        $(document).ajaxSend(function() {
            $("#loader").fadeIn(300);
        });
        $('.checkout_sec_right').on('click',function (){
            if ($('#accept').prop('checked')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('checkout') }}",
                    data: selected_tickets,
                    success: function(response) {
                        if(response['status']==1){
                            window.location.href = "{{ route('booking') }}";  
                        }else{
                            window.location.href=response
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#loader").fadeOut(300);
                    },500);
                });
            } else {
                $('#accept').tooltip('show');
            }
        });
        $('#coupon_code').change(function (){
           var coupon_code = $('#coupon_code').val();
            if(coupon_code != ''){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('check_coupon_code') }}",
                    data: {
                        'data':selected_tickets,
                        'coupon_code':coupon_code
                    },
                    success: function(response) {
                        var total = $('.checkout_total').text();
                        var result = total.substring(1, total.length);
                        if (response['status'] == 2) {
                            $(".coupon_code").addClass('is-invalid');
                            $("#coupon_code").after(
                                '<span class="error">Sorry this coupon is expired</span>'
                            );
                        }
                        if (response['status'] == 1) {
                            if(response['data'][0]['discount_flag'] == '$'){
                                selected_tickets['coupon_id'] = response['data'][0]['id'];
                                var discount_value = response['data'][0]['coupon_value']
                                var checkout_total = result - response['data'][0]['coupon_value'];
                                $('.checkout_total').text('৳'+checkout_total.toFixed(2));
                                $('.checkout_discount').text('৳'+discount_value);
                                selected_tickets['ticket_price'] = checkout_total.toFixed(2);
                                $(".coupon_code").addClass('is-valid');
                                 $(".coupon_code").removeClass('is-invalid');
                                $(".coupon_code").next("span").remove();
                            }else {
                                selected_tickets['coupon_id'] = response['data'][0]['id'];
                                var checkout_total = (result * response['data'][0]['coupon_value'])/100;
                                var total = result - checkout_total;
                                $('.checkout_discount').text('৳'+checkout_total.toFixed(2));
                                $('.checkout_total').text('৳'+total.toFixed(2));
                                selected_tickets['ticket_price'] = total.toFixed(2);
                                $(".coupon_code").addClass('is-valid');
                                 $(".coupon_code").removeClass('is-invalid');
                                $(".coupon_code").next("span").remove();
                            }
                        }
                        if (response['status'] == 0) {
                             $(".coupon_code").removeClass('is-valid');
                            $(".coupon_code").addClass('is-invalid');
                            var total = (+selected_tickets['ticket_cost'] + +selected_tickets['ticket_fee']) * selected_tickets['qty'];
                            console.log(total);
                            selected_tickets['ticket_price'] = total.toFixed(2);
                            $('.checkout_total').text('৳'+total.toFixed(2));
                            $('.checkout_discount').text('৳0');
                            $("#coupon_code").after(
                                '<span class="error">Sorry this coupon is not found</span>'
                            );
                        }
                        if (response['status'] == 3) {
                             $(".coupon_code").removeClass('is-valid');
                            $(".coupon_code").addClass('is-invalid');
                            $("#coupon_code").after(
                                '<span class="error">Sorry this coupon allready used</span>'
                            );
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#loader").fadeOut(300);
                    },500);
                });
            }else{
                $(".coupon_code").removeClass('is-valid');
                $(".coupon_code").removeClass('is-invalid');
                $(".coupon_code").next("span").remove();
                var total = (+selected_tickets['ticket_cost'] + +selected_tickets['ticket_fee']) * selected_tickets['qty'];
                selected_tickets['ticket_price'] = total.toFixed(2);
                $('.checkout_total').text('৳'+total.toFixed(2));
                $('.checkout_discount').text('৳0');
           }
        });
    </script>
@endsection
