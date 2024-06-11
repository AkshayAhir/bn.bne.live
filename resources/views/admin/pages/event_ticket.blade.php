@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event-ticket</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-md-12 text-right mb-4">
                <a class="btn btn-submit add_trending_btn" data-toggle="modal" data-target="#addEventTicketModal">Add Event Ticket</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">Event name</th>
                        <th class="th-sm">Ticket name</th>
                        <th class="th-sm">Ticket cost</th>
                        <th class="th-sm">Total ticket</th>
                        <th class="th-sm">Available seats</th>
                        <th class="th-sm">Ticket fee</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Event ticket Modal -->
    <div class="modal fade" id="addEventTicketModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Event Ticket</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="add_event_ticket" >
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event name</label>
                            <select name="event_id" id="event_id" class="custom-select form-control">
                                <option value="">Please Select Event</option>
                                @foreach($event as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['event_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket name</label>
                            <input type="text" class="form-control" name="ticket_name" id="ticket_name" placeholder="Enter ticket name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket Cost</label>
                            <input type="number" class="form-control" name="ticket_cost" id="ticket_cost" placeholder="Enter ticket cost" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket seats</label>
                            <input type="number" class="form-control" name="avail_seats" id="avail_seats" placeholder="Enter ticket seats" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket fee</label>
                            <input type="number" class="form-control" name="ticket_fee" id="ticket_fee" placeholder="Enter ticket fee" value="" step=any>
                        </div>
                         <div class="form-group col-md-11 col-sm-12 trending_formgroup" style="margin-left:38px !important">
                            <input class="form-check-input" type="checkbox" value="1" name="apply_free_ticket" id="apply_free_ticket">
                            <label class="form-check-label" for="apply_discount">
                                <b>Free Tier Ticket</b> - Check this box if you want to allow free tickets to users. It will not redirect to stripe payment gateway and creates order without payment.
                            </label>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_event_ticket_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Event ticket Modal end -->

    <!-- Edit event ticket Modal -->
    <div class="modal fade" id="editEventTicketModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="edit_event_ticket" enctype="multipart/form-dlta">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Event name</label>
                            <select name="edit_event_id" id="edit_event_id" class="custom-select form-control">
                                <option value="">Please Select Event</option>
                                @foreach($event as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['event_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket name</label>
                            <input type="text" class="form-control" name="edit_ticket_name" id="edit_ticket_name" placeholder="Enter ticket name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket Cost</label>
                            <input type="number" class="form-control" name="edit_ticket_cost" id="edit_ticket_cost" placeholder="Enter ticket cost" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Total ticket</label>
                            <input type="number" class="form-control" name="edit_total_ticket" id="edit_total_ticket" placeholder="Enter total ticket seats" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket seats</label>
                            <input type="number" class="form-control" name="edit_avail_seats" id="edit_avail_seats" placeholder="Enter ticket seats" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Ticket fee</label>
                            <input type="number" class="form-control" name="edit_ticket_fee" id="edit_ticket_fee" placeholder="Enter ticket fee" value="" step=any>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup" style="margin-left:38px !important">
                            <input class="form-check-input" type="checkbox" value="1" name="edit_apply_free_ticket" id="edit_apply_free_ticket">
                            <label class="form-check-label" for="apply_discount">
                                <b>Free Tier Ticket</b> - Check this box if you want to allow free tickets to users. It will not redirect to stripe payment gateway and creates order without payment.
                            </label>
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Description</label>
                            <textarea class="form-control" id="edit_description" name="edit_description" rows="5" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="edit_event_ticket_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Mind step Modal end -->

    <!-- Delete Property Modal -->
    <div class="modal fade" id="deleteEventTicketModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Event Ticket</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this Event Ticket?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger" id="delete_event_ticket_btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Property Modal end-->
@endsection
@section('scripts')
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
                    "url": "{{ url('admin/allticket') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}", "filter_date": $('#filter_date').val()}
                },
                "columns": [
                    { "data": "id"},
                    { "data": "event_name" },
                    { "data": "ticket_name" },
                    { "data": "ticket_cost" },
                    { "data": "total_ticket" },
                    { "data": "avail_seats" },
                    { "data": "ticket_fee" },
                    { "data": "description" },
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
        // add new event field validation
        function fieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#event_id').val() == "") {
                $("#event_id").after(
                    '<span class="error">Event name field is required</span>'
                );
                valid = false;
            }
            if ($('#ticket_name').val() == "") {
                $("#ticket_name").after(
                    '<span class="error">Ticket Name field is required</span>'
                );
                valid = false;
            }
            if ($('#ticket_cost').val() == "") {
                $("#ticket_cost").after(
                    '<span class="error">Ticket Cost field is required</span>'
                );
                valid = false;
            }
            if ($('#avail_seats').val() == "") {
                $("#avail_seats").after(
                    '<span class="error">Ticket seats field is required</span>'
                );
                valid = false;
            }
            if ($('#ticket_fee').val() == "") {
                $("#ticket_fee").after(
                    '<span class="error">Ticket fee field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        // edit new event field validation
        function editFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#edit_event_id').val() == "") {
                $("#edit_event_id").after(
                    '<span class="error">Event name field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_ticket_name').val() == "") {
                $("#edit_ticket_name").after(
                    '<span class="error">Ticket Name field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_ticket_cost').val() == "") {
                $("#edit_ticket_cost").after(
                    '<span class="error">Ticket Cost field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_total_ticket').val() == "") {
                $("#edit_total_ticket").after(
                    '<span class="error">Total ticket seats field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_avail_seats').val() == "") {
                $("#edit_avail_seats").after(
                    '<span class="error">Ticket seats field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_ticket_fee').val() == "") {
                $("#edit_ticket_fee").after(
                    '<span class="error">Ticket fee field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#apply_free_ticket').on('change', function() {
            if ($('#apply_free_ticket').is(':checked')) {
                $('#ticket_cost').val(0);
                $('#ticket_fee').val(0);
            }
        });
        
        $('#edit_apply_free_ticket').on('change', function() {
            if ($('#edit_apply_free_ticket').is(':checked')) {
                $('#edit_ticket_cost').val(0);
                $('#edit_ticket_fee').val(0);
            }
        });
        $('#add_event_ticket').submit(function(event) {
            event.preventDefault();
            if (fieldValidation()) {
                var formData = new FormData($(this)[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/add_event_ticket') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $("#add_event_ticket")[0].reset();
                            $('#addEventTicketModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> New Event ticket Added Successfully.</div>'
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
        function editEventTicket(id) {
            edit_id = id;
            $("#edit_event_ticket")[0].reset();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/view_event_ticket') }}/" + id,
                type: "POST",
                success: function(response) {
                    if (response['status'] == 1) {
                        data = response['data'][0];
                        $('#edit_event_id').val(data['event_id']);
                        $('#edit_ticket_name').val(data['ticket_name']);
                        $('#edit_ticket_cost').val(data['ticket_cost']);
                        $('#edit_total_ticket').val(data['total_ticket']);
                        $('#edit_avail_seats').val(data['avail_seats']);
                        $('#edit_ticket_fee').val(data['ticket_fee']);
                        $('#edit_description').val(data['description']);
                        if (data['free_tier_ticket'] == 1) {
                            $('#edit_apply_free_ticket').prop('checked', true);
                        }
                    }
                }
            });
        }
        //edit event ticket
        $('#edit_event_ticket').submit(function(event) {
            event.preventDefault();
            if(editFieldValidation()){
                var formData = new FormData($(this)[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/edit_event_ticket') }}/" + edit_id,
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] == 1) {
                            $('#editEventTicketModal').modal('hide');
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
        function deleteEventTicket(id) {
            delete_id = id;
            // console.log(id);
        }
        // delete property
        $('#delete_event_ticket_btn').click(function(event) {
            event.preventDefault();
            $('.loader_text').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/delete_event_ticket') }}/" + delete_id,
                type: "POST",
                success: function(response) {
                    $('.loader_text').hide()
                    console.log(response);
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#deleteEventTicketModal').modal('hide');
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
    </script>
@endsection
