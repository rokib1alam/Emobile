<div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
    <div class="user-profile-box mb-0">
        <div class="sidebar-header">
            <img src="{{ asset('users/assets/images/logo-blue.svg') }}" alt="header-logo">
        </div>
        <div class="header clearfix">
            @if (Auth::user()->user_image)
                <img src="{{ asset( Auth::user()->user_image) }}" alt="{{ Auth::user()->name }}" class="img-fluid profile-img">
            @else
                <!-- Optional: You can add a default image here if there's no profile image -->
                <img src="{{ asset('users/assets/images/default-profile.png') }}" alt="Default Profile" class="img-fluid profile-img">
            @endif
        </div>

        <div class="active-user">
            <h2>{{ $user->name }}</h2>
        </div>
        <div class="detail clearfix">
            <ul class="mb-0">
                <li>
                    <a class="active" href="{{ route('dashboard') }}">
                        <i class="fa fa-map-marker"></i> ড্যাশবোর্ড
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}">
                        <i class="fa fa-user"></i> প্রোফাইল
                    </a>
                </li>
                {{-- <li>
                    <a href="">
                        {{ route('change.password') }}
                        <i class="fa fa-lock"></i> পাসওয়ার্ড পরিবর্তন করুন
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="fas fa-sign-out-alt"></i> লগ আউট
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
    <div class="col-lg-12 mobile-dashbord dashbord">
        <div class="dashboard_navigationbar dashxl">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">
                    <i class="fa fa-bars pr10 mr-2"></i> ড্যাশবোর্ড নেভিগেশন
                </button>
                <ul id="myDropdown" class="dropdown-content">
                    <li>
                        <a class="active" href="{{ route('dashboard') }}">
                            <i class="fa fa-map-marker mr-3"></i> ড্যাশবোর্ড
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.index') }}">
                            <i class="fa fa-user mr-3"></i> প্রোফাইল
                        </a>
                    </li>
                    <li>
                        {{-- <a href=" {{ route('properties.index') }}"> --}}
                            <i class="fa fa-list mr-3" aria-hidden="true"></i> আমার সম্পত্তি
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('properties.create') }}">
                            <i class="fa fa-heart mr-3" aria-hidden="true"></i> পছন্দের সম্পত্তি
                        </a>
                    </li> --}}
                    <li>
                        <a href="">
                            <i class="fa fa-list mr-3" aria-hidden="true"></i> সম্পত্তি/জমি যোগ করুন
                        </a>
                    </li>
                    {{-- <li>
                        <a href="">
                            <i class="fa fa-lock mr-3"></i> পাসওয়ার্ড পরিবর্তন করুন
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt mr-3"></i> লগ আউট
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>




