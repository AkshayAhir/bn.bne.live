@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | forgot password</title>
@endsection
@section('main')
<div><div class="alert alert-success d-none"></div></div>
<div><div class="alert alert-danger d-none"></div></div>
    <section class="register_form_sec">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 register_form_inner m-auto">
                    <h2 class="text-center form_title">Forgot password</h2>
                    <form id="reset_password" method="post" class="register_form">
                        @csrf
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px"></div>
                            {{--                            <input type="text" class="form-control form_field" id="user_email" name="user_email" placeholder="Enter your email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>--}}
                            <input type="text" class="form-control form_field" id="user_email" name="user_email" placeholder="Enter your email" autocomplete="off">
                            @if ($errors->has('user_email'))
                                <span class="error">{{ $errors->first('user_email') }}</span>
                            @endif
                        </div>
                        <div class="input-group form_group">
                            <button class="form_submit_btn theme_btn w-100">Reset password</button>
                        </div>
                        <p class="text-center">Back to <a href="{{route('user.login')}}"><b>Login</b></a></p>
                    </form>
                    <!--@if(session()->has('message'))-->
                        <div class="alert alert-danger form_error_alert">
                            
                        </div>
                    <!--@endif-->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function forgotFieldValidation(){
            var valid = true;
            $(".error").remove();
            if ($('#user_email').val() == "") {
                $("#user_email").after(
                    '<span class="error">Email field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#reset_password').submit(function(event) {
            event.preventDefault();
           
            var formData = new FormData($(this)[0]);
            if(forgotFieldValidation()){
                //  alert('click');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('forgot-password') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['status'] == 1) {
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html(response.message);
                            $('#reset_password')[0].reset();
                        }else{
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-danger').html(response.message);
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
