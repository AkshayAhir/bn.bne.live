@extends('admin.layout.main')
@section('title')
    <title>{{ env('APP_NAME') }} | Payment</title>
@endsection
@section('content')

    <form id="add_payment_setting">
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
            <!--<label for="payment_setting" style="width:100%"><h2>𝐂𝐡𝐨𝐨𝐬𝐞 𝐏𝐚𝐲𝐦𝐞𝐧𝐭 𝐆𝐚𝐭𝐞𝐰𝐚𝐲</h2></label>-->
            <h4 class="mb-4">Choose Payment Gateway</h4>
            @if($data->isEmpty())
                <input type="radio" name="payment_setting" id="sslcommerz" value="0" checked> <span style="font-weight: bold;">SslCommerz Payment Gateway</span>
                 <br>
                <input type="radio" name="payment_setting" id="aamarpay" value="1"> <span class="permission" style="font-weight: bold;">Aamarpay Payment Gateway</span>
            @else
                <input type="radio" name="payment_setting" id="sslcommerz" value="0" {{ $data[0]['payment_gateway'] == 0 ? 'checked' : '' }}> <span style="font-weight: bold;">SslCommerz Payment Gateway</span>
                <br>
                <input type="radio" name="payment_setting" id="aamarpay" value="1" {{ $data[0]['payment_gateway'] == 1 ? 'checked' : '' }}> <span class="permission" style="font-weight: bold;">Aamarpay Payment Gateway</span>
            @endif
        </div>
        <div class="form-group col-md-11 col-sm-12 trending_formgroup">
            <button type="button" class="btn btn-primary" id="add_payment_setting_btn">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#add_payment_setting_btn").click(function (e) {
                $("#add_payment_setting_btn").prop("disabled", true);
                e.preventDefault();
                var selectedPaymentGateway = $("input[name='payment_setting']:checked").val();
                $.ajax({
                    url: "{{ route('bne-payment') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_setting: selectedPaymentGateway
                    },
                    success: function (response) {
                        if (response['status'] == 1) {
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Thank you! </strong>Payment Getway Changes Successfully.</div>'
                            );
                            setTimeout(function () {    
                                $(".alert").css("display", "none");
                                location.reload();
                            }, 3000);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger"><strong>Fail! </strong> Something is wrong.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 3000);
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
