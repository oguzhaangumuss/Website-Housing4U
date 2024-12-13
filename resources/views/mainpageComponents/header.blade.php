
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
            <img src="home/img/favicon.png" alt="Logo" style="width: 7rem; height: 4rem;">
        </a>

   <!-- Navbar toggler (mobile-friendly menu button) -->
   @if (Route::has('login'))
   @auth
   <button class="buton-mobile image-button" id="navbarToggler1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <img id="butonMobile" class="w-10 image-profile h-10 rounded-full cursor-pointer" src="{{Auth::user()->profile_photo_url}}" style="height:4rem;width:4rem;border-radius:50%;" alt="User dropdown">
</button>


        <!-- Navbar içeriği -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center ms-auto">  <!-- 'ms-auto' sağa yaslamak için -->
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('contact') }}">Contact</a>
                </li><li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('contact') }}">Rooms</a>
                </li>
<!-- Dropdown menu -->

      <li class="nav-item">
        <a href="#" class="nav-link headitems text-white">Dashboard</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link headitems text-white">Settings</a>
      </li>
<li class="nav-item">
  <a class="nav-link headitems text-white" href="{{ route('logout') }}" 
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  
  <!-- Logout form with POST method -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</li>
 
    </ul></div>


                                @else
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

                      
                                <ul class="navbar-nav align-items-center ms-auto">  
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('contact') }}">Contact</a>
                </li><li class="nav-item">
                    <a class="nav-link headitems text-white" href="{{ url('contact') }}">Rooms</a>
                </li>
                                <li class="nav-item">
        <a href="{{  route('login') }}" class="nav-link headitems text-white">Log in</a>
      </li> 
                                @if (Route::has('register'))
                                <li class="nav-item">
        <a href="{{  route('register') }}" class="nav-link headitems text-white">Register</a>
      </li> 
      </ul></div>

                                @endif
                                @endauth
                            @endif
            
    </nav>
                    <div class=" navbar-collapse justify-content-between " id="">
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
                        @if (Route::has('login'))
                                @auth
                                <a href="{{ url('/dashboard') }}" class=" items-nonees image-button rounded-full">    <img   id="butonMobile" class="w-10 h-10 rounded-full cursor-pointer" src="home/img/favicon.png" style="height:4rem;width:4rem;border-radius:50%;" alt="User dropdown">
                                </a>
                       
                           
                                @else
                                <div class="d-flex items-blur ">
                                <ul class="navbar-nav mx-auto d-nonemobile">
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