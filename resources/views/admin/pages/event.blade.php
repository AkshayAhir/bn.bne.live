@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-md-12 text-right mb-4">
                <a class="btn btn-submit add_trending_btn" href="{{route('delete-event')}}">Restore Events</a>
                <a class="btn btn-submit add_trending_btn" data-toggle="modal" data-target="#addEventModal">Add Event</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">User name</th>
                        <th class="th-sm">Event image</th>
                        <th class="th-sm">Event name</th>
                        <th class="th-sm">Event location</th>
                        <th class="th-sm">Event date</th>
                        <th class="th-sm">Event time</th>
                        <th class="th-sm">Event publish</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="add_event" enctype="multipart/form-dlta">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event name</label>
                            <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Enter event name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event Hosted Name</label>
                            <input type="text" class="form-control" name="event_host_by" id="event_host_by" placeholder="Enter event hosted" value="BNE live" readonly>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event details</label>
                            <!--<textarea class="form-control" id="event_details" name="event_details" rows="5" placeholder="Enter event detail"></textarea>-->
                            <textarea class="ckeditor form-control" id="event_details" name="event_details" rows="5" placeholder="Enter event detail"></textarea>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event location</label>
                            <input type="text" class="form-control" name="event_location" id="event_location" placeholder="Enter event location" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event address</label>
                            <textarea class="ckeditor form-control" name="event_address" id="event_address" placeholder="Enter event location"></textarea>
                            <!--<textarea class="form-control" id="event_address" name="event_address" rows="5" placeholder="Enter event address"></textarea>-->
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event date</label>
                            <input type="date" class="form-control" name="event_date" id="event_date" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event start time</label>
                            <input type="time" class="form-control" name="event_start_time" id="event_start_time" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event end time</label>
                            <input type="time" class="form-control" name="event_end_time" id="event_end_time" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12  files file-area trending_formgroup">
                            <input type="file" class="custom-file-input form-control" id="event_images" name="event_images"/>
                            <label class="custom-file-label" id="picture_name" for="customFile">Choose Event Image</label>
                            <small id="small">Note:- Images will be 1 : 1</small>
                        </div>
                        {{--<div class="form-group col-md-11 col-sm-12 trending_formgroup d-none">
                            <label for="title">Set Feature image</label>
                            <input type="number" class="form-control" name="is_feature" id="is_feature" placeholder="Start of 0" value="">
                        </div>--}}
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">External Ticket link</label>
                            <input type="text" class="form-control" name="external_ticket_link" id="external_ticket_link" placeholder="Enter external ticket link">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_event_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Event Modal end -->

    <!-- Edit Event step Modal -->
    <div class="modal fade" id="editEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="edit_event" enctype="multipart/form-dlta">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event name</label>
                            <input type="text" class="form-control" name="edit_event_name" id="edit_event_name" placeholder="Enter event name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event Hosted Name</label>
                            <input type="text" class="form-control" name="edit_event_host_by" id="edit_event_host_by" placeholder="Enter event hosted" value="" readonly>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event details</label>
                            <textarea class="ckeditor form-control" id="edit_event_details" name="edit_event_details" rows="5" placeholder="Enter event detail"></textarea>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event location</label>
                            <input type="text" class="form-control" name="edit_event_location" id="edit_event_location" placeholder="Enter event location" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event address</label>
                            <textarea class="ckeditor form-control" name="edit_event_address" id="edit_event_address" placeholder="Enter event location"></textarea>
                            <!--<textarea class="form-control" id="edit_event_address" name="edit_event_address" rows="5" placeholder="Enter event address"></textarea>-->
                            <!--<input type="text" class="form-control" name="edit_event_address" id="edit_event_address" placeholder="Enter event location" value="">-->
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event date</label>
                            <input type="date" class="form-control" name="edit_event_date" id="edit_event_date" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event start time</label>
                            <input type="time" class="form-control" name="edit_event_start_time" id="edit_event_start_time" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event end time</label>
                            <input type="time" class="form-control" name="edit_event_end_time" id="edit_event_end_time" placeholder="Enter event start time" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12  files file-area trending_formgroup">
                            <input type="file" class="custom-file-input form-control" id="edit_event_images" name="edit_event_images"/>
                            <label class="custom-file-label" id="picture_name" for="customFile">Choose Event Image</label>
                            <small id="small">Note:- Images will be 1 : 1</small>
                        </div>
{{--                        <div class="form-group col-md-11 col-sm-12 trending_formgroup d-none">--}}
{{--                            <label for="title">Set Feature image</label>--}}
{{--                            <input type="number" class="form-control" name="edit_is_feature" id="edit_is_feature" placeholder="Start of 0" value="">--}}
{{--                        </div>--}}
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">External Ticket link</label>
                            <input type="text" class="form-control" name="edit_external_ticket_link" id="edit_external_ticket_link" placeholder="Enter external ticket link">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="edit_mind_step_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Event step Modal end -->

    <!-- Delete Property Modal -->
    <div class="modal fade" id="deleteEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this Event?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger" id="delete_event_btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Property Modal end-->
    
    <!-- Is approved Modal -->
    <div class="modal fade" id="editIsApprovedModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Approved event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure appvroved?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="approved_btn">Approved</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Is approved Modal end-->
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
       var table;
        function datatable() {
            table = $('#data_table').DataTable({
                // "lengthMenu": [[5, 10, 20], [5, 10, 20]],
                "language": {
                    "lengthMenu": "_MENU_",
                    "search": "",
                    "searchPlaceholder": "Search...",

                    "paginate": {
                        "next": '<i class="fa fa-angle-right"></i>',
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "first": '<i class="fa fa-angle-double-left"></i>',
                        "last": '<i class="fa fa-angle-double-right"></i>',
                    },
                },
                "responsive": "true",
                "pagingType": "full_numbers",
                "order": [
                    [0, "desc"]
                ],
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ url('admin/allevent') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id"},
                    { "data": "user_first_name"},
                    { "data": "event_image" },
                    { "data": "event_name" },
                    { "data": "event_location" },
                    { "data": "event_date" },
                    { "data": "event_time", },
                    { "data": "is_approved", },
                    { "data": "action", "className": "action_btn"},
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('id', 'storie_col_' + data['id']);
                },
                "columnDefs": [
                    // { "width": "40%", "targets": 3 },
                    // {'targets': [1,2], 'orderable': false}
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        }
        datatable();

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            if(fileName.length > 22) {
                fileName = fileName.substring(0, 22) + '...';
            }
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

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
            // if ($('#is_feature').val() == "") {
            //     $("#is_feature").after(
            //         '<span class="error">Feature field is required</span>'
            //     );
            //     valid = false;
            // }else{
            //     var feature = $('#is_feature').val();
            //     var length = $("#event_images").get(0).files.length;
            //     if(feature < length){
            //         valid = true;
            //     }else{
            //         $("#is_feature").after(
            //             '<span class="error">Not set feature image in your upload</span>'
            //         );
            //         valid = false;
            //     }
            // }
            if ($('#event_images').val() == "") {
                $("#small").after(
                    '<span class="error">Event images field is required</span>'
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

        function editFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#edit_event_name').val() == "") {
                $("#edit_event_name").after(
                    '<span class="error">Event name field is required</span>'
                );
                valid = false;
            }
            if(CKEDITOR.instances.edit_event_details.getData() == ''){
                $("#edit_event_details").after(
                    '<span class="error">Event details field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_event_location').val() == "") {
                $("#edit_event_location").after(
                    '<span class="error">Event location field is required</span>'
                );
                valid = false;
            }
            // if ($('#edit_event_address').val() == "") {
            //     $("#edit_event_address").after(
            //         '<span class="error">Event address field is required</span>'
            //     );
            //     valid = false;
            // }
            if(CKEDITOR.instances.edit_event_address.getData() == ''){
                $("#event_address").after(
                    '<span class="error">Event address field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_event_date').val() == "") {
                $("#edit_event_date").after(
                    '<span class="error">Event date field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_event_start_time').val() == "") {
                $("#edit_event_start_time").after(
                    '<span class="error">Event start time field is required</span>'
                );
                valid = false;
            }
            // if ($('#edit_event_end_time').val() == "") {
            //     $("#edit_event_end_time").after(
            //         '<span class="error">Event end time field is required</span>'
            //     );
            //     valid = false;
            // }
            // if ($('#edit_is_feature').val() == "") {
            //     $("#edit_is_feature").after(
            //         '<span class="error">Feature field is required</span>'
            //     );
            //     valid = false;
            // }
            // if ($('#edit_event_images').val() == "") {
            //     var feature = $('#edit_is_feature').val();
            //     // var image = $('#picture_name').text();
            //     // alert(image);
            //     var length = $("#edit_event_images").get(0).files.length;
            //     if(feature < length){
            //         valid = true;
            //     }else{
            //         $("#edit_is_feature").after(
            //             '<span class="error">Not set feature image in your upload</span>'
            //         );
            //         valid = false;
            //     }
            // }
            return valid;
        }
        // add new event
        $('#add_event').submit(function(event) {
            event.preventDefault();
            if (fieldValidation()) {
                var formData = new FormData($(this)[0]);
                var ckValue = CKEDITOR.instances.event_address.getData();
                var event_details = CKEDITOR.instances.event_details.getData();
                formData.append("event_address", ckValue);
                formData.append("event_details", event_details);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/add_event') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $("#add_event")[0].reset();
                            $(".selected").html("Choose file");
                            $('#addEventModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> New Event Added Successfully.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
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
        var edit_id;
        function editEvent(id) {
            edit_id = id;
            $("#edit_event")[0].reset();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/view_event') }}/" + id,
                type: "POST",
                success: function(response) {
                    if (response['status'] == 1) {
                        data = response['data'][0];
                        $('#edit_event_name').val(data['event_name']);
                        $('#edit_event_host_by').val(data['event_host_by']);
                        // $('#edit_event_details').val(data['event_details']);
                        $('#edit_event_location').val(data['event_location']);
                        // $('#edit_event_address').val(data['event_address']);
                        CKEDITOR.instances.edit_event_details.setData(data['event_details']);
                        CKEDITOR.instances.edit_event_address.setData(data['event_address']);
                        $('#edit_event_date').val(data['event_date']);
                        $('#edit_event_start_time').val(data['event_start_time']);
                        $('#edit_event_end_time').val(data['event_end_time']);
                        // $('#edit_is_feature').val(data['is_feature']);

                        if(data['event_images'] != ''){
                            $('#edit_event_images').siblings("#picture_name").addClass("selected").html(data['event_images']);
                        }

                    }
                }
            });
        }
        //edit event
        $('#edit_event').submit(function(event) {
            event.preventDefault();
            if(editFieldValidation()){
                var formData = new FormData($(this)[0]);
                var ckValue = CKEDITOR.instances.edit_event_address.getData();
                var event_details = CKEDITOR.instances.edit_event_details.getData();
                formData.append("edit_event_address", ckValue);
                formData.append("edit_event_details", event_details);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/edit_event') }}/" + edit_id,
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $(".selected").html("Choose file");
                            $('#editEventModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong>Event Edit Successfully.</div>'
                            );
                            setTimeout(function() {
                                $(".alert").css("display", "none");
                            }, 3000);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                            );
                            setTimeout(function() {
                                $(".alert").css("display", "none");
                            }, 3000);
                        }
                    }
                });
            }
        });
        var delete_id;
        function deleteEvent(id) {
            delete_id = id;
            // console.log(id);
        }
        // delete property
        $('#delete_event_btn').click(function(event) {
            event.preventDefault();
            $('.loader_text').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/delete_event') }}/" + delete_id,
                type: "POST",
                success: function(response) {
                    $('.loader_text').hide()
                    console.log(response);
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#deleteEventModal').modal('hide');
                        $("#status").html(
                            '<div class="alert alert-success"><strong>Success!</strong> Property Delete Successfully.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                            // window.location.reload(true);
                        }, 3000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                        }, 3000);
                    }
                }
            });
        });
        
        
        function editIsApproved(status,id){
            // alert(status);
            $('#approved_btn').on('click',function (){
                // alert(status);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/approve_change') }}",
                    data: {
                        status:status,
                        id:id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $('#editIsApprovedModal').hide();
                            location.reload();
                        }
                    }
                });
            })
        }
    </script>
@endsection
