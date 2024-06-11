<!DOCTYPE html>
<html lang="en">
@yield('header')
<head>
    @yield('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('front/assets/images/header/BNE-Logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B971WJM4CX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-B971WJM4CX');
    </script>
</head>

<body>

<div id="loader" class="background-loader" style="display: none;">
    <div class="loader">
        <span class="spinner spinner1"></span>
        <span class="spinner spinner2"></span>
        <span class="spinner spinner3"></span>
        <br>
        <span class="loader-text">LOADING...</span>
    </div>
</div>

<div class="main">
    @yield('main')
    @include('front.includes.footer')
</div>
<script src="{{ asset('admin/assets/js/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function logout(id){
        // alert(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{ url('user-logout') }}/" + id,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                {{--if (response['status'] == 1) {--}}
                {{--    // alert(response.status);--}}
                {{--    window.location.href="{{url('login')}}"--}}
                {{--}--}}
            }
        });
    }
</script>
@yield('scripts')
</body>

</html>
