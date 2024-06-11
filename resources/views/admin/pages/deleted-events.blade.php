@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Restore Event</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
             <div class="col-md-12 text-left mb-4">
                <a href="javascript:void(0);" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left fa-lg"></i></a>
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
    <div class="modal fade" id="restoreEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Restore Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this Restore event?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success" id="restore_event_btn">Restore</button>
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
                    "url": "{{ url('admin/alldeletedevent') }}",
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
                    { "data": "action"},
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

        var restore_id;
        function retoreEvent(id) {
            restore_id = id;
            // console.log(id);
        }
        // delete property
        $('#restore_event_btn').click(function(event) {
            event.preventDefault();
            $('.loader_text').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('restore_event') }}",
                type: "POST",
                data:{
                  "restore_id" : restore_id,
                },
                success: function(response) {
                    $('.loader_text').hide()
                    console.log(response);
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#restoreEventModal').modal('hide');
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
