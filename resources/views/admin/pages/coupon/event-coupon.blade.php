@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <div class="col-md-12 text-right mb-4">
                <a href="{{route('add_coupon')}}" class="btn btn-submit add_trending_btn" >Add Event Coupon</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">Coupon Code</th>
                        <th class="th-sm">Coupon value</th>
                        <th class="th-sm">Number of coupon</th>
                        <th class="th-sm">Event name</th>
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
    <div class="modal fade" id="deleteEventCouponModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Event Coupon</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this Event coupon?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger" id="delete_event_btn">Confirm</button>
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
                "url": "{{ url('admin/alleventcoupon') }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}", "filter_date": $('#filter_date').val()}
            },
            "columns": [
                { "data": "id"},
                { "data": "coupon_code" },
                { "data": "coupon_value" },
                { "data": "no_of_coupon" },
                { "data": "event_name" },
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
        if ($('#event_id').val() == "") {
            $("#event_id").after(
                '<span class="error">Event name field is required</span>'
            );
            valid = false;
        }
        if ($('#coupon_name').val() == "") {
            $("#coupon_name").after(
                '<span class="error">Coupon name field is required</span>'
            );
            valid = false;
        }
        if ($('#coupon_discount').val() == "") {
            $("#coupon_discount").after(
                '<span class="error">Coupon discount field is required</span>'
            );
            valid = false;
        }
        if ($('#coupon_max_discount').val() == "") {
            $("#coupon_max_discount").after(
                '<span class="error">Coupon max discount field is required</span>'
            );
            valid = false;
        }
        if ($('#coupon_count').val() == "") {
            $("#coupon_count").after(
                '<span class="error">Coupon count field is required</span>'
            );
            valid = false;
        }
        if ($('#amount').val() == "") {
            $("#amount").after(
                '<span class="error">Amount field is required</span>'
            );
            valid = false;
        }
        return valid;
    }

    var delete_id;
    function deleteEventCoupon(id) {
        delete_id = id;
    }

    // delete property
    $('#delete_event_btn').click(function(event) {
        event.preventDefault();
        $('.loader_text').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/delete_event_coupon') }}/" + delete_id,
            type: "POST",
            success: function(response) {
                $('.loader_text').hide()
                console.log(response);
                if (response['status'] == 1) {
                    table.draw(false);
                    $('#deleteEventCouponModal').modal('hide');
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
