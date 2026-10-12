<!-- START HEADER -->

<!-- END HEADER -->
<header class="header_wrap">

    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">

                {{-- LOGO --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo_light"
                         src="{{ url($setting->logo) }}"
                         alt="{{ config('app.name') }}">

                    <img class="logo_dark"
                         src="{{ url($setting->logo) }}"
                         alt="{{ config('app.name') }}">
                </a>


                {{-- SEARCH --}}
                <div class="product_search_form radius_input search_form_btn">
                    <form onsubmit="return redirectSearchURL(event)">

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <div class="custom_select">

                                    <select class="first_null not_chosen"
                                            id="search_category"
                                            name="category">

                                        <option value="">
                                            All Category
                                        </option>

                                        @foreach($categories as $category)

                                            <option value="{{ route('slug.handler', $category->category_slug) }}">

                                                {{ $category->category_name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            <input class="form-control"
                                id="search_input"
                                name="search"
                                placeholder="Search Product..."
                                required
                                type="text">


                            <button type="submit"
                                    class="search_btn3">

                                Search

                            </button>

                        </div>


                        {{-- SEARCH RESULT --}}
                        <div id="search_result"
                            class="position-absolute bg-white w-100"
                            style="z-index:9999;">

                        </div>

                    </form>
                </div>
                <script>
                    function redirectSearchURL(event)
                    {
                        event.preventDefault();

                        let search = document.getElementById('search_input').value.trim();

                        let category = document.getElementById('search_category').value;


                        if (search === '') {

                            return false;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CATEGORY SELECTED
                        |--------------------------------------------------------------------------
                        */

                        if (category !== '') {

                            window.location.href =
                                category + '?search=' + encodeURIComponent(search);

                            return false;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | ALL CATEGORY
                        |--------------------------------------------------------------------------
                        */

                        window.location.href =
                            "{{ url('/search') }}?search=" + encodeURIComponent(search);


                        return false;
                    }
                </script>


                {{-- RIGHT ICONS --}}
                <ul class="navbar-nav attr-nav align-items-center">
                    {{-- USER --}}
                    <li>
                        @if(Auth::check())
                            <a href="{{ route('dashboard') }}"
                               class="nav-link">
                                @if(Auth::user()->image)

                                    <img src="{{ asset(Auth::user()->image) }}"
                                         alt="{{ Auth::user()->name }}"
                                         style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                                @else
                                    <i class="linearicons-user"></i>
                                @endif
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="nav-link">
                                <i class="linearicons-user"></i>
                            </a>
                        @endif
                    </li>
                    {{-- WISHLIST --}}
                        @php
                            $wishlist= \App\Models\Wishlist::where('user_id', Auth::id())->count();
                        @endphp
                    <li><a href="{{ route('compare.page') }}"><i class="ti-control-shuffle"></i></a></li>
                    <li><a href="{{ route('wishlist') }}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">{{ $wishlist }}</span></a></li>
                    {{-- CART --}}
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
                                    <p id="cart-total" style="text-align: center;"><strong>Subtotal:</strong> <span class="cart_price"><span class="price_symbole">{{ $setting->currency }}</span>{{ Cart::subtotal() }}</span></p>
                                    <p class="cart_buttons">
                                        <a href="{{ route('cart.view') }}" class="btn btn-fill-line view-cart">View Cart</a>
                                        <a href="{{ route('checkout') }}" class="btn btn-fill-out checkout">Checkout</a>
                                    </p>
                                </div>
                            </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>


    <div class="bottom_header dark_skin main_menu_uppercase border-top">

        <div class="container">

            <div class="row align-items-center">


                {{-- ========================= --}}
                {{-- ALL CATEGORIES --}}
                {{-- ========================= --}}

                <div class="col-lg-3 col-md-4 col-sm-6 col-3">

                    <div class="categories_wrap">

                        <button type="button"
                                class="categories_btn categories_menu"
                                data-toggle="collapse"
                                data-target="#navCatContent"
                                aria-expanded="false"
                                aria-controls="navCatContent">

                            <span>All Categories</span>
                            <i class="linearicons-menu"></i>

                        </button>
                        <div id="navCatContent" class="navbar nav collapse">

                            <ul>

                            @foreach($categories->take(6) as $category)
                                <li class="dropdown dropdown-mega-menu">

                                    {{-- CATEGORY HEADER --}}
                                    <a class="nav-link" href="{{ route('slug.handler', $category->category_slug ?? $category->slug) }}">
                                        <i class="{{ $category->icon }}"></i>
                                        <span>{{ $category->category_name ?? $category->name }}</span>
                                    </a>

                                    {{-- SUBCATEGORY + CHILD CATEGORY --}}
                                    @if($category->subcategories->isNotEmpty())
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">

                                                {{-- SUBCATEGORY LIST --}}
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        @foreach($category->subcategories as $subcategory)
                                                            <li class="mega-menu-col col-lg-6">
                                                                <ul>
                                                                    {{-- SUBCATEGORY --}}
                                                                    <li class="dropdown-header">
                                                                        <a href="{{ route('slug.handler', $subcategory->subcategory_slug ?? $subcategory->slug) }}"
                                                                        class="text-decoration-none"
                                                                        style="color: black;"
                                                                        onmouseover="this.style.color='red';"
                                                                        onmouseout="this.style.color='black';">
                                                                            {{ $subcategory->subcategory_name ?? $subcategory->name }}
                                                                        </a>
                                                                    </li>

                                                                    {{-- CHILD CATEGORY --}}
                                                                    @if($subcategory->childCategories->isNotEmpty())
                                                                        @foreach($subcategory->childCategories as $childcategory)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item"
                                                                                href="{{ route('slug.handler', $childcategory->childcategory_slug ?? $childcategory->slug) }}">
                                                                                    {{ $childcategory->childcategory_name ?? $childcategory->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    @else
                                                                        <li>
                                                                            <a class="dropdown-item nav-link nav_item"
                                                                            href="{{ route('slug.handler', $subcategory->subcategory_slug ?? $subcategory->slug) }}">
                                                                                View All {{ $subcategory->subcategory_name ?? $subcategory->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                {{-- ========================= --}}
                                                {{-- DYNAMIC CATEGORY BANNERS  --}}
                                                {{-- ========================= --}}
                                                <li class="mega-menu-col col-lg-5">

                                                    @php
                                                        $banner1 = $category->ads->firstWhere('banner_position', '1');
                                                        $banner2 = $category->ads->firstWhere('banner_position', '2');
                                                        $categoryRoute = route('slug.handler', $category->category_slug ?? $category->slug);
                                                    @endphp

                                                    {{-- BANNER 1 --}}
                                                    @if($banner1)
                                                        <div class="header-banner2 mb-3">
                                                            <a href="{{ $categoryRoute }}">
                                                                <img src="{{ asset($banner1->image) }}" alt="{{ $banner1->title }}">
                                                            </a>

                                                            <div class="banne_info" style="max-width: 50%; width: 100%; display: flex; flex-direction: column; justify-content: center;">
                                                                @if($banner1->discount_text)
                                                                    <h6 style="font-size: 13px; margin-bottom: 4px; display: block; word-wrap: break-word;">{{ $banner1->discount_text }}</h6>
                                                                @endif
                                                                
                                                                <h4 style="font-size: 16px; font-weight: 600; line-height: 1.3; margin-bottom: 6px; display: block; word-wrap: break-word; white-space: normal;">
                                                                    {{ $banner1->title ?? ($category->category_name ?? $category->name) }}
                                                                </h4>
                                                                
                                                                <a href="{{ $categoryRoute }}" style="font-size: 12px; font-weight: bold; text-decoration: underline; display: inline-block;">
                                                                    Shop Now
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- DEFAULT BANNER 1 --}}
                                                        <div class="header-banner2 mb-3">
                                                            <a href="{{ $categoryRoute }}">
                                                                <img src="{{ asset('/') }}frontend/assets/images/menu_banner7.jpg" alt="menu_banner">
                                                            </a>
                                                            <div class="banne_info" style="max-width: 50%; width: 100%; display: flex; flex-direction: column; justify-content: center;">
                                                                <h6 style="font-size: 13px; margin-bottom: 4px; display: block;">20% Off</h6>
                                                                <h4 style="font-size: 16px; font-weight: 600; line-height: 1.3; margin-bottom: 6px; display: block; white-space: normal;">
                                                                    {{ $category->category_name ?? $category->name }}
                                                                </h4>
                                                                <a href="{{ $categoryRoute }}" style="font-size: 12px; font-weight: bold; text-decoration: underline; display: inline-block;">
                                                                    Shop Now
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- BANNER 2 --}}
                                                    @if($banner2)
                                                        <div class="header-banner2">
                                                            <a href="{{ $categoryRoute }}">
                                                                <img src="{{ asset($banner2->image) }}" alt="{{ $banner2->title }}">
                                                            </a>

                                                            <div class="banne_info" style="max-width: 50%; width: 100%; display: flex; flex-direction: column; justify-content: center;">
                                                                @if($banner2->discount_text)
                                                                    <h6 style="font-size: 13px; margin-bottom: 4px; display: block; word-wrap: break-word;">{{ $banner2->discount_text }}</h6>
                                                                @endif

                                                                <h4 style="font-size: 16px; font-weight: 600; line-height: 1.3; margin-bottom: 6px; display: block; word-wrap: break-word; white-space: normal;">
                                                                    {{ $banner2->title ?? ($category->category_name ?? $category->name) }}
                                                                </h4>

                                                                <a href="{{ $categoryRoute }}" style="font-size: 12px; font-weight: bold; text-decoration: underline; display: inline-block;">
                                                                    Shop Now
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- DEFAULT BANNER 2 --}}
                                                        <div class="header-banner2">
                                                            <a href="{{ $categoryRoute }}">
                                                                <img src="{{ asset('/') }}frontend/assets/images/menu_banner8.jpg" alt="menu_banner">
                                                            </a>
                                                            <div class="banne_info" style="max-width: 50%; width: 100%; display: flex; flex-direction: column; justify-content: center;">
                                                                <h6 style="font-size: 13px; margin-bottom: 4px; display: block;">15% Off</h6>
                                                                <h4 style="font-size: 16px; font-weight: 600; line-height: 1.3; margin-bottom: 6px; display: block; white-space: normal;">
                                                                    {{ $category->category_name ?? $category->name }}
                                                                </h4>
                                                                <a href="{{ $categoryRoute }}" style="font-size: 12px; font-weight: bold; text-decoration: underline; display: inline-block;">
                                                                    Shop Now
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                </li>
                            @endforeach
                                {{-- ================================================= --}}
                                {{-- MORE CATEGORIES --}}
                                {{-- 7TH CATEGORY ONWARDS --}}
                                {{-- ================================================= --}}

                                @if($categories->count() > 6)

                                    <li>

                                        <ul class="more_slide_open">

                                            @foreach($categories->slice(6) as $category)

                                                <li class="dropdown dropdown-mega-menu">

                                                    {{-- CATEGORY --}}
                                                    <a class="nav-link"
                                                    href="{{ route('slug.handler', $category->category_slug) }}">

                                                        <i class="{{ $category->icon }}"></i>

                                                        <span>{{ $category->category_name }}</span>

                                                    </a>


                                                    {{-- SUBCATEGORY + CHILD CATEGORY --}}
                                                    @if($category->subcategories->isNotEmpty())

                                                        <div class="dropdown-menu">

                                                            <ul class="mega-menu d-lg-flex">

                                                                {{-- ========================= --}}
                                                                {{-- SUBCATEGORY + CHILD CATEGORY --}}
                                                                {{-- ========================= --}}

                                                                <li class="mega-menu-col col-lg-7">

                                                                    <ul class="d-lg-flex">

                                                                        @foreach($category->subcategories as $subcategory)

                                                                            <li class="mega-menu-col col-lg-6">

                                                                                <ul>

                                                                                    {{-- SUBCATEGORY --}}
                                                                                    <li class="dropdown-header">

                                                                                        <a href="{{ route('slug.handler', $subcategory->subcategory_slug) }}"
                                                                                        class="text-decoration-none"
                                                                                        style="color: black;"
                                                                                        onmouseover="this.style.color='red';"
                                                                                        onmouseout="this.style.color='black';">

                                                                                            {{ $subcategory->subcategory_name }}

                                                                                        </a>

                                                                                    </li>


                                                                                    {{-- CHILD CATEGORY --}}
                                                                                    @if($subcategory->childCategories->isNotEmpty())

                                                                                        @foreach($subcategory->childCategories as $childcategory)

                                                                                            <li>

                                                                                                <a class="dropdown-item nav-link nav_item"
                                                                                                href="{{ route('slug.handler', $childcategory->childcategory_slug) }}">

                                                                                                    {{ $childcategory->childcategory_name }}

                                                                                                </a>

                                                                                            </li>

                                                                                        @endforeach

                                                                                    @else

                                                                                        {{-- NO CHILD CATEGORY --}}
                                                                                        <li>

                                                                                            <a class="dropdown-item nav-link nav_item"
                                                                                            href="{{ route('slug.handler', $subcategory->subcategory_slug) }}">

                                                                                                View All {{ $subcategory->subcategory_name }}

                                                                                            </a>

                                                                                        </li>

                                                                                    @endif

                                                                                </ul>

                                                                            </li>

                                                                        @endforeach

                                                                    </ul>

                                                                </li>


                                                                {{-- ========================= --}}
                                                                {{-- CATEGORY BANNERS --}}
                                                                {{-- ========================= --}}

                                                                <li class="mega-menu-col col-lg-5">

                                                                    {{-- BANNER 1 --}}
                                                                    <div class="header-banner2">

                                                                        <img src="{{ asset('/') }}frontend/assets/images/menu_banner7.jpg"
                                                                            alt="menu_banner">

                                                                        <div class="banne_info">

                                                                            <h6>20% Off</h6>

                                                                            <h4>{{ $category->category_name }}</h4>

                                                                            <a href="{{ route('slug.handler', $category->category_slug) }}">
                                                                                Shop now
                                                                            </a>

                                                                        </div>

                                                                    </div>


                                                                    {{-- BANNER 2 --}}
                                                                    <div class="header-banner2">

                                                                        <img src="{{ asset('/') }}frontend/assets/images/menu_banner8.jpg"
                                                                            alt="menu_banner">

                                                                        <div class="banne_info">

                                                                            <h6>15% Off</h6>

                                                                            <h4>{{ $category->category_name }}</h4>

                                                                            <a href="{{ route('slug.handler', $category->category_slug) }}">
                                                                                Shop now
                                                                            </a>

                                                                        </div>

                                                                    </div>

                                                                </li>

                                                            </ul>

                                                        </div>

                                                    @endif

                                                </li>

                                            @endforeach

                                        </ul>

                                    </li>

                                @endif

                            </ul>

                            @if($categories->count() > 6)

                                <div class="more_categories">
                                    More Categories
                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- ========================= --}}
                {{-- MAIN NAVIGATION --}}
                {{-- ========================= --}}

                <div class="col-lg-9 col-md-8 col-sm-6 col-9">

                    <nav class="navbar navbar-expand-lg">

                        <button class="navbar-toggler side_navbar_toggler"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarSidetoggle"
                                aria-expanded="false">

                            <span class="ion-android-menu"></span>

                        </button>


                        {{-- MOBILE SEARCH --}}
                        <div class="pr_search_icon">

                            <a href="javascript:;"
                               class="nav-link pr_search_trigger">

                                <i class="linearicons-magnifier"></i>

                            </a>

                        </div>

                        <div class="collapse navbar-collapse mobile_side_menu"
                            id="navbarSidetoggle">

                            <ul class="navbar-nav">

                                {{-- ========================= --}}
                                {{-- HOME --}}
                                {{-- ========================= --}}
                                <li>
                                    <a class="nav-link nav_item active"
                                    href="{{ url('/') }}">
                                        Home
                                    </a>
                                </li>


                                {{-- ========================= --}}
                                {{-- ABOUT US --}}
                                {{-- ========================= --}}
                                <li>
                                    <a class="nav-link nav_item"
                                    href="{{ url('about') }}">
                                        About Us
                                    </a>
                                </li>


                                {{-- ========================= --}}
                                {{-- CONTACT US --}}
                                {{-- ========================= --}}
                                <li>
                                    <a class="nav-link nav_item"
                                    href="{{ url('contact') }}">
                                        Contact Us
                                    </a>
                                </li>

                            </ul>

                        </div>
                        {{-- PHONE --}}
                        <div class="contact_phone contact_support">

                            <i class="linearicons-phone-wave"></i>

                            <span>
                                {{ $setting->phone ?? '123-456-7689' }}
                            </span>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</header>
