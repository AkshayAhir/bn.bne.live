@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Send-Event-Ticket</title>
    <style>
        .plan_plus_minus_btn {
            padding-left: 3px;
            padding-right: 3px;
            border: 0.6px solid black;
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 21px;
            text-align: center;
            cursor: pointer;
        }
        .qty_count {
            font-size: 14px;
            font-weight: 500;
            padding: 0 10px;
        }
        .bookig_top_heaer_title{
            font-weight: 600!important;
        }
    </style>
@endsection
@section('content')
    <section class="event_detail_sec bookings_list_sec" style="padding: 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{route('admin.event')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="add_event_table">
                <div class="card mb-4">
                    <div class="card-body" style="background: #f7f7f7; border: 1px solid #e1dede;">
                        <div class="bookig_top_heaer">
                            <div class="row">
                                <div class="col-lg-4">Event name:</div>
                                <div class="col-lg-8">
                                    <h6 class="bookig_top_heaer_title">{{$event[0]->event_name}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">Hosted By:</div>
                                <div class="col-lg-8">
                                    <h6 class="bookig_top_heaer_title">{{ucwords($event[0]->event_host_by)}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">Start:</div>
                                <div class="col-lg-8">
                                    <h6 class="bookig_top_heaer_title">{{ date('l, M dS, Y', strtotime($event[0]->event_date)) }}, {{ date('g:i A', strtotime($event[0]->event_start_time)) }} CST</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">Ends:</div>
                                <div class="col-lg-8">
                                    <h6 class="bookig_top_heaer_title">{{ date('D, M dS', strtotime($event[0]->event_date)) }}, {{ date('g:i A', strtotime($event[0]->event_end_time)) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="send-event-ticket" class="register_form">
                    @csrf
                    <input type="hidden" id="event_id" name="event_id" value="{{$event[0]->id}}">
                    <input type="hidden" id="event_name" name="event_name" value="{{$event[0]->event_name}}">
                    <input type="hidden" id="event_location" name="event_location" value="{{$event[0]->event_location}}">
                    <input type="hidden" id="event_date" name="event_date" value="{{$event[0]->event_date}}">
                    <input type="hidden" id="event_start_time" name="event_start_time" value="{{$event[0]->event_start_time}}">
                    <div class="col-md-12 mb-3">
                        <div class="form_group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form_field_input" id="name" name="name" placeholder="Enter name" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form_group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form_field_input" id="email" name="email" placeholder="Enter email" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form_group">
                            <label for="no_of_tickets">No of tickets</label>
                            <input type="hidden" id="no_of_tickets" name="no_of_tickets" value="1">
                            <div class="tickets_price_list_right text-end ">
                                <div class="plan_quantity_content">
                                    <div class="plan_quntity_btns">
                                        <span class="plan_plus_minus_btn minus_btn"><i class="fa-solid fa-minus"></i></span><span class="qty_count">1</span><span class="plan_plus_minus_btn plus_btn"><i class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form_group">
                            <label for="ticket_id">Ticket tier</label>
                            <select name="ticket_id" id="ticket_id" class="custom-select form-control">
                                <option value="">Please Select ticket tier</option>
                                @foreach($event_ticket as $value)
                                    <option value="{{ $value->id }}" data="{{$value->ticket_cost}}">{{ $value->ticket_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="amount" name="amount">
                            <span>Estimated Cost: </span><b><span class="estimate_cost">0</span></b>
                        </div>
                        <div class="col-md-6">
                            <div class="form_group">
                                <button type="submit" class="btn btn-submit add_trending_btn theme_btn w-100">Send ticket</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('#ticket_id').on('change',function(event){
            event.preventDefault();
            var qty =  $(".qty_count").html();
            var ticketCost = $('#ticket_id option:selected').attr('data');
            var cost = (ticketCost) * qty;
            cost = cost.toFixed(2);
            $('.estimate_cost').html(cost);
            $('#amount').val(cost);
        })
        $('.minus_btn').on('click',function(){
            var minus_val = $(".qty_count").html();
            if(minus_val == 1){
                $('.minus_btn').attr('disabled','disabled').css('color','gray');
            }else{
                var minus =(parseInt(minus_val) - 1);
                $(".qty_count").html(minus);
                $('#no_of_tickets').val(minus);
            }
        })
        $('.plus_btn').on('click',function(){
            var plus_val = $(".qty_count").html();
            if(plus_val == 1){
                $('.minus_btn').removeAttr('disabled').css('color', 'black');
            }
            var plus = parseInt(plus_val) + 1;
            $(".qty_count").html(plus);
            $('#no_of_tickets').val(plus);
        });
        function FieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#name').val() == "") {
                $("#name").after(
                    '<span class="error">Name field is required</span>'
                );
                valid = false;
            }
            if ($('#email').val() == "") {
                $("#email").after(
                    '<span class="error">Email field is required</span>'
                );
                valid = false;
            }
            if ($('#ticket_id').val() == "") {
                $("#ticket_id").after(
                    '<span class="error">Ticket tier field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#send-event-ticket').on('submit',function(event){
            event.preventDefault();
            if (FieldValidation()) {
                $("#send-event-ticket button[type='submit']").prop('disabled', true);
                var formData = new FormData($(this)[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('send_event_ticket') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $("#send-event-ticket")[0].reset();
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> Send ticket Successfully.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                                $("#send-event-ticket button[type='submit']").prop('disabled', false);
                            }, 3000);

                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 3000);
                        }
                    }
                });
            }
        });
    </script>
@endsection
