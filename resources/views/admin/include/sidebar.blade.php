<a id="show-sidebar" class="sidebar_toggle">
    <i class="fas fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="header_top">
            <div class="logo">
                <!--<a href="dashboard"><img class="img-responsive logo_img " src="{{ url('front/assets/images/header/BNE-Logo.svg') }}" alt="User picture"></a>-->
            </div>
        </div>
        <div class="sidebar-menu">
            <ul>
                @if(request()->is('admin/*'))
                    <li class="nav_menu {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="/admin/dashboard">
{{--                            <i class="fas fa-tachometer-alt"></i>--}}
{{--                            <i class="fa-solid fa-tachograph-digital"></i>--}}
                            <img src="{{asset('admin/assets/images/dashboard.svg')}}" class="image_icon" width="12%">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/event') ? 'active' : '' }}">
                        <a href="/admin/event">
{{--                            <i class="fas fa-tachometer-alt"></i>--}}
                            <img src="{{asset('admin/assets/images/event.svg')}}" class="image_icon" width="12%">
                            <span>Event</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/event_ticket') ? 'active' : '' }}">
                        <a href="/admin/event_ticket">
                            <img src="{{asset('admin/assets/images/event-tickets.svg')}}" class="image_icon" width="12%">
                            <span>Event Tickets</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/event_coupons') ? 'active' : '' }}">
                        <a href="/admin/event_coupons">
                                <img src="{{asset('admin/assets/images/event-coupons.svg')}}" class="image_icon" width="12%">
                            <span>Event Coupons</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/booking_history') ? 'active' : '' }}">
                        <a href="/admin/booking_history">
                            {{--                            <i class="fas fa-tachometer-alt"></i>--}}
                            <img src="{{asset('admin/assets/images/booking-history.svg')}}" class="image_icon" width="12%">
                            <span>Booking histories</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/user') ? 'active' : '' }}">
                        <a href="/admin/user">
{{--                            <i class="fa-solid fa-user"></i>--}}
                            <img src="{{asset('admin/assets/images/user.svg')}}" class="image_icon" width="12%">
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/scan-ticket') ? 'active' : '' }}">
                        <a href="/admin/scan-ticket">
                            {{--                            <i class="fa-solid fa-user"></i>--}}
                            <img src="{{asset('admin/assets/images/qr-code.svg')}}" class="image_icon" width="12%">
                            <span>Scan Ticket</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/bne-settings') ? 'active' : '' }}">
                        <a href="/admin/bne-settings">
{{--                            <i class="fa-solid fa-user"></i>--}}
                            <img src="{{asset('admin/assets/images/user.svg')}}" class="image_icon" width="12%">
                            <span>BNE settings</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/bne-payment') ? 'active' : '' }}">
                        <a href="/admin/bne-payment">
{{--                            <i class="fa-solid fa-user"></i>--}}
                            <img src="{{asset('admin/assets/images/payment-getway.svg')}}" class="image_icon" width="12%">
                            <span>Payment Gateway</span>
                        </a>
                    </li>
                    <li class="nav_menu {{ request()->is('admin/pages') ? 'active' : '' }}">
                        <a href="/admin/pages">
{{--                            <i class="fa-solid fa-user"></i>--}}
                            <img src="{{asset('admin/assets/images/page.svg')}}" class="image_icon" width="12%">
                            <span>Pages</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
</nav>
