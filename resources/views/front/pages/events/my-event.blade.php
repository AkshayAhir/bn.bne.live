@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | My events</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <section class="event_detail_sec bookings_list_sec" style="max-width: 1100px">
        <div class="container">
            <div class="bookig_top_heaer">
                <h1 class="bookig_top_heaer_title">My Events</h1>
            </div>
            <div class="col-md-12 text-end mb-5">
                <a href="{{route('addevent')}}" class="buy_tickets_btn theme_btn" style="border-radius: 5px">Add Event</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
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
    </section>
    <!-- Bookings Section end -->

    <!-- Delete Property Modal -->
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
    <!-- Delete Property Modal end-->
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
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
                    "url": "{{ route('allmyevent') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id"},
                    { "data": "event_image" },
                    { "data": "event_name" },
                    { "data": "event_location" },
                    { "data": "event_date" },
                    { "data": "event_time", },
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
        var delete_id;
        function deleteEvent(id) {
            delete_id = id;
            $('#deleteEventModal').modal('show');
        }

        $('#delete_event_btn').click(function(event) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('delete_event') }}",
                type: "POST",
                data: {
                    delete_id:delete_id
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                    if (response['status'] == 1) {
                        table.draw(false);
                        $('#deleteEventModal').modal('hide');
                        $("#status").html(
                            '<div class="alert alert-success" style="top:9%;"><strong>Success!</strong> Event Delete Successfully.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                            // window.location.reload(true);
                        }, 3000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger style="top:9%;""><strong>Fail!</strong> Something is wrong.</div>'
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
