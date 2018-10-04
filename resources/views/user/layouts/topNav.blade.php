<!-- Toggle sideNav Button -->
<div class="col-auto d-lg-none d-flex align-items-center justify-content-center px-2">
    <a href="#" onclick='$("#sideNav").toggle()'><i class="fas fa-align-justify"></i></a>
</div>
<!-- Side Name -->
<div class="col-auto d-flex align-items-start pb-2">
    <div id="siteName">
        <a href="{{ route('home') }}" class=""><i class="fa fa-home pr-2"></i>{{ config('app.name') }}</a>
    </div>
</div>
<!-- User Logo and Logout -->
<div class="col-auto ml-auto">
   <div class="row">
    <a href="{{ route('admin.home') }}" class="col-auto d-flex align-items-center">
        <span class="auth-name">{{ Auth::user()->name }}</span>
    </a>
    <div class="col-auto p-0">
        <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('media/500.png') }}" alt="No Avatar" width="30" height="30" class="dropdown-toggle" id="dropdownUserLogout" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUserLogout" id="topNavAuth">
            <div class="dropdown-item media">
                <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('media/500.png') }}" alt="No Avatar" class="" width="70" height="70">
                <div class="media-body pl-3">
                    <p class="mb-0"><a href="{{ route('user.profile', Auth::id()) }}">{{ Auth::user()->name }}</a></p>
                    <p class="mb-0"><a href="{{ route('user.profile.edit', Auth::id()) }}">Edit Profile</a></p>
                    <p class="mb-0"><a href="#" onclick="$('#logout-form').submit()">Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
   </div>

</div>
