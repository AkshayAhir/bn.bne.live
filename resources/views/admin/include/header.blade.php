<nav class="page-header">
    <div class="header-content">
        @if (Auth::guard('admin')->check() && request()->is('admin/*'))
            <div class="dropdown admin-menu">
                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">
                    <img class="profile-image" src="{{ url('admin/assets/images/profile.jpg') }}" alt="">{{Auth::guard('admin')->user()->name}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/admin/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        @endif
    </div>
</nav>
