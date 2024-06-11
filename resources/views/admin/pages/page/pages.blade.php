@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Pages</title>
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row">
            <h4 class="mb-4">Pages</h4>
            <div class="col-md-12 text-right mb-4">
                <a href="{{route('admin.add-page')}}" class="btn btn-submit add_trending_btn" >Add Page</a>
            </div>
            <div class="col-md-12 datatable-page-table table-responsive">
                <table id="data_table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">#</th>
                        <th class="th-sm">Page Name</th>
                        <th class="th-sm">Order No</th>
                        <th class="th-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Page</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5>Are you sure delete this Page?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="delete_page_btn">Confirm</button>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    var table;
    function datatable() {
        table = $('#data_table').DataTable({
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
                "url": "{{ url('admin/allpage') }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id"},
                { "data": "page_title"},
                { "data": "order_no"},
                { "data": "action", "className": "action_btn"},
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).attr('id', 'storie_col_' + data['id']);
            },
            "columnDefs": [
            ]
        });
        $('.dataTables_length').addClass('bs-select');
    }
    datatable();

   
    var delete_id
    function deletePage(id){
        delete_id = id;
    }

    $('#delete_page_btn').click(function(event) {
        event.preventDefault();
        $('.loader_text').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/delete_page') }}/" + delete_id,
            type: "POST",
            success: function(response) {
                $('.loader_text').hide()
                if (response['status'] == 1) {
                    table.draw(false);
                    $('#deletePageModal').modal('hide');
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