@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Add event</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')

    <section class="event_detail_sec bookings_list_sec" style="padding: 40px 0;">
        <div class="container">
            <!-- <div class="pb-3" >
                <a href="javascript:void(0);" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left fa-lg"></i></a>
            </div> -->
            <div class="bookig_top_heaer">
                <h1 class="bookig_top_heaer_title">Thank you for your interest</h1>
            </div>
            <p>Before you can create events, we would require some more info from you to understand better of your goals and expectations. Please fill up the form below.</p>
            <div class="add_event_table">
                <form id="request-admin-access" class="register_form">
                    @csrf
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="event_host_by" class="pb-2">Event host name</label>
                            <input type="text" class="form-control form_field_input" id="event_host_by" name="event_host_by" placeholder="Enter event hosted" value="{{$access[0]->set_host_name}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <label for="events_plan" class="pb-2">How many events do you plan to host in a year</label>
                            <input type="number" class="form-control form_field_input" id="events_plan" name="events_plan" placeholder="Enter How many events" value="{{$access[0]->events_plan}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <button class="form_submit_btn theme_btn w-100">Request Admin Access</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Bookings Section end -->
@endsection
@section('scripts')
    <script>
        function fieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#event_host_by').val() == "") {
                $("#event_host_by").after(
                    '<span class="error">Event host field is required</span>'
                );
                valid = false;
            }
            return valid;
        }
        $('#request-admin-access').submit(function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('check-request-admin-access') }}",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response['status'] == 1) {
                        if (fieldValidation()) {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: "{{ route('request-admin-access') }}",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    if (response['status'] == 1) {
                                        $("#request-admin-access")[0].reset();
                                        $("#status").html(
                                            '<div class="alert alert-success" style="top:9%;"><strong>Success!</strong> Request send Successfully.</div>'
                                        );
                                        setTimeout(function () {
                                            $(".alert").css("display", "none");
                                            window.location.href = "{{url('/')}}";
                                        }, 3000);

                                    } else {
                                        $("#status").html(
                                            '<div class="alert alert-danger" style="top:9%;"><strong>Fail!</strong> Something is wrong.</div>'
                                        );
                                        setTimeout(function () {
                                            $(".alert").css("display", "none");
                                        }, 3000);
                                    }
                                }
                            });
                        }
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger" style="top:9%;"><strong>Fail!</strong> Allready request send.</div>'
                        );
                        // setTimeout(function () {
                        //     $(".alert").css("display", "none");
                        // }, 3000);
                    }
                }
            });
        });
    </script>
@endsection
