@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | forgot password</title>
@endsection
@section('main')
<div><div class="alert alert-success d-none"></div></div>
    <section class="register_form_sec">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 register_form_inner m-auto">
                    <h2 class="text-center form_title">Reset Your Password</h2>
                    <form id="change_pass_form" method="post" class="register_form">
                        @csrf
                        <input type="hidden" class="form-control" name="forgot_token" id="forgot_token" value="{{request()->token}}">
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-pass.svg')}}" alt="" width="20px"></div>
                            <input type="password" class="form-control form_field" id="password" name="password" placeholder="Enter your password" autocomplete="off">
                            @if ($errors->has('password'))
                                <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-pass.svg')}}" alt="" width="20px"></div>
                            <input type="password" class="form-control form_field" id="confirm_pass" name="confirm_pass" placeholder="Enter your confirm password" autocomplete="off">
                            @if ($errors->has('confirm_pass'))
                                <span class="error">{{ $errors->first('confirm_pass') }}</span>
                            @endif
                        </div>
                        <div class="input-group form_group">
                            <button class="form_submit_btn theme_btn w-100">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function FieldValidation(){
            var valid = true;
            $(".error").remove();
            if ($('#password').val() == "") {
                $("#password").after(
                    '<span class="error">Password field is required</span>'
                );
                valid = false;
            }
            if ($('#confirm_pass').val() == "") {
                $("#confirm_pass").after(
                    '<span class="error">Confirm Password field is required</span>'
                );
                valid = false;
            }
            if($('#password').val() != $('#confirm_pass').val()) {
                $("#confirm_pass").after(
                    '<span class="error">Password not match!</span>'
                );
                valid = false; 
            }
            return valid;
        }
        $('#change_pass_form').submit(function(event) {
            event.preventDefault();
           
            // var formData = new FormData($(this)[0]);
            if(FieldValidation()){
                //  alert('click');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('resetpassword') }}",
                    data: $('#change_pass_form').serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html(response.message);
                            setTimeout(function() {
                                window.location.href="{{ url('/login') }}"
                            }, 2000);
                        }else{
                           $("#password").after(
                                '<span class="error">'+response.message+'</span>'
                            );
                        }
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#loader").fadeOut(300);
                    },500);
                });
            }
        });
    </script>
@endsection
