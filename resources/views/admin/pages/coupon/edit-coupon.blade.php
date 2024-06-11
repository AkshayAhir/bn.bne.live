@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Add Coupon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endsection
@section('content')
    <section class="event_detail_sec bookings_list_sec" style="padding: 40px 0;">
        <div class="container">
{{--            {{$event_coupon[0]}}--}}
            <div class="bookig_top_heaer">
                <h4 class="bookig_top_heaer_title">Edit New Event Coupon</h4>
            </div>
            <div class="add_event_table">
                <form id="add-event-coupon" class="register_form">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{$event_coupon[0]->id}}">
                    <div class="form-group  col-md-12 trending_formgroup">
                        <label for="title">Event name</label>
                        <input class="type form-control search_box" id="search" type="text" placeholder="Enter event name" value="{{$event_coupon[0]->event['event_name']}}">
                        <input type="hidden" name="event_id" id="event_id" value="{{$event_coupon[0]->event['id']}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form_group">
                            <label for="coupon_code">Coupon code</label>
                            <input type="text" class="form-control form_field_input" id="coupon_code" name="coupon_code" placeholder="Enter coupon code" autocomplete="off" value="{{$event_coupon[0]->coupon_code}}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="coupon_code">Coupon discount</label>
                        <div class="form_group input-group">
                            <input type="number" class="form-control" name="coupon_discount" id="coupon_discount" placeholder="Enter Discount" value="{{$event_coupon[0]->coupon_value}}">
                            <select class="btn-light discount_flag" id="discount_flag" name="discount_flag">
                                @if( $event_coupon[0]->discount_flag == "%")
                                    <option value="{{ $event_coupon[0]->discount_flag }}" {{ $event_coupon[0]->discount_flag == $event_coupon[0]->discount_flag ? 'selected' : '' }}>{{ $event_coupon[0]->discount_flag }}</option>
                                    <option value="$">$</option>
                                @else
                                    <option value="%">%</option>
                                    <option value="{{ $event_coupon[0]->discount_flag }}" {{ $event_coupon[0]->discount_flag == $event_coupon[0]->discount_flag ? 'selected' : '' }}>{{ $event_coupon[0]->discount_flag }}</option>
                                @endif

                            </select>
                        </div>
                        <div id="discount_error"></div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group ">
                            <label for="title">No of Coupon</label>
                            <input type="number" class="form-control" name="no_of_coupon" id="no_of_coupon" placeholder="Enter number of coupon" value="{{$event_coupon[0]->no_of_coupon}}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="apply_discount" id="apply_discount" {{$event_coupon[0]->apply_discount ? 'checked' : ''}}>
                            <label class="form-check-label" for="apply_discount">
                                Only apply discount once per order
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form_group">
                            <button class="btn btn-submit add_trending_btn theme_btn w-100">submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
    <!-- Bookings Section end -->
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $( "#search" ).autocomplete({
            minLength: 0,
            scroll: true,
            autofocus: true,
            source: function( request, response ) {
                $.ajax({
                    url: "{{ route('autocomplete') }}",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#search').val(ui.item.label);
                $('#event_id').val(ui.item.id);
                console.log(ui.item);
                return false;
            }
        });

        $('input[type="checkbox"]').change(function() {
            $('#apply_discount').attr("checked");
        });
        // add field validation
        function fieldValidation() {
            var valid = true;
            $(".error").remove();
            if ($('#search').val() == "") {
                $("#search").after(
                    '<span class="error">Event name field is required</span>'
                );
                valid = false;
            }
            if ($('#coupon_code').val() == "") {
                $("#coupon_code").after(
                    '<span class="error">Coupon Code field is required</span>'
                );
                valid = false;
            }
            if ($('#coupon_discount').val() == "") {
                $("#discount_error").after(
                    '<span class="error">Coupon discount field is required</span>'
                );
                valid = false;
            }
            if ($('#no_of_coupon').val() == "") {
                $("#no_of_coupon").after(
                    '<span class="error">Coupon discount field is required</span>'
                );
                valid = false;
            }
            return valid;
        }

        $('#add-event-coupon').on('submit',function(event){
            event.preventDefault();
            if (fieldValidation()) {
                // alert('done');
                var formData = new FormData($(this)[0]);
                if($('input[type="checkbox"]:checked').val()){
                    var dis =1;
                }else{
                    var dis = 0;
                }
                formData.append("apply_discount", dis);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('edit_event_coupon') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 1) {
                            // $("#add-event-coupon")[0].reset();
                            $("#status").html(
                                '<div class="alert alert-success"><strong>Success!</strong> Event coupon Edit Successfully.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                                window.location.href = "{{route('event_coupon')}}";
                            }, 3000);
                        } else {
                            $("#status").html(
                                '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                            );
                            setTimeout(function () {
                                $(".alert").css("display", "none");
                            }, 3000);
                        }
                    }
                });
            }
        });
    </script>
@endsection
