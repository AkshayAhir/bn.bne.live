@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Booking history</title>
@endsection
@section('main')
<div><div class="alert alert-success d-none"></div></div>
    <!-- Edit Profile Section start -->
    <section class="register_form_sec edit_profile_sec">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 register_form_inner m-auto">
                    <div class="edit_profile_header text-center">
                        <img class="profile_img " src="{{asset('front/assets/images/user-profile/'.$user[0]['user_profile_photo'])}}" alt="profile">
                        <!--<h1 class="edit_profile_title">{{$user[0]['user_name']}}</h1>-->
                    </div>
                    <form class="register_form" id="update_form">
                        @csrf
                       <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="edit_user_first_name" name="edit_user_first_name" placeholder="Enter your first Name" value="{{$user[0]['user_first_name']}}">
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-user.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="edit_user_last_name" name="edit_user_last_name" placeholder="Enter your last name" value="{{$user[0]['user_last_name']}}">
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-mail.svg')}}" alt="" ></div>
                            <input type="text" class="form-control form_field" id="email" name="email" placeholder="Enter your email address" value="{{$user[0]['user_email']}}" readonly>
                        </div>
                        <div class="input-group form_group">
                            <div class="input-group-text">
                                <img src="{{asset('front/assets/images/ic-phone-call.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="edit_user_number" name="edit_user_number" placeholder="Enter your mobile number" value="{{$user[0]['user_number']}}">
                        </div>
                         <div class="input-group form_group">
                            <div class="input-group-text"><img src="{{asset('front/assets/images/ic-host.svg')}}" alt="" width="20px"></div>
                            <input type="text" class="form-control form_field" id="edit_set_host_name" name="edit_set_host_name" placeholder="Enter your host name" value="{{$user[0]['set_host_name']}}">
                            <!--<small id="small">This name is host name</small>-->
                            <div style="width:100%;"><small id="small" >Note:- This name is host name</small></div>
                        </div>
                        <div class="input-group form_group">
                            <label for="edit_user_profile_photo" style="margin-bottom: 7px; color: #ffffff;">Upload Profile Image</label>
                            <input type="file" class="input_container" id="edit_user_profile_photo" name="edit_user_profile_photo" style="width: 100%; color: #ffffff61;">
                        </div>
                        <div class="input-group">
                            <button class="form_submit_btn theme_btn w-100">Save</button>
                        </div>

                    </form>
                    <div class="input-group">
                        <a href="{{ url('user-logout') }}" class="form_submit_btn theme_btn logout_btn w-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Edit Profile Section end -->


@endsection
@section('scripts')
<script>

function editFieldValidation() {
    var valid = true;
    $(".error").remove();

    if ($('#edit_user_name').val() == "") {
        $("#edit_user_name").after(
            '<span class="error">Name field is required!</span>'
        );
        valid = false;
    }
    if ($('#edit_user_number').val() == "") {
        $("#edit_user_number").after(
            '<span class="error">Number field is required!</span>'
        );
        valid = false;
    }
    return valid;
}

$('#update_form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    if(editFieldValidation()){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{ url('update_profile') }}",
            // data: $('#update_form').serialize(),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if(response['status'] == 1){
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
            }
        })
    }
});

// $('#update_form').submit(function(event) {
//     event.preventDefault();
//     if (editFieldValidation()) {
//                $.ajax({
//                 headers: {
//                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                },
//                   url: "{{url('update_profile')}}",
//                   type: "POST",
//                   data: $('#update_form').serialize(),
//                   success: function(response) {
//                         console.log(response);
//                         if(response['status'] == 1){
//                             $('.alert-success').removeClass('d-none');
//                             $('.alert-success').html(response.message);
//                             setTimeout(function() {
//                                 location.reload();
//                             }, 3000);
//                         }
//                   }
//                });
//     }
// });
</script>
@endsection
