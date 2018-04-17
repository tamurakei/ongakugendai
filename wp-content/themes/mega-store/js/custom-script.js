jQuery(document).ready(function($) {
    jQuery('.nav li.dropdown').find('.mobile-eve').each(function() {
        jQuery(this).on('click', function(event) {
            event.preventDefault();
            if (jQuery(window).width() < 768) {
                var nav = $(this).parent().parent();
                if (nav.hasClass('open')) {
                    nav.removeClass('open');
                } else {
                    nav.addClass('open');
                }
            }
            return false;
        });
    });


    $(window).scroll(function() {
        if ($(window).width() > 768) {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass('sticky-head');
            } else {
                $('.site-header').removeClass('sticky-head');
            }
        } else {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass('sticky-head');
            } else {
                $('.site-header').removeClass('sticky-head');
            }
        }
    });

    $(document).on('click', '.product-categories .cat-parent', function(event) {
        event.preventDefault();
        if ($(this).hasClass('show-cat-child')) {
            $(this).removeClass('show-cat-child');
        } else {
            $(this).addClass('show-cat-child');
        }
    });

    window.home_carousel = $('.home-carousel').owlCarousel({
        nav: true,
        loop: true,
        margin: 10,
        responsiveClass: true,
        smartSpeed:1000,
        items: 1,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true,
    });

    $('.shop-swiper').owlCarousel({
        nav: true,
        loop: true,
        margin: 10,
        responsiveClass: true,
        items: 1,
        lazyLoad: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    $('.blog-swiper').owlCarousel({
        nav: true,
        loop: true,
        margin: 10,
        responsiveClass: true,
        items: 1,
        lazyLoad: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    var homeSliderHeight = $('.home-swiper').height();
    $('.home-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (homeSliderHeight > captionHeight) {
            top = ((homeSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });

    var shopSliderHeight = $('.shop-swiper').height();
    $('.shop-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (shopSliderHeight > captionHeight) {
            top = ((shopSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });

    var blogSliderHeight = $('.blog-swiper').height();
    $('.blog-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (blogSliderHeight > captionHeight) {
            top = ((blogSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });


    var product_carasol = $('.mgs-product-carasol').owlCarousel({
        nav: true,
        loop: true,
        margin: 15,
        responsiveClass: true,
        items: 4,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        }
    });

    window.brand_carousel = $('.brand-carousel').owlCarousel({
        nav: true,
        loop: true,
        margin: 15,
        responsiveClass: true,
        items: 5,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        }
    });



    window.testimonial_carousel = $('.testimonial-carousel').owlCarousel({
        items: 2,
        loop: true,
        // center: true,
        margin: 15,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: true
    });

    $('.nav-pills a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    
    /* Lignt Box*/
    var gallery = $('.post .img-zoom').simpleLightbox();

    new WOW().init();

});