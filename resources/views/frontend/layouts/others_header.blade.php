<header class="header_wrap fixed-top  header_with_topbar">
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img class="logo_light" src="{{ url($setting->logo) }}" alt="logo" style="max-width: 150px; max-height: 50px;" />
                    <img class="logo_dark" src="{{ url($setting->logo) }}" alt="logo" style="max-width: 150px; max-height: 50px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        @foreach($categories as $category)
                            <li class="dropdown dropdown-mega-menu">
                                <a class="nav-link" href="{{ route('slug.handler', $category->category_slug) }}">
                                    {{ $category->category_name }}
                                </a>

                                @if($category->subcategories->isNotEmpty())
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            @foreach($category->subcategories as $sub)
                                                <li class="mega-menu-col col-lg-3">
                                                    <ul>
                                                        <li class="dropdown-header">
                                                            <a href="{{ route('slug.handler', $sub->subcategory_slug) }}"
                                                                class="text-decoration-none"
                                                                style="color: black;"
                                                                onmouseover="this.style.color='red';"
                                                                onmouseout="this.style.color='black';">
                                                                {{ $sub->subcategory_name }}
                                                            </a>
                                                        </li>

                                                        @if($sub->childCategories->isNotEmpty())
                                                            @foreach($sub->childCategories as $child)
                                                                <li>
                                                                    <a class="dropdown-item nav-link nav_item"
                                                                    href="{{ route('slug.handler', $child->childcategory_slug) }}">
                                                                        {{ $child->childcategory_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item nav-link nav_item"
                                                                    href="{{ route('slug.handler', $sub->subcategory_slug) }}">
                                                                    View All {{ $sub->subcategory_name }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">More</a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('about') }}">About Us</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('contact') }}">Contact Us</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('faq') }}">Faq</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('404') }}">404 Error Page</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('login') }}">Login</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('register') }}">Register</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{ url('terms') }}">Terms and Conditions</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav attr-nav align-items-center">
                        <li>
                            <a href="javascript:;" class="nav-link search_trigger">
                                <i class="linearicons-magnifier"></i>
                            </a>

                            <div class="search_wrap">
                                <span class="close-search"><i class="ion-ios-close-empty"></i></span>

                                <form onsubmit="return redirectSearchURL(event)" autocomplete="off" style="position: relative;">
                                    <input type="text" placeholder="Search" class="form-control" id="search_input">
                                    <button type="submit" class="search_icon">
                                        <i class="ion-ios-search-strong"></i>
                                    </button>

                                    <div id="search_result" class="list-group" style="position:absolute; top:100%; width:100%; z-index:999; display:none;"></div>
                                </form>
                            </div>

                            <div class="search_overlay"></div>
                        </li>
                        @php
                            $wishlist= \App\Models\Wishlist::where('user_id', Auth::id())->count();
                        @endphp
                        <li><a href="{{ route('compare.page') }}"><i class="ti-control-shuffle"></i></a></li>
                        <li><a href="{{ route('wishlist') }}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">{{ $wishlist }}</span></a></li>
                        <li class="dropdown cart_dropdown">
                            <a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown">
                                <i class="linearicons-bag2"></i>
                                <span class="cart_count" id="cart-count">{{ Cart::count() }}</span>
                                <span class="amount" id="cart-total">
                                    <span class="currency_symbol">{{ $setting->currency }}</span>{{ Cart::subtotal() }}
                                </span>
                            </a>

                            <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                                <ul id="cart-list" class="cart_list">
                                    @forelse(Cart::content() as $item)
                                        <li>
                                            {{-- <a href="{{ route('cart.remove', $item->rowId) }}" class="item_remove remove-cart-item" data-id="{{ $item->rowId }}"><i class="ion-close"></i></a> --}}
                                            <a href="javascript:void(0);" class="item_remove remove-cart-item" data-id="{{ $item->rowId }}"><i class="ion-close"></i></a>
                                            <a href="#">
                                                <img src="{{ asset($item->options->thumbnail) }}" alt="cart_thumb">
                                                {{ Str::limit($item->name, 20) }}
                                            </a>
                                            <span class="cart_quantity">{{ $item->qty }} x <span class="cart_amount"><span class="price_symbole">{{ $setting->currency }}</span>{{ $item->price }}</span></span>
                                        </li>
                                    @empty
                                        <li>No items in cart.</li>
                                    @endforelse
                                </ul>

                                <div class="cart_footer">
                                    <p id="cart-total" style="text-align: center;"><strong >Subtotal:</strong> <span class="cart_price"><span class="price_symbole">{{ $setting->currency }}</span>{{ Cart::subtotal() }}</span></p>
                                    <p class="cart_buttons">
                                        <a href="{{ route('cart.view') }}" class="btn btn-fill-line view-cart">View Cart</a>
                                        <a href="{{ route('checkout') }}" class="btn btn-fill-out checkout">Checkout</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        @if(Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset(Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}"
                                            style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                                    @else
                                        <i class="linearicons-user" style="font-size: 20px; margin-right: 6px;"></i>
                                    @endif
                                    <span style="font-size: 14px;">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        {{-- <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a></li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="nav-link">
                                    <i class="linearicons-user"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
