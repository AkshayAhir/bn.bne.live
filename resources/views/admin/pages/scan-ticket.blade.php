@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event</title>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div id="qr-reader" style="margin:15px;"></div>
        <div id="qr-reader-results"></div>
    </div>
</div>
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Booking history</h5>
      </div>
      <div class="modal-body">
        <p>Event name:- <span id="event_name"></span></p>
        <p>User name:- <span id="user_name"></span></p>
        <p>Ticket type:- <span id="ticket_type"></span></p>
        <p>ticket qty:- <span id="ticket_qty"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary backScan">Back ot scan</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('admin/scanTicket') }}",
                    data: {
                        "scanTicket":decodedText
                    },
                    success: function(response) {
                        if (response['status'] == 1) {
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> QR Code Scanned Successfully.</div>'
                            );
                            $('#staticBackdrop').modal('show');
                            $('#event_name').html(response.data[0].event_booking[0].event_name);
                            $('#user_name').html(response.data[0].user.user_first_name);
                            $('#ticket_type').html(response.data[0].event_ticket.ticket_name);
                            $('#ticket_qty').html(response.data[0].qty);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger"><strong>Alert!</strong> QR Code is already scanned.</div>'
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            }
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
        $('.backScan').on('click',function(){
            location.reload();
        })
    </script>
@endsection
