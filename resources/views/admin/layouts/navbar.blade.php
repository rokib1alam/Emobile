<nav class="pc-header">
    <div class="header-wrapper">
        <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i
                            class="ph-duotone ph-list"></i></a></li>
                <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i
                            class="ph-duotone ph-list"></i></a></li>
                <li class="dropdown pc-h-item"><a
                        class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                        aria-expanded="false"><i class="ph-duotone ph-magnifying-glass"></i></a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-1">
                            <div class="form-group mb-0 d-flex align-items-center"><input type="search"
                                    class="form-control border-0 shadow-none" placeholder="Search here. . .">
                                <button class="btn btn-light-secondary btn-search">Search</button></div>
                        </form>
                    </div>
                </li>
            </ul>
        </div><!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ph-duotone ph-sun-dim"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown"><a href="#!" class="dropdown-item"
                            onclick="layout_change('dark')"><i class="ph-duotone ph-moon"></i> <span>Dark</span>
                        </a><a href="#!" class="dropdown-item" onclick="layout_change('light')"><i
                                class="ph-duotone ph-sun-dim"></i> <span>Light</span> </a><a href="#!"
                            class="dropdown-item" onclick="layout_change_default()"><i
                                class="ph-duotone ph-cpu"></i> <span>Default</span></a></div>
                </li>
                {{-- <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ph-duotone ph-bell"></i>
                        <span class="badge bg-danger pc-h-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown"
                         style="max-height: calc(100vh - 235px);" data-simplebar>
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h4 class="m-0">Notifications</h4>
                        </div>

                        <div class="dropdown-body text-wrap header-notification-scroll">
                            <ul class="list-group list-group-flush">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    @php
                                        $image = $notification->data['image'] ?? null;
                                    @endphp
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $image ? asset($image) : asset('assets/images/default-avatar.png') }}"
                                                alt="Admin Image" class="rounded-circle" width="40" height="40">
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="mb-0 text-truncate">
                                                        {{ $notification->data['admin_name'] ?? 'Unknown Admin' }}
                                                    </h5>
                                                    <span class="text-sm text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-muted mt-1 mb-0">
                                                    {{ $notification->data['message'] ?? 'New notification' }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">No new notifications</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="dropdown-footer">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <a href="{{ route('notifications.markAllAsRead') }}" class="btn btn-outline-secondary w-100">Mark all as read</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li> --}}

                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ph-duotone ph-bell"></i>
                        <span class="badge bg-danger pc-h-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown"
                         style="max-height: calc(100vh - 235px); overflow-y: auto; padding: 0; width: 100%; box-sizing: border-box;">

                        <div class="dropdown-header d-flex align-items-center justify-content-between"
                             style="padding: 15px;">
                            <h4 class="m-0">Notifications</h4>
                            <a href="{{ route('notifications.clearAll') }}" class="text-danger small d-flex align-items-center">
                                <i class="ti ti-x f-18"></i>
                            </a>
                        </div>

                        @php
                            use Illuminate\Support\Carbon;
                            $newNotifications = auth()->user()->unreadNotifications->filter(function ($notification) {
                                $created = Carbon::parse($notification->created_at);
                                return $created->isToday() || $created->isYesterday();
                            });

                            $earlierNotifications = auth()->user()->unreadNotifications->filter(function ($notification) {
                                $created = Carbon::parse($notification->created_at);
                                return !$created->isToday() && !$created->isYesterday();
                            });
                        @endphp

                        <div class="dropdown-body text-wrap header-notification-scroll" style="width: 100%;">
                            <ul class="list-group list-group-flush" style="margin: 0; padding: 0; list-style: none; width: 100%;">
                                {{-- New Notifications --}}
                                @if($newNotifications->count())
                                    <li class="list-group-item" style="padding: 10px 15px; border-bottom: 1px solid #ddd; width: 100%; box-sizing: border-box;">
                                        <h5 class="text-span mb-0">New</h5>
                                    </li>
                                    @foreach($newNotifications as $notification)
                                        @php $image = $notification->data['image'] ?? null; @endphp
                                        <li class="list-group-item" style="padding: 10px 15px; border-bottom: 1px solid #ddd; width: 100%; box-sizing: border-box;">
                                            <div class="d-flex align-items-center p-2" style="gap: 10px;">
                                                <img src="{{ $image ? asset($image) : asset('assets/images/default-avatar.png') }}"
                                                     alt="Admin Image" class="rounded-circle border" width="40" height="40"
                                                     style="padding: 5px; border: 1px solid #ddd;">
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="mb-0 text-truncate ps-4">
                                                            {{ $notification->data['admin_name'] ?? 'Unknown Admin' }}
                                                        </h5>
                                                        <span class="text-sm text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-muted mt-1 mb-0">
                                                        {{ $notification->data['message'] ?? 'New notification' }}
                                                    </p>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                @endif

                                {{-- Earlier Notifications --}}
                                @if($earlierNotifications->count())
                                    <li class="list-group-item" style="padding: 10px 15px; border-bottom: 1px solid #ddd; width: 100%; box-sizing: border-box;">
                                        <p class="text-muted mb-0 fw-semibold">Earlier</p>
                                    </li>
                                    @foreach($earlierNotifications as $notification)
                                        @php $image = $notification->data['image'] ?? null; @endphp
                                        <li class="list-group-item" style="padding: 10px 15px; border-bottom: 1px solid #ddd; width: 100%; box-sizing: border-box;">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $image ? asset($image) : asset('assets/images/default-avatar.png') }}"
                                                     alt="Admin Image" class="rounded-circle" width="40" height="40">
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="mb-0 text-truncate">
                                                            {{ $notification->data['admin_name'] ?? 'Unknown Admin' }}
                                                        </h5>
                                                        <span class="text-sm text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-muted mt-1 mb-0">
                                                        {{ $notification->data['message'] ?? 'New notification' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                                {{-- No Notifications --}}
                                @if($newNotifications->isEmpty() && $earlierNotifications->isEmpty())
                                    <li class="list-group-item text-center text-muted"
                                        style="padding: 10px 15px; border-bottom: 1px solid #ddd; width: 100%; box-sizing: border-box;">
                                        No new notifications
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="dropdown-footer">
                            <div class="d-grid">
                                {{-- Optional: Mark all as read --}}
                                <a href="{{ route('notifications.index') }}" class="btn btn-outline-secondary w-100">Mark all as read</a>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img
                            src="{{ asset(Auth::user()->image) }}"
                            alt="user-image"
                            class="user-avtar rounded-circle"
                        />
                        </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h4 class="m-0">Profile</h4>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative"
                                style="max-height: calc(100vh - 225px)">
                                <ul class="list-group list-group-flush w-100">
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset(Auth::user()->image) }}"alt="user-image" class="wid-50 rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 mx-3">
                                                <h5 class="mb-0">{{Auth::user()->name}}</h5><a class="link-primary"
                                                    href="mailto:carson.darrin@company.io">{{Auth::user()->email}}</a>
                                            </div><span class="badge bg-primary">PRO</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.password.change') }}" class="dropdown-item">
                                            <span class="d-flex align-items-center"><i class="ph-duotone ph-key"></i>
                                                <span>Change password</span>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item"><span class="d-flex align-items-center"><i class="ph-duotone ph-user-circle"></i> <span>Edit profile</span> </span></a>
                                        {{-- <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center"><i class="ph-duotone ph-envelope-simple"></i>
                                                <span>Recently mail</span>
                                            </span>
                                                <div class="user-group"><img src="{{asset('/')}}admin/assets/images/user/avatar-1.jpg" alt="user-image" class="avtar">
                                                    <img src="{{asset('/')}}admin/assets/images/user/avatar-2.jpg" alt="user-image" class="avtar">
                                                    <img src="{{asset('/')}}admin/assets/images/user/avatar-3.jpg" alt="user-image" class="avtar">
                                                </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-calendar-blank"></i>
                                                <span>Schedule meetings</span>
                                            </span>
                                        </a>      --}}
                                    </li>
                                    {{-- <li class="list-group-item">
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-heart"></i>
                                                <span>Favorite</span>
                                            </span>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-arrow-circle-down"></i>
                                                <span>Download</span>
                                            </span>
                                            <span class="avtar avtar-xs rounded-circle bg-danger text-white">10</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-globe-hemisphere-west"></i>
                                                <span>Languages</span>
                                            </span>
                                            <span class="flex-shrink-0">
                                                <select class="form-select bg-transparent form-select-sm border-0 shadow-none">
                                                    <option value="1">English</option>
                                                    <option value="2">Spain</option>
                                                    <option value="3">Arbic</option>
                                                </select>
                                            </span>
                                        </div>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-flag"></i>
                                                <span>Country</span>
                                            </span>
                                        </a>
                                        <div class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-moon"></i>
                                                <span>Dark mode</span>
                                            </span>
                                            <div class="form-check form-switch form-check-reverse m-0">
                                                <input class="form-check-input f-18" id="dark-mode" type="checkbox" onclick="dark_mode()" role="switch">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-user-circle"></i>
                                                <span>Edit profile</span>
                                            </span>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-star text-warning"></i>
                                                <span>Upgrade account</span>
                                                <span class="badge bg-light-success border border-success ms-2">NEW</span>
                                            </span>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-bell"></i>
                                                <span>Notifications</span>
                                            </span>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-gear-six"></i>
                                                <span>Settings</span>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li class="list-group-item">
                                        {{-- <a href="#" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-plus-circle"></i>
                                                <span>Add account</span>
                                            </span>
                                        </a> --}}
                                        <a href="{{ route('admin.logout') }}" id="logout" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-power"></i>
                                                <span>Logout</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
