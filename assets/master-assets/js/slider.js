$(document).ready(function($){
    "use strict";

    //menu fixed
    // var $window = $(window);
    // $window.on('scroll', function () {
    //     if ($window.scrollTop() > 350) {
    //         $('.header').addClass('fixed');
    //     } else {
    //         $('.header').removeClass('fixed');
    //     }
    // });

    //blog slider
    
    $('.slidercont11').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        // autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
    });

    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    
    
    var owl = $("#owl-clientslider");

            owl.owlCarousel({

                items: 3, //10 items above 1000px browser width
                itemsDesktop: [1000, 3], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 2], // 3 items betweem 900px and 601px
                itemsTablet: [600, 1], //2 items between 600 and 0;
                itemsMobile: [360, 1] // itemsMobile disabled - inherit from itemsTablet option

            });

            // Custom Navigation Events
            $(".next").click(function() {
                owl.trigger('owl.next');
            })
            $(".prev").click(function() {
                owl.trigger('owl.prev');
            })
            $(".play").click(function() {
                owl.trigger('owl.play', 1000);
            })
            $(".stop").click(function() {
                owl.trigger('owl.stop');
            })

    //logo slider js

    $('.brand-carousel').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
        }
    })

    $('.slidercont111').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        nav: false,
        autoplayTimeout: 5000,
        responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
        }
    })
});