<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Dec 2024 10:04:50 GMT -->
<head>
    @include('user.layouts.meta')
    <!-- [style] -->
    <title>Jomijoma Limited | @yield('title') </title>
    @include('user.layouts.style')
    <!-- FAVICON -->


</head>

<body class="maxw1600 m0a dashboard-bd">
    <!-- Wrapper -->
    <div id="wrapper" class="int_main_wraapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        @include('user.layouts.navbar')
        <!-- Header Container / End -->

        <!-- START SECTION DASHBOARD -->

        <section class="user-page section-padding">
            <div class="container-fluid">
                <div class="row">

                    @include('user.layouts.sidebar')
                        @yield('user_content')
                    <!-- START FOOTER -->
                     @include('user.layouts.footer')
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION DASHBOARD -->

        <!-- END SECTION DASHBOARD -->
         <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->



        <!-- ARCHIVES JS -->
        <script src="users/assets/js/jquery-3.5.1.min.js"></script>
        <script src="users/assets/js/jquery-ui.js"></script>
        <script src="users/assets/js/tether.min.js"></script>
        <script src="users/assets/js/moment.js"></script>
        <script src="users/assets/js/bootstrap.min.js"></script>
        <script src="users/assets/js/mmenu.min.js"></script>
        <script src="users/assets/js/mmenu.js"></script>
        <script src="users/assets/js/swiper.min.js"></script>
        <script src="users/assets/js/swiper.js"></script>
        <script src="users/assets/js/slick.min.js"></script>
        <script src="users/assets/js/slick2.js"></script>
        <script src="users/assets/js/fitvids.js"></script>
        <script src="users/assets/js/jquery.waypoints.min.js"></script>
        <script src="users/assets/js/jquery.counterup.min.js"></script>
        <script src="users/assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="users/assets/js/isotope.pkgd.min.js"></script>
        <script src="users/assets/js/smooth-scroll.min.js"></script>
        <script src="users/assets/js/lightcase.js"></script>
        <script src="users/assets/js/search.js"></script>
        <script src="users/assets/js/owl.carousel.js"></script>
        <script src="users/assets/js/jquery.magnific-popup.min.js"></script>
        <script src="users/assets/js/ajaxchimp.min.js"></script>
        <script src="users/assets/js/newsletter.js"></script>
        <script src="users/assets/js/jquery.form.js"></script>
        <script src="users/assets/js/jquery.validate.min.js"></script>
        <script src="users/assets/js/searched.js"></script>
        <script src="users/assets/js/dashbord-mobile-menu.js"></script>
        <script src="users/assets/js/forms-2.js"></script>
        <script src="users/assets/js/color-switcher.js"></script>

        <script>
            $(".header-user-name").on("click", function() {
                $(".header-user-menu ul").toggleClass("hu-menu-vis");
                $(this).toggleClass("hu-menu-visdec");
            });

        </script>

        <!-- MAIN JS -->
        <script src="users/assets/js/script.js"></script>

    </div>
    <!-- Wrapper / End -->
</body>


</html>
