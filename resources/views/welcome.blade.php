<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Housing4U</title>
        <base href="/public">
 <!-- Favicon -->
 <link rel="manifest" href="/manifest.json">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="home/lib/animate/animate.min.css" rel="stylesheet">
<link href="home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="home/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="home/css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="home/css/style.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
<!-- Header Start -->
@include('mainpageComponents.header')
<!-- Header End -->

<!-- Booking Start -->
@include('mainpageComponents.bookingsect')
<!-- Booking End -->

<!-- About Start -->
@include('mainpageComponents.aboutsect')
<!-- About End -->

<!-- Room Start -->
@include('mainpageComponents.roomsect')
<!-- Room End -->

<!-- Video Start -->
@include('mainpageComponents.videosect')
<!-- Video Start -->

<!-- Service Start -->
@include('mainpageComponents.servicesect')
<!-- Service End -->

<!-- Testimonial Start -->
@include('mainpageComponents.testimonialsect')
<!-- Testimonial End -->

<!-- Newsletter Start -->
@include('mainpageComponents.newslettersect')
<!-- Newsletter Start -->
        
<!-- Footer Start -->
@include('mainpageComponents.footer')
<!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="home/lib/wow/wow.min.js"></script>
    <script src="home/lib/easing/easing.min.js"></script>
    <script src="home/lib/waypoints/waypoints.min.js"></script>
    <script src="home/lib/counterup/counterup.min.js"></script>
    <script src="home/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="home/lib/tempusdominus/js/moment.min.js"></script>
    <script src="home/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="home/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="home/js/main.js"></script>
    </body>
</html>
