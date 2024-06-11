@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | BNE setting</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-md-12 text-right mb-4">
                <a class="btn btn-submit add_trending_btn" data-toggle="modal" data-target="#addPermissionModal">Add Permission</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">Setting title</th>
                        <th class="th-sm">Setting value</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add permission Modal -->
    <div class="modal fade" id="addPermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Permission</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="add_permission" >
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="title">Setting title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="permission" style="width:100%">Setting value</label></label>
                            <input type="radio" name="permission" id="permission" placeholder="Enter permission" value="0"> Yes
                            <input type="radio" name="permission" id="permission" placeholder="Enter permission" value="1"> <span class="permission">No</span>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_permission_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add permission Modal end -->
    
    <!-- Edit permission Modal -->
    <div class="modal fade" id="editPermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Permission</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="edit_permission" enctype="multipart/form-dlta">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="edit_title">Setting title</label>
                            <input type="text" class="form-control" name="edit_title" id="edit_title" placeholder="Enter title" value="">
                        </div>
                        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
                            <label for="edit_permission" style="width:100%">Setting value</label>
                            <input type="radio" name="edit_permission" id="edit_permission" placeholder="Enter permission" value="0"> Yes
                            <input type="radio" name="edit_permission" id="edit_permission" placeholder="Enter permission" value="1"> <span class="edit_permission">No</span>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="edit_permission_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit permission Modal end -->
    
    <!-- Delete Property Modal -->
    <div class="modal fade" id="deletePermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Settings</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this setting?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="delete_permission_btn">Confirm</button>
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
                    "url": "{{ url('admin/allpermission') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}", "filter_date": $('#filter_date').val()}
                },
                "columns": [
                    { "data": "id"},
                    { "data": "title" },
                    { "data": "permission" },
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
        // add field validation
        function fieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#title').val() == "") {
                $("#title").after(
                    '<span class="error">Setting title field is required</span>'
                );
                valid = false;
            }
            if ($('input[name="permission"]:checked').length == 0) {
                $(".permission").after(
                    '<span class="error">Setting value field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        function editFieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#edit_title').val() == "") {
                $("#edit_title").after(
                    '<span class="error">Setting title field is required</span>'
                );
                valid = false;
            }
            if ($('input[name="edit_permission"]:checked').length == 0) {
                $(".edit_permission").after(
                    '<span class="error">Setting value field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        
        $('#add_permission').submit(function(event) {
            event.preventDefault();
            if (fieldValidation()) {
                var formData = new FormData($(this)[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/add_permission') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $("#add_permission")[0].reset();
                            $('#addPermissionModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> Permission Added Successfully.</div>'
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
        function editPermission(id) {
            edit_id = id;
            $("#edit_permission")[0].reset();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('view_permission') }}" ,
                type: "POST",
                data:{
                    "edit_id":edit_id
                },
                success: function(response) {
                    if (response['status'] == 1) {
                        data = response['data'][0];
                        $('#edit_title').val(data['title']);
                        $("input[name=edit_permission][value=" + data['permission'] + "]").attr('checked', 'checked')
                        // $('#edit_permission').val(data['permission']);
                    }
                }
            });
        }
        $('#edit_permission').submit(function(event) {
            event.preventDefault();
            if(editFieldValidation()){
                var formData = new FormData($(this)[0]);
                formData.append("edit_id", edit_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('edit_permission') }}",
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] == 1) {
                            $('#editPermissionModal').modal('hide');
                            table.draw(false);
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong>Setting Edit Successfully.</div>'
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
        function deletePermission(id) {
            delete_id = id;
        }
        // delete property
        $('#delete_permission_btn').click(function(event) {
            event.preventDefault();
            $('.loader_text').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('delete_permission') }}",
                type: "POST",
                data:{
                    "delete_id":delete_id  
                },
                success: function(response) {
                    $('.loader_text').hide();
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#deletePermissionModal').modal('hide');
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