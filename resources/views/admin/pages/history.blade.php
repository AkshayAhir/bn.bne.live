@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-lg-6">
                <a href="{{route('admin.event')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
               <h5>Event name: {{$event_name}} History</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">User name</th>
                        <th class="th-sm">User email</th>
                        <th class="th-sm">Event name</th>
                        <th class="th-sm">Ticket name</th>
                        <th class="th-sm">Quantity</th>
                        <th class="th-sm">Amount</th>
                        <th class="th-sm">Booking Date</th>
                        <th class="th-sm">Status</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var event_id = <?= $id?>;
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
                    "url": "{{ route('eventBookingHistory') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}",
                        event_id:event_id
                    }
                },
                "columns": [
                    { "data": "id"},
                    { "data": "user_name" },
                    { "data": "user_email" },
                    { "data": "event_name" },
                    { "data": "ticket_name" },
                    { "data": "qty" },
                    { "data": "amount" },
                    { "data": "date" },
                    { "data": "status" },
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
    </script>
@endsection
