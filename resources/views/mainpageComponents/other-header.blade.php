
<div class=" bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
         

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
                <nav class="navbar navbar-expand-lg navbar-dark p-3" >
                    <nav class="navbar navbar-expand-lg navbar-light fixed-top w-100 bg-dark" id="navbar2">
    <div class="container">
        <!-- Navbar başlığı -->
        <a class="navbar-brand" href="{{ url('welcome') }}">
            <img src="home/img/favicon.png" alt="Logo" style="width: 7rem; height: 4rem;">
        </a>

   <!-- Navbar toggler (mobile-friendly menu button) -->
   @if (Route::has('login'))
   @auth
<button class="buton-mobile image-button" id="navbarToggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <img   id="butonMobile" class="w-10 h-10  cursor-pointer" src="home/img/favicon.png" style="height:4rem;width:4rem;border-radius:50%;" alt="User dropdown">
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
 
    </ul>
    

                                @else
                                <div class="collapse navbar-collapse" id="navbarNav">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
      </ul>
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
                </nav>
            </div>
       
    </div>
</div> 