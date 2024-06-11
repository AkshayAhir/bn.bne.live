@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="title">User Type</label>
                <select name="user_type" id="user_type" class="custom-select form-control">
                    <option value="" selected="">All</option>
                    <option value="0">User</option>
                    <option value="1">Guest user</option>
                </select>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">User name</th>
                        <th class="th-sm">User email</th>
                        <th class="th-sm">Phone number</th>
                        <th class="th-sm">User type</th>
                        <th class="th-sm">Event create</th>
                        <th class="th-sm">Scan Permission</th>
                        <th class="th-sm">Status</th>
                        <th class="th-sm">Request</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Property Modal -->
    <div class="modal fade" id="editStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Status changes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure user <span class="change-status"></span>?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="delete_event_btn"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Property Modal end-->

    <!-- Edit user Modal -->
    <div class="modal fade" id="editUserModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit user</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="edit_user" enctype="multipart/form-dlta">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">User first name</label>
                            <input type="text" class="form-control" name="edit_user_first_name" id="edit_user_first_name" placeholder="Enter user first name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">User last name</label>
                            <input type="text" class="form-control" name="edit_user_last_name" id="edit_user_last_name" placeholder="Enter user last name" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">User email</label>
                            <input type="text" class="form-control" name="edit_user_email" id="edit_user_email" placeholder="Enter user email" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">User email</label>
                            <input type="number" class="form-control" name="edit_user_number" id="edit_user_number" placeholder="Enter user number" value="">
                        </div>

                        <div class="form-group col-md-11 col-sm-12  files file-area trending_formgroup">
                            <input type="file" class="custom-file-input form-control" id="edit_user_profile_photo" name="edit_user_profile_photo"/>
                            <label class="custom-file-label" id="picture_name" for="customFile">Choose Event Image</label>
                            <small id="small">Note:- Images will be 1 : 1</small>
                        </div>
{{--                        <div class="form-group col-md-11 col-sm-12 trending_formgroup event_create">--}}
{{--                            <fieldset>--}}
{{--                                <div class="some-class">--}}
{{--                                    <input type="checkbox" class="radio" name="edit_event_create" id="edit_event_create" />--}}
{{--                                    <label for="title">Set create event</label>--}}
{{--                                </div>--}}
{{--                            </fieldset>--}}
{{--                        </div>--}}
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="edit_mind_step_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit user Modal end -->

    <div class="modal fade" id="accessRequestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Request Accept</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure request access <span class="change-status"></span>?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="request_access_btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="scanPermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Scan permission</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure change permission <span class="change-scan-permission"></span>?</h5>
                </div>
                <!-- Modal footer -->
                <div class="scan_permission modal-footer">
                    <button type="submit" class="btn btn-danger" id="scan_permission_btn">submit</button>
                </div>
            </div>
        </div>
    </div>
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
                    "url": "{{ url('admin/alluser') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}","user_type": $('#user_type').val()}
                },
                "columns": [
                    { "data": "id"},
                    { "data": "user_first_name" },
                    { "data": "user_email" },
                    { "data": "user_number" },
                    { "data": "user_type" },
                    { "data": "event_create" },
                    { "data": "is_admin" },
                    { "data": "status" },
                    { "data": "request" },
                    { "data": "action", "className": "action_btn"},
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('id', 'storie_col_' + data['id']);
                },
                "columnDefs": [
                    // { "width": "40%", "targets": 3 },
                    {'targets': [9], 'orderable': false}
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        }
        datatable();

        user_type_column($('#user_type').val());

        $('#user_type').on('change', function () {
            table.destroy();
            datatable();
            user_type_column(this.value);
        });
        function user_type_column(user_type_val) {
            if(user_type_val == 0 && user_type_val == 1){
                table.column(1).visible(false);
                table.column(2).visible(false);
                table.column(3).visible(false);
                table.column(4).visible(false);
                table.column(5).visible(false);
                table.column(6).visible(false);
                table.column(7).visible(false);
            }
        }

        function editStatus(status,id){
            if(status == 0){
                $('.change-status').html('active');
                $('.modal-footer').html('<button type="submit" class="btn btn-success" id="delete_event_btn">Active</button>');
            }else{
                $('.change-status').html('deactive');
                $('.modal-footer').html('<button type="submit" class="btn btn-danger" id="delete_event_btn">Deactive</button>');
            }
            $('#delete_event_btn').on('click',function (){
                // alert(status);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/user_status_change') }}",
                    data: {
                        status:status,
                        id:id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $('#editStatusModal').hide();
                            location.reload();
                        }
                    }
                });
            })
        }

        var edit_id;
        function editUser(id) {
            edit_id = id;
            $("#edit_user")[0].reset();
            $('.event_create').removeClass('d-none');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('admin/view_user') }}/" + id,
                type: "POST",
                success: function(response) {
                    if (response['status'] == 1) {
                        data = response['data'][0];
                        $('#edit_user_first_name').val(data['user_first_name']);
                        $('#edit_user_last_name').val(data['user_last_name']);
                        $('#edit_user_email').val(data['user_email']);
                        $('#edit_user_number').val(data['user_number']);
                        if(data['set_event_create'] == 1){
                            $('#edit_event_create').prop('checked',true);
                        }
                        if(data['is_guest_user'] == 1){
                            $('.event_create').addClass('d-none');
                        }
                        if(data['user_profile_photo'] != ''){
                            $('#edit_user_profile_photo').siblings("#picture_name").addClass("selected").html(data['user_profile_photo']);
                        }

                    }
                }
            });
        }
        function editFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#edit_user_first_name').val() == "") {
                $("#edit_user_first_name").after(
                    '<span class="error">User name field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_user_last_name').val() == "") {
                $("#edit_user_last_name").after(
                    '<span class="error">User name field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_user_email').val() == "") {
                $("#edit_user_email").after(
                    '<span class="error">user email field is required</span>'
                );
                valid = false;
            }
            if ($('#edit_user_number').val() == "") {
                $("#edit_user_number").after(
                    '<span class="error">User number field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#edit_user').submit(function(event) {
            event.preventDefault();
            if(editFieldValidation()){
                var formData = new FormData($(this)[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/edit_user') }}/" + edit_id,
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $(".selected").html("Choose file");
                            $('#editUserModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> User Edit Successfully.</div>'
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

        var user_id;
        function accessRequest(id){
            user_id = id;
        }
        $('#request_access_btn').on('click',function(event){
            event.preventDefault();
            $('.loader_text').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('request-accept') }}",
                type: "POST",
                data:{
                    'user_id':user_id
                },
                success: function(response) {
                    $('.loader_text').hide()
                    console.log(response);
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#accessRequestModal').modal('hide');
                        $("#status").html(
                            '<div class="alert alert-success"><strong>Success!</strong> Request Accept Successfully.</div>'
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
        
        function scanPermission(scan_permission,id){
            if(scan_permission == 0){
                $('.change-scan-permission').html('deactive');
                $('.scan_permission').html('<button type="submit" class="btn btn-danger" id="scan_permission_btn">Deactive scan permission</button>');
            }else{
                $('.change-scan-permission').html('active');
                $('.scan_permission').html('<button type="submit" class="btn btn-success" id="scan_permission_btn">Active Scan permission</button>');
            }
            $('#scan_permission_btn').click(function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/scan_permission') }}",
                    data: {
                        scan_permission:scan_permission,
                        user_id:id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $('#scanPermissionModal').hide();
                            location.reload();
                        }
                    }
                });
            });
        }
    </script>
@endsection
