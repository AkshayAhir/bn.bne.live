<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{env('APP_NAME')}} | Admin-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('front/assets/images/header/BNE-Logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
</head>

<body class="login_page admin_login_page">
    <div class="Ellipse"></div>
<div class="page-wrapper chiller-theme toggled">
    <main class="page-content">
        <div class="container">
            <div class="row justify-content-center login_area">
                <div class="col-md-4 login_page_form">
                    <div class="form_logo">
                        <img src="{{ asset('front/assets/images/header/BNE-Logo.svg') }}" alt="">
                        <h5>LOGIN TO YOUR ACCOUNT</h5>
                    </div>
                    <form class="loginuser" action="{{url('admin/login_data')}}" method="POST" id="logForm">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email" name="email"  placeholder="Enter Email Address...">
                            @if ($errors->has('email'))
                                <span class="error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <button class="btn btn-block login_btn" type="submit">Sign In</button>
                    </form>
                    @if(session()->has('message'))
                        <div class="alert alert-danger form_error_alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{ asset('admin/assets/js/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
