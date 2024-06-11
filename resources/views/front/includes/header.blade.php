<?php $user = Auth::user();
$guest_user = Session::get('user');
$permission = Session::get('permission');
?>
<!-- Header start -->
<section class="header">
    <div class="container">
        <div class="row header_inner">
            <div class="col-sm-6 header_left">
                <a href="{{ url('/') }}"><img src="{{ asset('front/assets/images/header/BNE-Logo.svg') }}" class="header_logo" alt="Logo"></a>
            </div>
            <div class="col-sm-6 header_right text-end">
                <div class="dropdown">

                    @if (auth()->check())
                        <span class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ucfirst($user->user_first_name)}}</span>
                            @if($user->user_profile_photo != '')
                                <img src="{{ asset('front/assets/images/user-profile/'.$user->user_profile_photo) }}" class="header_user_icon rounded-circle" alt="User">
                            @else
                                <img src="{{ asset('front/assets/images/header/User.svg') }}" class="header_user_icon" alt="User">
                            @endif
                            
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{route('edit_profile')}}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('booking')}}">My Bookings</a></li>
                            @if($user->set_event_create == 1)
                            <li><a class="dropdown-item" href="{{route('event')}}">My Events</a></li>
                            @endif
                            @if($permission[0]->permission == 0)
                                @if($user->set_event_create != 1)
                                <li><a class="dropdown-item" href="{{route('request-access')}}">Create an event</a></li>
                                @endif
                            @endif
                            <li><a class="dropdown-item" href="{{ route('LogoutUser') }}">Logout</a></li>
                        </ul>
                    @elseif($guest_user != null)
                        <span class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ucfirst($guest_user[0]->user_first_name)}}</span>
                            @if($guest_user[0]->user_profile_photo != '')
                                <img src="{{ asset('front/assets/images/user-profile/'.$guest_user[0]->user_profile_photo) }}" class="header_user_icon rounded-circle" alt="User">
                            @else
                                <img src="{{ asset('front/assets/images/header/User.svg') }}" class="header_user_icon" alt="User">
                            @endif
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="{{route('edit_profile')}}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('booking')}}">My Bookings</a></li>
                            <li><a class="dropdown-item" href="{{ route('LogoutUser') }}">Logout</a></li>
                        </ul>
                    @else
                        <a href="{{route('user.login')}}"><img src="{{asset('front/assets/images/header/User.svg')}}" class="header_user_icon" alt="User"></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Header end-->
