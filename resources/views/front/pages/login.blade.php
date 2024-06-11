@extends('front.layout.main')
@section('header')
    <?php
    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    ?>
@endsection
@section('title')
    <title>{{env('APP_NAME')}} | login</title>
@endsection
@section('main')
    @if (Session::has('register'))
{{--        @php--}}
{{--            Session::forget('register');--}}
{{--        @endphp--}}
        <div><div class="alert alert-success">You're Successfully Registered.</div></div>
    @endif
    <section class="register_form_sec">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 register_form_inner m-auto">
                    <h1 class="text-center form_title">Login</h1>
                    <form id="user_login" action="{{url('user-login')}}" method="post" class="register_form">
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
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-pass.svg')}}" alt="" width="20px"></div>
{{--                            <input type="password" class="form-control form_field" id="password" name="password" placeholder="Enter your password" autocomplete="off" minlength="8" required>--}}
                            <input type="password" class="form-control form_field" id="password" name="password" placeholder="Enter your password" autocomplete="off">

                            @if ($errors->has('password'))
                                <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <a href="{{route('forgot')}}" class="forgot float-end">Forgot your password?</a>
                        <div class="input-group form_group">
                            <button class="form_submit_btn theme_btn w-100">Login</button>
                        </div>
                        <p class="text-center">Don’t have an account? <a href="{{route('user_register')}}"><b>Register</b></a></p>
                    </form>
                    @if(session()->has('message'))
                        <div class="alert alert-danger form_error_alert" style="top:8.2%;">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            @if(session()->has('register'))
                @php
                    Session::forget('register');
                @endphp
                setTimeout(function() {
                    window.location.href="{{ url('/login') }}"
                }, 3000);
            @endif

            if ($('#password').val() == "") {
                $('.form_submit_btn').attr('disabled', 'disabled');
                $('.form_submit_btn').css('background-color', '#ffffff61');
                $('.form_submit_btn').css('color', '#ffffff61');
            }
            $('#password').keyup(function (){
                if ($('#password').val() == "") {
                    $('.form_submit_btn').attr('disabled', 'disabled');
                    $('.form_submit_btn').css('background-color', '#ffffff61');
                    $('.form_submit_btn').css('color', '#ffffff61');
                }else{
                    $('.form_submit_btn').removeAttr('disabled');
                    $('.form_submit_btn').removeAttr('style');
                }

            })
        })
    </script>
@endsection

