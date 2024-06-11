@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | About Us</title>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://bn.bne.live/">
    <meta property="og:title" content="BNE Live">
    <meta property="og:description" content="BNE Live wants to be the platform for ticketing and handling your events. As part of the greater commitment for an overall mission for BNE, our project BNE Live would be able to provide all services related to event management and ticketing. Whether it is to create events or to purchase tickets for an event, we are here to simplify and safely ease the process of event ticketing.">
    <meta property="og:image" content="{{ asset('assets/images/header/BNE-Logo.svg') }}">
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <section class="event_list_sec">
        <div class="container">
            <div class="row">
                <div class="text-center pb-4">
                    <h1>About Us</h1>
                </div>
                <div>
                    <p>Welcome to <b>BNE</b>, where music meets celebration, and innovation takes center stage. 
                    <b>BNE</b> is more than just a website; it's a cultural movement. At <b>BNE</b>, we curate, distribute, and celebrate music, and now, with 
                    <b>BNE</b> Live, we're expanding our horizon to become your all-encompassing event management and ticketing platform.</p>
                    <p>BNE Live is your one-stop solution for all things event-related. Our vision is to seamlessly connect event organizers, artists, and attendees, 
                    ensuring that every event is a resounding success. Whether you're an event creator looking to bring your vision to life or an eager attendee 
                    ready to immerse yourself in the music and festivities, we've got you covered.</p>
                    <p>Our mission is to simplify and enhance the event ticketing process, making it accessible, secure, and user-friendly for all. 
                    With BNE Live, you can effortlessly create and manage events, sell tickets, and reach a wider audience, all while enjoying the peace of mind that comes with our dedicated customer support.</p>
                    <p>If you ever encounter any issues or have questions about using our platform, our support team is just an email away at <b>support@bne.live.
                    </b> We're here to ensure that your experience with BNE Live is smooth and hassle-free.</p>
                    <p>Join us on this exhilarating journey as we usher in a new era of music, celebration, and event management. <b>BNE Live</b> are your partners in shaping unforgettable experiences and celebrating the vibrant culture of the world. Together, we'll make every event a memorable one. </p>
                    <p> Legal Information:<br>
                        Trade Licence: TRAD/DNCC/154813/2022<br>
                        TIN Number: 398911914745
                    </p>
                    <p> Email : support@bne.live<br>
                        Address : House 21, Road 24, Block K, Banani, Dhaka 1213
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection