@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Register</title>
@endsection
@section('main')
{{--    @if (Session::has('register-email'))--}}
{{--        @php--}}
{{--            Session::forget('register-email');--}}
{{--        @endphp--}}
        <div class="allready" style="display: none;"><div class="alert alert-danger">Email allready exists</div></div>
{{--    @endif--}}
    <!-- Register Section start -->
    <section class="register_form_sec">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 register_form_inner m-auto">
                    <h1 class="text-center form_title">Register</h1>
                    <form id="user_register" class="register_form">
                        @csrf
                       <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="user_first_name" name="user_first_name" placeholder="Enter your first name" autocomplete="off">
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="user_last_name" name="user_last_name" placeholder="Enter your last name" autocomplete="off">
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-mail.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="user_email" name="user_email"  placeholder="Enter your email address" autocomplete="off">
                        </div>

                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-phone-call.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="user_number" name="user_number" placeholder="Enter your mobile number" autocomplete="off">
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-pass.svg')}}" alt="" width="20px"></div>
                            <input type="password" class="form-control form_field" id="password" name="password" placeholder="Create your password">
                        </div>
{{--                        <label>Chosen profile photo</label>--}}
                        <div class="input-group form_group">
                            <label for="user_profile_photo" style="margin-bottom: 7px; color: #ffffff;">Upload Profile Image</label>
                            <input type="file" class="input_container" id="user_profile_photo" name="user_profile_photo" style="width: 100%; color: #ffffff61;">
                        </div>
                        <div class="input-group form_group">
                            <button class="form_submit_btn theme_btn w-100">Register</button>
                        </div>
                        <p class="text-center">Already have an account? <a href="{{route('user.login')}}"><b>Login</b></a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        {{--$(document).ready(function (){--}}
        {{--    var set = "<?= isset($_GET['register-email'])?>";--}}
        {{--    alert(set);--}}
        {{--    if(set != ""){--}}
        {{--        setTimeout(function() {--}}
        {{--            window.location.href="{{ url('/register') }}"--}}
        {{--        }, 3000);--}}
        {{--    }--}}
        {{--})--}}
        $(document).ajaxSend(function() {
            $("#loader").fadeIn(300);
        });

        function fieldValidation(){
            var valid = true;
            $(".error").remove();
            if ($('#user_first_name').val() == "") {
                $("#user_first_name").after(
                    '<span class="error">User first name field is required</span>'
                );
                valid = false;
            }
            if ($('#user_last_name').val() == "") {
                $("#user_last_name").after(
                    '<span class="error">User last name field is required</span>'
                );
                valid = false;
            }
            if ($('#user_email').val() == "") {
                $("#user_email").after(
                    '<span class="error">Email field is required</span>'
                );
                valid = false;
            }
            if ($('#user_number').val() == "") {
                $("#user_number").after(
                    '<span class="error">Number field is required</span>'
                );
                valid = false;
            }
            if ($('#password').val() == "") {
                $("#password").after(
                    '<span class="error">Password field is required</span>'
                );
                valid = false;
            }

            // if ($('#user_profile_photo').val() == "") {
            //     $("#user_profile_photo").after(
            //         '<span class="error">User profile field is required</span>'
            //     );
            //     valid = false;
            // } else {
            //     for (var i = 0; i < $("#user_profile_photo").get(0).files.length; ++i) {

            //         var img = $("#user_profile_photo").get(0).files[i].name;

            //         var img_ext = img.split('.').pop().toLowerCase();
            //         if ($.inArray(img_ext, ['jpg', 'jpeg', 'png']) === -1) {
            //             $('#user_profile_photo').after("<span class='error'>File (" + img + ") type not allowed.</span>");
            //             valid = false;
            //         }
            //     }
            // }
            if ($('#user_profile_photo').val() != "") {
                var file_size = $('#user_profile_photo')[0].files[0].size;
                if (file_size > 1048576) {
                    $("#user_profile_photo").after(
                        '<span class="error">File size must be less than 1MB</span>'
                    );

                    valid = false;
                }
            }
            return valid;
        }
        $('#user_register').submit(function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            if(fieldValidation()){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ url('user-register') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 'exist') {
                            // alert(response.status);
                            $('.allready').removeAttr('style');
                            {{--window.location.href="{{url('register')}}"--}}
                        }
                        if (response['status'] == 1) {
                            // alert(response.status);
                            window.location.href="{{url('login')}}"
                        }
                        document.getElementById("user_register").reset();
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
