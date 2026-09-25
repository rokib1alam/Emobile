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
                        $wishlist = Auth::check()
                            ? \App\Models\Wishlist::where('user_id', Auth::id())->count()
                            : 0;
                    @endphp

                    <li>
                        <a href="{{ route('wishlist') }}"
                           class="nav-link">

                            <i class="linearicons-heart"></i>

                            <span class="wishlist_count">
                                {{ $wishlist }}
                            </span>

                        </a>
                    </li>


                    {{-- CART --}}
                    <li class="dropdown cart_dropdown">

                        <a class="nav-link cart_trigger"
                           href="{{ route('cart.view') }}"
                           data-bs-toggle="dropdown">

                            <i class="linearicons-bag2"></i>

                            <span class="cart_count">
                                {{ Cart::count() }}
                            </span>

                            <span class="amount">
                                <span class="currency_symbol">
                                    {{ $setting->currency }}
                                </span>
                                {{ Cart::subtotal() }}
                            </span>

                        </a>


                        {{-- CART DROPDOWN --}}
                        <div class="cart_box cart_right dropdown-menu dropdown-menu-right">

                            <ul class="cart_list">

                                @forelse(Cart::content() as $item)

                                    <li>

                                        {{-- REMOVE --}}
                                        <a href="{{ route('cart.remove', $item->rowId) }}"
                                           class="item_remove remove-cart-item"
                                           data-id="{{ $item->rowId }}">

                                            <i class="ion-close"></i>

                                        </a>


                                        {{-- PRODUCT --}}
                                        <a href="#">

                                            <img src="{{ asset($item->options->thumbnail) }}"
                                                 alt="{{ $item->name }}">

                                            {{ $item->name }}

                                        </a>


                                        {{-- QUANTITY + PRICE --}}
                                        <span class="cart_quantity">

                                            {{ $item->qty }} x

                                            <span class="cart_amount">

                                                <span class="price_symbole">
                                                    {{ $setting->currency }}
                                                </span>

                                            </span>

                                            {{ $item->price }}

                                        </span>

                                    </li>

                                @empty

                                    <li class="text-center py-3">
                                        Your cart is empty.
                                    </li>

                                @endforelse

                            </ul>


                            {{-- CART FOOTER --}}
                            @if(Cart::count() > 0)

                                <div class="cart_footer">

                                    <p class="cart_total">

                                        <strong>
                                            Subtotal:
                                        </strong>

                                        <span class="cart_price">

                                            <span class="price_symbole">
                                                {{ $setting->currency }}
                                            </span>

                                            {{ Cart::subtotal() }}

                                        </span>

                                    </p>


                                    <p class="cart_buttons">

                                        <a href="{{ route('cart.view') }}"
                                           class="btn btn-fill-line view-cart">
                                            View Cart
                                        </a>

                                        <a href="{{ route('checkout') }}"
                                           class="btn btn-fill-out checkout">
                                            Checkout
                                        </a>

                                    </p>

                                </div>

                            @endif

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
                                data-bs-toggle="collapse"
                                data-bs-target="#navCatContent"
                                aria-expanded="false"
                                class="categories_btn categories_menu">

                            <span>All Categories </span>
                            <i class="linearicons-menu"></i>

                        </button>
                        <div id="navCatContent" class="navbar nav collapse">

                            <ul>

                                @foreach($categories->take(6) as $category)

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