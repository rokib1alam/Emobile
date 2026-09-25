<!-- Favicon Icon -->
<link href="img/favicon.ico" rel="icon">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/animate.css">
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/all.min.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/ionicons.min.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/themify-icons.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/linearicons.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/flaticon.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/simple-line-icons.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/magnific-popup.css">
<!-- jquery-ui CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/jquery-ui.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/slick.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/slick-theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Style CSS -->
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/style.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/style.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/custom.css">
<link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/responsive.css">

<style>
    .banner {
        background-color: #a5e1ff;
        color: white;
        text-align: center;
        padding: 50px 0;
        position: relative; /* Needed for absolute positioning of child elements */
        overflow: hidden;
        height: 400px; /* Ensures content doesn’t overflow */
    }
    .banner h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 2; /* Ensure text is in front of the image */
    }
    .banner .discount {
        background-color: black;
        color: white;
        display: inline-block;
        padding: 5px 10px;
        font-size: 1rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 2; /* Ensure discount badge is in front of the image */
    }
    .banner .product-image {
        position: absolute; /* Allows for positioning relative to the .banner */
        top: 50%; /* Centers the image vertically */
        left: 50%; /* Centers the image horizontally */
        transform: translate(-50%, -50%); /* Centers the image accurately */
        max-width: 100%; /* Ensures the image does not exceed the container's width */
        height: auto; /* Maintains aspect ratio */
        max-height: 900px; /* Increase this value to make the image taller */
        object-fit: cover; /* Ensures the image covers the area without distortion */
        z-index: 1; /* Ensure the image is behind text and buttons */
    }
    .banner .shop-now {
        display: inline-block;
        background-color: #007bff; /* Button color */
        color: white;
        font-weight: bold;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 25px; /* Adjust the radius as needed */
        font-size: 1.2rem;
        transition: background-color 0.3s;
        position: relative;
        z-index: 2; /* Ensure the button is in front of the image */
    }
    .banner .shop-now:hover {
        background-color: #0056b3; /* Darker shade for hover effect */
    }
    .banner .vertical-text {
        writing-mode: vertical-lr;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        font-size: 1.5rem;
        font-weight: bold;
        z-index: 2; /* Ensure the vertical text is in front of the image */
    }
</style>
