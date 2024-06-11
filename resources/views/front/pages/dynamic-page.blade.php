@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | {{ucwords($data->page_title)}}</title>
    <meta name="title" content="{{ucwords($data->meta_title)}}">
    <meta name="description" content="{{$data->meta_description}}">
    <meta property="og:url" content="{{url('/page/'.$data->permalink)}}">
    <meta property="og:title" content="{{ucwords($data->page_title)}}">
    <meta property="og:description" content="{{$data->meta_description}}">
    @if(isset($data->feature_image))
    <meta property="og:image" content="{{asset('admin/assets/images/page/'.$data->feature_image)}}">
    @else
    <meta property="og:image" content="{{asset('front/assets/images/header/BNE-Logo.svg')}}">
    @endif
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <section class="event_list_sec">
        <div class="container">
            <div class="row">
                <div class="text-center pb-4">
                    <h1>{{ ucwords($data->page_title) }}</h1>
                </div>
                <div>
                {!! $data->page_description !!}
                </div>
            </div>
        </div>
    </section>
@endsection




