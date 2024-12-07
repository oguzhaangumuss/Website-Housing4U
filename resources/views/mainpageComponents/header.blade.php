
<div class=" bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
         
    <!-- Arka Plan Görüntüsü -->
    <div class="background-container">
        <img class="background-image" src="home/img/carousel-1.jpg" alt="Image">
    </div>

    <!-- Arka Plan ve İçerik -->
    <div class="image-container position-relative">
        <!-- Arka Plan Görüntüsü -->
        <!-- İçerik Katmanı -->
        <div class="content-layer position-relative" style="z-index:1;">
            <div class="container-fluid px-0">
                <!-- Üst Bilgi -->
                <div class="row gx-0 bg-white d-none d-lg-flex align-items-center">
                    <div class="col-lg-7 px-5 text-start">
                        <div class="d-inline-flex align-items-center py-2 me-4">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            <a href="mailto:info@housing4u.ca">info@housing4u.ca</a>
                        </div>
                        <div class="d-inline-flex align-items-center py-2">
                            <i class="fa fa-phone-alt text-primary me-2"></i>
                            <a href="tel:+1(647)493-7470">+1 (647) 493-7470</a>
                        </div>
                    </div>
                    <div class="col-lg-5 px-5 text-end">
                        <div class="d-inline-flex align-items-center py-2">
                            <a class="me-3" href="https://www.facebook.com/share/g/12AR96WUsCi/"><i class="fab fa-facebook-f"></i></a>
                            <a class="me-3" href="https://www.linkedin.com/company/housiing-4-you/?viewAsMember=true"><i class="fab fa-linkedin-in"></i></a>
                            <a class="me-3" href="https://www.instagram.com/h4u.community?igsh=N3k1eHhnMmdrNGFt"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark p-3 mgr" >
                    <a href="{{ url('welcome') }}" class="navbar-brand d-block d-lg-none ">
                        <div class="col-lg-2  d-none d-lg-block additional-content">
                    <a href="{{ url('welcome') }}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <img class="m-0"style="width: 8rem; height: 5rem;" src="home/img/favicon.png" alt="Housing4u Logo">
                    </a>
                </div>
                    </a>   
                    
                    <nav class="navbar navbar-expand-lg navbar-light fixed-top w-100 bg-dark" id="navbar2">
    <div class="container">
        <!-- Navbar başlığı -->
        <a class="navbar-brand" href="{{ url('welcome') }}">
            <img src="home/img/favicon.png" alt="Logo" style="width: 8rem; height: 5rem;">
        </a>

        <!-- Navbar toggler (mobil uyumlu menü butonu) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar içeriği -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">  <!-- 'ms-auto' sağa yaslamak için -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('contact') }}">Contact</a>
                </li><li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('contact') }}">Rooms</a>
                </li>@if (Route::has('login'))
                                @auth
                                <a href="{{ url('/dashboard') }}" class="nav-item btn btn-primary me-2">Dashboard</a>
                                @else
                                <li class="nav-item"><a href="{{  route('login') }}" class="nav-link">Log In</a></li>
                                @if (Route::has('register'))
                                <li class="nav-item"><a href="{{  route('register') }}" class="nav-link">Register</a></li>

                                @endif
                                @endauth
                            @endif
            </ul>
        </div>
    </div>
</nav>

    <!-- Right Sidebar Toggle Menu -->
    <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header ">
            <h5 id="offcanvasRightLabel">Menu</h5>
            <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a href="#" class="btn btn-light w-100 mb-3">Home</a></li>
                <li><a href="#" class="btn btn-light w-100 mb-3">About</a></li>
                <li><a href="#" class="btn btn-light w-100 mb-3">Services</a></li>
                <li><a href="#" class="btn btn-light w-100 mb-3">Contact</a></li>
            </ul>
        </div>
    </div>

                    <div class="collapse navbar-collapse justify-content-between " id="navbarCollapse">
                        <ul class="navbar-nav mx-auto items-blur ">
                            <li class="nav-item"><a href="{{ url('welcome') }}" class="nav-link active">Home</a></li>
                            <li class="nav-item"><a href="{{ url('about') }}" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="{{ url('services') }}" class="nav-link">Services</a></li>
                            <li class="nav-item"><a href="{{ url('rooms') }}" class="nav-link">Rooms</a></li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="booking.html" class="dropdown-item">Booking</a></li>
                                    <li><a href="team.html" class="dropdown-item">Our Team</a></li>
                                    <li><a href="testimonial.html" class="dropdown-item">Testimonial</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
                        </ul>

                        <!-- Login/Register Buttons -->
                        <div class="d-flex items-blur ">
                             <ul class="navbar-nav mx-auto">
                            @if (Route::has('login'))
                                @auth
                                <a href="{{ url('/dashboard') }}" class="nav-item btn btn-primary me-2">Dashboard</a>
                                @else
                                <li class="nav-item"><a href="{{  route('login') }}" class="nav-link">Log In</a></li>
                                @if (Route::has('register'))
                                <li class="nav-item"><a href="{{  route('register') }}" class="nav-link">Register</a></li>

                                @endif
                                @endauth
                            @endif</ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div> 