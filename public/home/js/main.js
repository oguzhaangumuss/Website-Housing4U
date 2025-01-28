(function ($) {
    "use strict";

    // Spinner removal function
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    // Initialize WOW.js for animations
    new WOW().init();
    


        
    // Back to top button functionality
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });

    // Modal Video functionality
    $(document).ready(function () {
        let $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });

        $('#videoModal').on('shown.bs.modal', function () {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        });

        $('#videoModal').on('hide.bs.modal', function () {
            $("#video").attr('src', $videoSrc);
        });
    });

    // Highlight current navbar link based on current URL
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const currentUrl = window.location.href;
    
        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });


    window.onscroll = function() {
        // Scroll miktarını kontrol et
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            // Kaydırma 100px'yi geçtiğinde navbar'ı göster
            document.getElementById("navbar2").style.top = "0";
        } else {
            // Kaydırma 100px'nin altına indiğinde navbar'ı gizle
            document.getElementById("navbar2").style.top = "-300px";
        }
    };
    // profile carousel

// Get the elements
document.addEventListener('DOMContentLoaded', function() {
    // Get the elements
    const avatarButton = document.getElementById("avatarButton");
    const userDropdown = document.getElementById("userDropdown");
    const butonMobile = document.getElementById("butonMobile");

    if (avatarButton && userDropdown && butonMobile) {
        // Show/hide the dropdown menu when the avatar image is clicked
        avatarButton.addEventListener("click", function(event) {
            // Prevent the click event from propagating to the document click listener
            event.stopPropagation();

            // Toggle visibility of the dropdown
            if (userDropdown.style.display === "block") {
                userDropdown.style.display = "none";
            } else {
                userDropdown.style.display = "block";
            }
            if (butonMobile.style.display === "block") {
                butonMobile.style.display = "none";
            } else {
                butonMobile.style.display = "block";
            }
        });
    } else {
        console.log("One or more elements were not found!");
    }
});

// Close dropdown if clicked outside the avatar or dropdown
window.addEventListener("click", function(event) {
    if (!avatarButton.contains(event.target) && !userDropdown.contains(event.target)) {
        userDropdown.style.display = "none";
    }
});


    
    // profile carousel





    const apiKey = 'YOUR_GOOGLE_API_KEY';  // Google API anahtarınızı buraya girin
    const placeId = 'YOUR_PLACE_ID';  // Google Places ID'nizi buraya girin
    
    fetch(`https://maps.googleapis.com/maps/api/place/details/json?placeid=${placeId}&key=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            const reviews = data.result.reviews; // Yorumları çekiyoruz
            displayReviews(reviews);  // Yorumları ekrana basıyoruz
        })
        .catch(error => console.error('Error fetching reviews:', error));
    
    function displayReviews(reviews) {
        const testimonialContainer = document.querySelector('.owl-carousel');
        reviews.forEach(review => {
            const testimonialItem = document.createElement('div');
            testimonialItem.classList.add('testimonial-item', 'position-relative', 'bg-white', 'rounded', 'overflow-hidden');
            testimonialItem.innerHTML = `
                <p>${review.text}</p>
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded" src="${review.profile_photo_url}" style="width: 45px; height: 45px;">
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1">${review.author_name}</h6>
                        <small>${review.rating} stars</small>
                    </div>
                </div>
                <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
            `;
            testimonialContainer.appendChild(testimonialItem);
        });
    }
    


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            }
        }
    });

    // Navbar scroll ve mobil menü yönetimi
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('mainNav');
        const navbarToggler = document.getElementById('navbarToggler');
        const navbarContent = document.getElementById('navbarContent');

        // Scroll event listener
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) { // 50px scroll sonrası
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobil menü toggle
        if (navbarToggler && navbarContent) {
            navbarToggler.addEventListener('click', function() {
                navbarContent.classList.toggle('show');
            });

            // Menü dışına tıklandığında menüyü kapat
            document.addEventListener('click', function(event) {
                const isClickInside = navbar.contains(event.target);
                
                if (!isClickInside && navbarContent.classList.contains('show')) {
                    navbarContent.classList.remove('show');
                }
            });
        }

        // Sayfa yüklendiğinde scroll pozisyonunu kontrol et
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        }
    });

    // Navbar linklerinin active state yönetimi
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Mobil görünümde menü öğelerine tıklandığında menüyü kapat
    const mobileMenuItems = document.querySelectorAll('.navbar-nav .nav-link');
    mobileMenuItems.forEach(item => {
        item.addEventListener('click', function() {
            const navbarContent = document.getElementById('navbarContent');
            if (navbarContent.classList.contains('show')) {
                navbarContent.classList.remove('show');
            }
        });
    });

    // Mobil menü toggle fonksiyonu
    document.addEventListener('DOMContentLoaded', function() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });

        // Sayfa scroll olduğunda menüyü kapat
        window.addEventListener('scroll', function() {
            if(navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    });

})(jQuery);
