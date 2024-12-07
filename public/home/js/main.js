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
            document.getElementById("navbar2").style.top = "-100px";
        }
    };

    
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
})(jQuery);
