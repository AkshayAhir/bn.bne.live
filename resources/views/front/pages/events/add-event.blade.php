@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Add event</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <?php $user = Auth::user();?>
    <section class="event_detail_sec bookings_list_sec" style="padding: 40px 0;">
        <div class="container">
            <div class="pb-3" >
                <a href="javascript:void(0);" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left fa-lg"></i></a>
            </div>
            <div class="bookig_top_heaer">
                <h1 class="bookig_top_heaer_title">Add Event</h1>
            </div>
            <div class="bookig_top_heaer_ticket  d-none">
                <h1 class="bookig_top_heaer_title">Add Event Ticket</h1>
            </div>
            <div class="add_event_table">
                <form id="add-event" class="register_form">
                    @csrf
                   <div class="col-md-12">
                       <div class="form_group">
                           <label for="event_name">Event name</label>
                           <input type="text" class="form-control form_field_input " id="event_name" name="event_name" placeholder="Enter event name" autocomplete="off">
                       </div>
                   </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_host_by">Event host name</label>
                            <input type="text" class="form-control form_field_input" id="event_host_by" name="event_host_by" placeholder="Enter event hosted" value="{{$user->set_host_name}}" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_details">Event details</label>
                            <textarea class="ckeditor form-control form_field_input" id="event_details" name="event_details" rows="3" placeholder="Enter event detail"></textarea>
                            <!--<textarea class="form-control form_field_input" id="event_details" name="event_details" rows="3" placeholder="Enter event detail"></textarea>-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_location">Event location</label>
                            <input type="text" class="form-control form_field_input" id="event_location" name="event_location" placeholder="Enter event location" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_address">Event address</label>
                            <textarea class="ckeditor form-control" name="event_address" id="event_address" placeholder="Enter event location"></textarea>
                            <!-- <textarea class="form-control form_field_input" id="event_address" name="event_address" rows="5" placeholder="Enter event address"></textarea> -->
                            <!--<input type="text" class="form-control form_field_input" id="event_address" name="event_address" placeholder="Enter event location" autocomplete="off">-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_date">Event date</label>
                            <input type="date" class="form-control form_field_input" id="event_date" name="event_date" placeholder="Enter event start time" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_start_time">Event start time</label>
                            <input type="time" class="form-control form_field_input" id="event_start_time" name="event_start_time" placeholder="Enter event start time" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_end_time">Event end time</label>
                            <input type="time" class="form-control form_field_input" id="event_end_time" name="event_end_time" placeholder="Enter event end time" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="user_profile_photo" style="margin-bottom: 7px; color: #ffffff;">Choose Event Image</label>
                            <input type="file" class="input_container" id="event_images" name="event_images" style="width: 100%; color: #ffffff61;">
                            <small id="small">Note:- Images will be 1 : 1</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <button class="form_submit_btn add_ticket_btn theme_btn w-100">Add ticket</button>
                        </div>
                    </div>
                </form>
            </div>
                <form id="add-event-ticket" class="register_form d-none">
                    @csrf
                    <table >
                        <thead>
                        <tr style="border-bottom: 1px solid;">
                            <th class="th-sm">#</th>
                            <th class="th-sm">Event name</th>
                            <th class="th-sm">Ticket name</th>
                            <th class="th-sm">Ticket cost</th>
                            <th class="th-sm">Ticket seats</th>
                            <!--<th class="th-sm">Ticket fee</th>-->
                            <th class="th-sm" >#</th>
                        </tr>
                        </thead>
                        <tbody class="itemRow">
                        <tr id="1">
                            <td style="vertical-align: middle!important;">1</td>
                            <td>
                                <input type="text" class="form-control form_field item_autocomplete" name="data[1][event_name]" id="event_name_1" data-type="eventName" placeholder="Click to select event" readonly>
                                <input type="hidden" class="form-control" id="event_id_1" name="data[1][event_id]">
                            </td>
                            <td>
                                <input type="text" class="form-control form_field" name="data[1][ticket_name]" id="ticket_name_1" placeholder="Name" required="">
                            </td>
                            <td>
                                <input type="text" class="form-control form_field" name="data[1][ticket_cost]" id="ticket_cost_1" placeholder="Rate" required="">
                            </td>
                            <td>
                                <input type="text" class="form-control form_field" name="data[1][avail_seats]" id="avail_seats_1" placeholder="Seat" required="" >
                            </td>
                            <!--<td>-->
                            <!--    <input type="text" class="form-control form_field" name="data[1][ticket_fee]" id="ticket_fee_1" placeholder="Fee" required="">-->
                            <!--</td>-->
                            <td>
                                <textarea class="form-control form_field description" name="data[1][description]" rows="1" id="description_1" placeholder="description"></textarea>
                            </td>
                            <td style="vertical-align: middle!important;">
                                <a href="JavaScript:void(0);" id="quotation_1" class="text-danger remove"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="text-align: left;">
                        <a href="javascript:void(0);" id="add" class="btn btn-light btn-sm fw-bolder" style="vertical-align: middle!important;"><i class="fa-solid fa-plus"></i> Add another line</a>
                    </div>
                    <div class="add_event_btn">
                        <div class="col-md-12">
                            <div class="input-group form_group">
                                <button class="form_submit_btn add_submit_btn theme_btn w-100">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>

        </div>
    </section>
    <!-- Bookings Section end -->
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
           
            if ($('#event_images').val() == "") {
                $("#small").after(
                    '   <span class="error">Event images field is required</span>'
                );
                valid = false;
            } else {
                for (var i = 0; i < $("#event_images").get(0).files.length; ++i) {

                    var img = $("#event_images").get(0).files[i].name;

                    var img_ext = img.split('.').pop().toLowerCase();
                    if ($.inArray(img_ext, ['jpg', 'jpeg', 'png']) === -1) {
                        $('#small').after("<span class='error'>File (" + img + ") type not allowed.</span>");
                        valid = false;
                    }
                }
            }
            return valid;
        }

        $('#add-event').submit(function(event) {
            event.preventDefault();

            if (fieldValidation()) {
                $(".add_ticket_btn").prop("disabled", true);
                $(".add_ticket_btn").css({
                "background-color": "rgba(0, 0, 0, 0.38)",
                "color": "#ffffff61"
                });
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
                    url: "{{ url('add_event') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response['data'][0]['id']);
                        if (response['status'] == 1) {
                            $("#add-event")[0].reset();
                            $('#event_name_1').val(response['data'][0]['event_name']);
                            $('#event_id_1').val(response['data'][0]['id']);
                            $('#add-event').addClass('d-none');
                            $('#add-event-ticket').removeClass('d-none');
                            $('.bookig_top_heaer').addClass('d-none');
                            $('.bookig_top_heaer_ticket').removeClass('d-none');
                            $("#status").html(
                                '<div class="alert alert-success" style="top:9%;"><strong>Success!</strong> Add Event Successfully.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 2000);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger" style="top:9%;"><strong>Fail!</strong> Something is wrong.</div>'
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


        $('#add-event-ticket').submit(function(event) {
            // alert('click');
            event.preventDefault();
            var formData = new FormData(this);
            // var formData = $(this).serializeArray();
            $(".add_submit_btn").prop("disabled", true);
            $(".add_submit_btn").css({
            "background-color": "rgba(0, 0, 0, 0.38)",
            "color": "#ffffff61"
            });
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('add_event_ticket') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#status").html(
                        '<div class="alert alert-success" style="top:9%;"><strong>Success!</strong> Add Event Ticket Successfully.</div>'
                    );
                    setTimeout(function () {
                        $(".alert").css("display", "none");
                        window.location.href = "{{route('event')}}";
                    }, 2000);
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
                    '<td><input type="text" class="form-control form_field item_autocomplete" name="data[' + n + '][event_name]" id="event_name_' + n + '" data-type="eventName" placeholder="Click to select event" readonly><input type="hidden" class="form-control"  id="event_id_' + n + '" name="data[' + n + '][event_id]" ></td>' +
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

    </script>
@endsection

