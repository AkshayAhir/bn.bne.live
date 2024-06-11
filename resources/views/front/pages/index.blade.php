@extends('front.layout.main')
@section('title')
<title>{{env('APP_NAME')}} | Events</title>

    <meta name="title" content="BNE Live">
    <meta name="description" content="Discover the ultimate music event ticketing platform! Unlock access to a world of unforgettable concerts and festivals with our robust ticketing solution. Secure your spot at the hottest gigs and immerse yourself in the best live music experiences. Buy tickets now!">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://bn.bne.live/">
    <meta property="og:title" content="BNE Live">
    <meta property="og:description" content="Discover the ultimate music event ticketing platform! Unlock access to a world of unforgettable concerts and festivals with our robust ticketing solution. Secure your spot at the hottest gigs and immerse yourself in the best live music experiences. Buy tickets now!">
    <meta property="og:image" content="{{ asset('assets/images/header/BNE-Logo.svg') }}">
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:domain" content="bn.bne.live"/>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
<!-- Event List Section start -->
@if(Session::has('notSent'))
    <div><div class="alert alert-danger">{{Session::get('notSent')}}</div></div>
@endif
 <section class="event_list_sec">
        <div class="container">
            <div class="row">
                <div class="text-center pb-4">
                    <h1>Events</h1>
                </div>
                <div class="grid_event_list">
                    @foreach($event as $value)
                    <!--<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 event_list_box">-->
                        <div class="event_list_box">
                            <div class="event_list_box_inner">
                                <?php  $image = explode(',', $value->event_images); ?>
                                <img src="{{ asset('admin/assets/images/event/'.$image[$value['is_feature']]) }}" class="event_list_img_list">
                                <div class="event_list_content">
                                    <h4>{{$value['event_name']}}</h4>
                                    <p class="event_list_time">{{ date('D, M dS', strtotime($value['event_date'])) }}, {{ date('g:i A', strtotime($value['event_start_time'])) }}</p>
                                    <p class="event_list_host"><em>{{$value['event_location']}}</em></p>
                                    <div class="attend_main">
                                        <a href="{{url('event-details/'.$value['id'])}}" class="attend_button">I WANNA ATTEND<img src="{{asset('front/assets/images/export.svg')}}" style="padding-left: 10px;width: 29px;"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $event->onEachSide(2)->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
<script>
    $(document).ready(function (){
        var set = "<?= Session::get('sent')?>";
        var notSent = "<?= Session::get('notSent')?>";
        // alert(set);
        if(set != "" || notSent!= ""){
            <?php Session::forget('sent'); ?>
            <?php Session::forget('notSent'); ?>
            setTimeout(function() {
                window.location.href="{{ url('/') }}"
            }, 3000);
        }
    })
</script>
@endsection
