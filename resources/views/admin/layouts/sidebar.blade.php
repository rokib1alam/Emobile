
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <!-- Change your logo from here -->
                <img src="{{ url($setting->logo) }}" alt="logo image" class="logo-lg" style="max-width: 150px; max-height: 50px;">
                <span class="badge bg-primary rounded-pill ms-2 theme-version">{{ $seo->meta_title }} </span>
            </a>
        </div>

        <div class="card pc-user-card">
            <div class="card-body">
                <div class="nav-user-image">
                    <a data-bs-toggle="collapse" href="#navuserlink">
                        <img
                            src="{{ asset(Auth::user()->image) }}"
                            alt="user-image"
                            class="user-avtar rounded-circle"
                        />

                    </a>
                </div>
                <div class="pc-user-collpsed collapse" id="navuserlink">
                    <h4 class="mb-0">{{Auth::user()->name}}</h4><span>Administrator</span>
                    <ul>
                        <li><a href="{{ route('admin.profile') }}" class="pc-user-links"><i class="ph-duotone ph-user"></i> <span>My Account</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logout') }}"  class="pc-user-links" id="logout" ><i class="ph-duotone ph-power"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>
                <li class="pc-item pc-hasmenu"><a href="{{ route('admin.dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ph-duotone ph-gauge"></i> </span>
                        <span class="pc-mtext">Dashboard</span>
                        <span class="pc-arrow"></span></a>
                </li>
                @role('superadmin|admin')  {{-- Only show to superadmin and admin --}}

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-book"></i></span>
                        <span class="pc-mtext">Main page</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @can('view about')
                            <li class="pc-item"><a class="pc-link" href="{{ route('about.index') }}">About us</a></li>
                        @endcan

                        @can('view slider')
                            <li class="pc-item"><a class="pc-link" href="{{ route('slider.index') }}">Slider Info</a></li>
                        @endcan
                        @can('view choose_us')
                            <li class="pc-item"><a class="pc-link" href="{{ route('choose-us.index') }}">Why choose Us</a></li>
                        @endcan
                        @can('view contact_messages')
                            <li class="pc-item"><a class="pc-link" href="{{ route('contactus.index') }}">Contact US</a></li>
                        @endcan
                        @can('view faq')
                            <li class="pc-item"><a class="pc-link" href="{{ route('faq.index') }}">FAQ</a></li>
                        @endcan
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-book"></i></span>
                        <span class="pc-mtext">Manage Product</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>

                    <ul class="pc-submenu">
                        @can('view product')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('product.index')}}">product</a>
                            </li>
                        @endcan
                        @can('view category')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('category.index')}}">Categories</a>
                            </li>
                        @endcan
                        @can('view subcategory')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('subcategory.index')}}">Subcategories</a>
                            </li>
                        @endcan
                        @can('view childcategory')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('childcategory.index')}}">Childcategories</a>
                            </li>
                        @endcan
                        @can('view brand')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('brand.index')}}">Brand</a>
                            </li>
                        @endcan
                        @can('view pickuppoint')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('pickuppoint.index')}}">Pick Up Point</a>
                            </li>
                        @endcan
                        @can('view campaing')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('campaing.index')}}">Campaing</a>
                            </li>
                        @endcan
                        @can('view coupon')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('coupon.index')}}">Coupon</a>
                            </li>
                        @endcan
                        @can('view brand')
                            <li class="pc-item"><a class="pc-link"
                                href="{{route('warehouse.index')}}">Warehouse</a>
                            </li>
                        @endcan
                        </ul>

                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('permissions.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-users-cog"></i></span>
                        <span class="pc-mtext">Roles & Permissions</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Setting</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('seo.index') }}">SEO Setting</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('website.index') }}">Website Setting</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('page.index') }}">Page Management</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('smtp.index') }}">SMTP Setting</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('registered-admins.index') }}">Registred Admin</a></li>registered-admins
                    </ul>
                </li>

                @endrole

            </ul>
            {{-- <div class="card nav-action-card">
                <div class="card-body">
                    <h5 class="text-white">Help Center</h5>
                    <p class="text-white text-opacity-75">Please contact us for more questions.</p><a
                        target="_blank" href="https://phoenixcoded.authordesk.app/" class="btn btn-primary">Go to
                        help Center</a>
                </div>
            </div> --}}
        </div>
    </div>
</nav>
