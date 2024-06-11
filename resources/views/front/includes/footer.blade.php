<footer class="footer">
    <div class="container">
        <div class="row header_inner">
            <div class="col-md-12 image-div">
                <a href="{{ url('/') }}"><img src="{{ asset('front/assets/images/header/BNE-Logo.svg') }}" class="footer_logo" alt="Logo" style="display:none;"></a>
            </div>
            <div class="col-sm-12 col-md-9 header_left">
                <!-- <a href="{{route('eventList')}}" class="header-link" style="padding-right:10px;"> Home</a> -->
                
               
                @foreach($page as $value)
                    @if($value->show_in_footer == 1)
                        <a href="{{url('page/'.$value->permalink)}}" class="header-link" style="padding-right:10px;">{{ucwords ($value->page_title)}}</a>
                    @endif
                @endforeach
                <a href="https://form.typeform.com/to/BkjKZBu2" class="header-link" style="padding-right:10px;">Contact Us</a>
                <!--<a href="{{route('eventList')}}" class="header-link" style="padding-right:10px;"> Home</a>-->
                <!--<a href="{{route('aboutUs')}}" class="header-link" style="padding-right:10px;"> About Us</a>-->
                <!--<a href="{{route('privacyPolicy')}}" class="header-link" style="padding-right:10px;"> Privacy Policy</a>-->
                <!--<a href="{{route('refundPolicy')}}" class="header-link" style="padding-right:10px;"> Refund Policy</a>-->
                <!--<a href="https://form.typeform.com/to/BkjKZBu2" class="header-link" style="padding-right:10px;">Contact Us</a>-->
                <!--<a href="{{route('termsConditions')}}" class="header-link" style="padding-right:10px;" >Terms & Conditions</a>-->
                <!--<a href="{{route('cancellationPolicy')}}" class="header-link" >Cancellation Policy</a> -->
            </div>
             <div class="col-sm-12 col-md-3 header_right">
                © BNE <?php echo date("Y"); ?> • All rights reserved
            </div>
        </div>
        <div style="margin-top: 15px;">
            <img src="{{asset('front/assets/images/footer4.png')}}" width="100%"/>
        </div>
    </div>
</footer>