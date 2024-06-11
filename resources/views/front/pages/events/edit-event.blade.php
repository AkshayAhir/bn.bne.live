@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Add event</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
{{--    {{$event[0]}}--}}
    <section class="event_detail_sec bookings_list_sec" style="padding: 40px 0;">
        <div class="container">
            <div class="pb-3">
                <a href="javascript:void(0);" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left fa-lg"></i></a>
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#event-details" type="button" role="tab" aria-controls="event-details" aria-selected="true">Event details</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#event-tickets" type="button" role="tab" aria-controls="event-tickets" aria-selected="false">Ticket details</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="event-details" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="add_event_table">
                        <form id="edit-event" class="register_form">
                            @csrf
                            <input type="hidden" id="event_id" name="event_id" value="{{$event[0]->id}}">
                            <div class="col-md-12">
                                <div class=" form_group">
                                    <label for="event_name">Event name</label>
                                    <input type="text" class="form-control form_field_input " id="event_name" name="event_name" placeholder="Enter event name" autocomplete="off" value="{{$event[0]->event_name}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_host_by">Event Host name</label>
                                    <input type="text" class="form-control form_field_input" id="event_host_by" name="event_host_by" placeholder="Enter event hosted" autocomplete="off" value="{{$event[0]->event_host_by}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_details">Event details</label>
                                    <textarea class="ckeditor form-control form_field_input" id="event_details" name="event_details" rows="3" placeholder="Enter event detail" >{{$event[0]->event_details}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_location">Event location</label>
                                    <input type="text" class="form-control form_field_input" id="event_location" name="event_location" placeholder="Enter event location" autocomplete="off" value="{{$event[0]->event_location}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_address">Event address</label>
                                    <textarea class="ckeditor form-control form_field_input" name="event_address" id="event_address" rows="5" placeholder="Enter event address">{{$event[0]->event_address}}</textarea>
                                    <!-- <textarea class="form-control form_field_input" id="edit_event_address" name="edit_event_address" rows="5" placeholder="Enter event address"></textarea> -->
                                    <!--<input type="text" class="form-control form_field_input" id="event_address" name="event_address" placeholder="Enter event location" autocomplete="off" value="{{$event[0]->event_address}}">-->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_date">Event date</label>
                                    <input type="date" class="form-control form_field_input" id="event_date" name="event_date" placeholder="Enter event start time" autocomplete="off" value="{{$event[0]->event_date}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_start_time">Event start time</label>
                                    <input type="time" class="form-control form_field_input" id="event_start_time" name="event_start_time" placeholder="Enter event start time" autocomplete="off" value="{{$event[0]->event_start_time}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="event_end_time">Event end time</label>
                                    <input type="time" class="form-control form_field_input" id="event_end_time" name="event_end_time" placeholder="Enter event end time" autocomplete="off" value="{{$event[0]->event_end_time}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form_group">
                                    <label for="user_profile_photo" style="margin-bottom: 7px; color: #ffffff;">Choose Event Image</label>
                                    <input type="file" class="input_container" id="edit_event_images" name="edit_event_images" style="width: 100%; color: #ffffff61;" value="{{$event[0]->event_images}}">
                                    <small id="small">Note:- Images will be 1 : 1</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group form_group">
                                    <button class="form_submit_btn theme_btn w-100">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="event-tickets" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p class="pt-4" style="font-size: 1.25rem;">Event name: {{ucfirst($event[0]->event_name)}} </p>
                    <form id="edit-event-ticket" class="register_form">
                        @csrf
                        <table >
                            <thead>
                            <tr style="border-bottom: 1px solid;">
                                <th class="th-sm">#</th>
                                <th class="th-sm d-none">Event name</th>
                                <th class="th-sm">Ticket name</th>
                                <th class="th-sm">Ticket cost</th>
                                <th class="th-sm">Ticket seats</th>
                                <!--<th class="th-sm">Ticket fee</th>-->
                                <th class="th-sm">Description</th>
                                <th class="th-sm" >#</th>
                            </tr>
                            </thead>
                            <tbody class="itemRow">
                            <?php $i = 1?>
                            @foreach($event_ticket as $ticket)
                                {{--                            {{$ticket->ticket_name}}--}}
                                <tr id="{{$i}}">
                                    <td style="vertical-align: middle!important;">{{$i}}</td>
                                    <td class="d-none">
                                        <input type="text" class="form-control form_field item_autocomplete" name="data[{{$i}}][event_name]" id="event_name_{{$i}}" data-type="eventName" placeholder="Click to select event" value="{{$event[0]->event_name}}" readonly>
                                        <input type="hidden" class="form-control" id="id_{{$i}}" name="data[{{$i}}][id]" value="{{$ticket->id}}">
                                        <input type="hidden" class="form-control" id="event_id_{{$i}}" name="data[{{$i}}][event_id]" value="{{$ticket->event_id}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form_field" name="data[{{$i}}][ticket_name]" id="ticket_name_{{$i}}" placeholder="Name" required="" value="{{$ticket->ticket_name}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form_field" name="data[{{$i}}][ticket_cost]" id="ticket_cost_{{$i}}" placeholder="Rate" required="" value="{{$ticket->ticket_cost}}">
                                    </td>
                                    <td >
                                        <input type="text" class="form-control form_field" name="data[{{$i}}][avail_seats]" id="avail_seats_{{$i}}" placeholder="Seat" required="" value="{{$ticket->avail_seats}}">
                                    </td>
                                    <!--<td>-->
                                    <!--    <input type="text" class="form-control form_field" name="data[{{$i}}][ticket_fee]" id="ticket_fee_{{$i}}" placeholder="Fee" required="" value="{{$ticket->ticket_fee}}">-->
                                    <!--</td>-->
                                    <td>
                                        <textarea class="form-control form_field description" name="data[{{$i}}][description]" rows="1" id="description_{{$i++}}" placeholder="description">{{$ticket->description}}</textarea>
                                    </td>
                                    <td style="vertical-align: middle!important;">
                                        <a class="text-danger" id="delete_btn" onclick="deleteTicket({{$ticket->id}})" data-bs-toggle="modal" data-bs-target="#deleteEventModal"> <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div style="text-align: left;">
                            <a href="javascript:void(0);" id="add" class="btn btn-light btn-sm fw-bolder" style="vertical-align: middle!important;"><i class="fa-solid fa-plus"></i> Add another line</a>
                        </div>
                        <div class="add_event_btn">
                            <div class="col-md-12">
                                <div class="input-group form_group">
                                    <button class="form_submit_btn submit_btn theme_btn w-100">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Bookings Section end -->

<!-- Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 style="color: black">Are you sure delete this Event?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete_event_btn">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        // add new event field validation
        function fieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#event_name').val() == "") {
                $("#event_name").after(
                    '<span class="error">Event name field is required</span>'
                );
                valid = false;
            }
            if ($('#event_host_by').val() == "") {
                $("#event_host_by").after(
                    '<span class="error">Event host name field is required</span>'
                );
                valid = false;
            }
            if(CKEDITOR.instances.event_details.getData() == ''){
                $("#event_details").after(
                    '<span class="error">Event details field is required</span>'
                );
                valid = false;
            }
            if ($('#event_location').val() == "") {
                $("#event_location").after(
                    '<span class="error">Event location field is required</span>'
                );
                valid = false;
            }
            // if ($('#event_address').val() == "") {
            //     $("#event_address").after(
            //         '<span class="error">Event address field is required</span>'
            //     );
            //     valid = false;
            // }
            if(CKEDITOR.instances.event_address.getData() == ''){
                $("#event_address").after(
                    '<span class="error">Event address field is required</span>'
                );
                valid = false;
            }
            if ($('#event_date').val() == "") {
                $("#event_date").after(
                    '<span class="error">Event date field is required</span>'
                );
                valid = false;
            }
            if ($('#event_start_time').val() == "") {
                $("#event_start_time").after(
                    '<span class="error">Event start time field is required</span>'
                );
                valid = false;
            }
            // if ($('#event_end_time').val() == "") {
            //     $("#event_end_time").after(
            //         '<span class="error">Event end time field is required</span>'
            //     );
            //     valid = false;
            // }
            return valid;
        }

        $('#edit-event').submit(function(event) {
            event.preventDefault();

            if (fieldValidation()) {
                var formData = new FormData($(this)[0]);
                var ckValue = CKEDITOR.instances.event_address.getData();
                formData.append("event_address", ckValue);
                var event_details = CKEDITOR.instances.event_details.getData();
                formData.append("event_details", event_details);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('edit_event') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response['data'][0]['id']);
                        if (response['status'] == 1) {
                            $("#status").html(
                                '<div class="alert alert-success" style="top: 4.7%;"><strong>Success!</strong> Update Event Successfully.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 2000);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger" ><strong>Fail!</strong> Something is wrong.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 3000);
                        }
                    }
                });
            }
        });

        $('#add').click(function () {
            addnewrow();
        });
        $('body').delegate('.remove', 'click', function () {
            var id = $(this).attr('id');
            $('#' + id).closest('tr').remove();
        });


        $('#edit-event-ticket').submit(function(event) {
            // alert('click');
            event.preventDefault();
            var formData = new FormData(this);
            // var formData = $(this).serializeArray();
             $(".submit_btn").prop("disabled", true);
            $(".submit_btn").css({
            "background-color": "rgba(0, 0, 0, 0.38)",
            "color": "#ffffff61"
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('edit_event_ticket') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    {{--window.location.href = "{{route('event')}}";--}}
                    if (data['status'] == 1) {
                        $("#status").html(
                            '<div class="alert alert-success" style="top:8%"><strong>Success!</strong> Update Event ticket Successfully.</div>'
                        );
                        setTimeout(function () {
                            $(".alert").css("display", "none");
                        }, 2000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger" ><strong>Fail!</strong> Something is wrong.</div>'
                        );
                        setTimeout(function () {
                            $(".alert").css("display", "none");
                        }, 3000);
                    }
                }
            });
        });

        function addnewrow() {
            var n = 0
            if (isNaN(parseInt($('.itemRow tr:last').attr('id'))))
                n = parseInt($('.itemRow tr').length) + parseInt(1);
            if (!isNaN(parseInt($('.itemRow tr:last').attr('id'))))
                n = parseInt($('.itemRow tr:last').attr('id')) + parseInt(1);
            var tr = '<tr id="' + n + '">' +
                '<td class="no" style="vertical-align: middle!important;">' + n + '</td>' +
                '<td class="d-none"><input type="text" class="form-control form_field item_autocomplete" name="data[' + n + '][event_name]" id="event_name_' + n + '" data-type="eventName" placeholder="Click to select event" readonly><input type="hidden" class="form-control"  id="event_id_' + n + '" name="data[' + n + '][event_id]" ></td>' +
                '<td><input type="text" class="form-control form_field" name="data[' + n + '][ticket_name]" id="ticket_name_' + n + '" placeholder="Name" required=""></td>' +
                '<td><input type="text" class="form-control form_field" name="data[' + n + '][ticket_cost]" id="ticket_cost_' + n + '" placeholder="Rate" required=""></td>' +
                '<td><input type="text" class="form-control form_field" name="data[' + n + '][avail_seats]" id="avail_seats_' + n + '" placeholder="Seats" required=""></td>' +
                // '<td><input type="text" class="form-control form_field" name="data[' + n + '][ticket_fee]" id="ticket_fee_' + n + '" placeholder="Fee" required=""></td>' +
                '<td><textarea rows="1" class="form-control form_field description" name="data[' + n + '][description]" id="description_' + n + '" placeholder="description"></textarea></td>' +
                '<td style="vertical-align: middle!important;"><a href="JavaScript:void(0);" id="quotation_' + n + '" class="text-danger remove"><i class="fas fa-trash-alt"></i></a></td>' +
                '</tr>';
            $('.itemRow').append(tr);
            var event_name = $('#event_name_1').val();
            var event_id = $('#event_id_1').val();
            $("#event_name_"+ n + "").val(event_name);
            $("#event_id_"+ n + "").val(event_id);
            $('#item_name_' + n).focus();
        }

        var delete_id;
        function deleteTicket(id) {
            delete_id = id;
            // $('#deleteEventModal').modal('show');
        }

        $('#delete_event_btn').click(function(event) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('delete_event_ticket') }}",
                type: "POST",
                data: {
                    delete_id:delete_id
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                    if (response['status'] == 1) {
                        $('#deleteEventModal').modal('hide');
                        // location.reload();
                        $("#status").html(
                            '<div class="alert alert-success" ><strong>Success!</strong> Property Delete Successfully.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                            location.reload();
                        }, 3000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger" ><strong>Fail!</strong> Something is wrong.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                        }, 3000);
                    }
                }
            });
        });
    </script>
@endsection

