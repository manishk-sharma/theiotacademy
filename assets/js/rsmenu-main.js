





$(document).ready(function(){"use strict";var arrow_up='<i class="fa fa-angle-up" aria-hidden="true"></i>';var arrow_down='<i class="fa fa-angle-down" aria-hidden="true"></i>';var arrow_span='<span class="rs-menu-parent">'+arrow_down+'</span>';var close_button='<div class="sub-menu-close"><i class="fa fa-times" aria-hidden="true"></i>Close</div>';$('.nav-menu .rs-mega-menu').append(arrow_span);$('.nav-menu > .menu-item-has-children').append(arrow_span);$('.nav-menu > .menu-item-has-children .sub-menu > .menu-item-has-children').append(arrow_span);$('.nav-menu .menu-item-has-children .sub-menu').append(close_button);$('.nav-menu .rs-mega-menu .mega-menu').append(close_button);$('span.rs-menu-parent').on('click',function(e){e.preventDefault();var t=$(this);var menu=t.siblings('ul');var parent=t.parent('li');var siblings=parent.siblings('li');var arrow_target='span.rs-menu-parent';if(menu.hasClass('sub-menu')){var menu=t.siblings('ul.sub-menu');}else if(menu.hasClass('mega-menu')){var menu=t.siblings('ul.mega-menu');}

if(menu.hasClass('visible')){setTimeout(function(){menu.removeClass('visible');},10);t.html(arrow_down);}else{setTimeout(function(){menu.addClass('visible');},10);t.html(arrow_up);}

parent.find('ul.visible').removeClass('visible');parent.siblings('li').children('ul').removeClass('visible');siblings.find('ul.visible').removeClass('visible');parent.children('ul').find(arrow_target).html(arrow_down);siblings.children(arrow_target).html(arrow_down);siblings.find(arrow_target).html(arrow_down);});$('ul.nav-menu div.sub-menu-close').on('click',function(e){e.preventDefault();var a=$(this).parent('ul');a.removeClass('visible');a.siblings('span.rs-menu-parent').html(arrow_down);});$('a.rs-menu-toggle').on('click',function(e){e.preventDefault();var menu_height=$('.rs-menu ul').height();if($(this).hasClass('rs-menu-toggle-open')){$(this).removeClass('rs-menu-toggle-open').addClass('rs-menu-toggle-close');$('.rs-menu').animate({height:'0px'},{queue:false,duration:300}).addClass('rs-menu-close');}else{$(this).removeClass('rs-menu-toggle-close').addClass('rs-menu-toggle-open');$('.rs-menu').animate({height:menu_height},{queue:false,duration:300}).removeClass('rs-menu-close');}});var window_width=0;$(window).on('load',function(){window_width=$(window).width();$('.rs-menu').addClass("rs-menu-close");});$(window).resize(function(){if(window_width!==$(window).width()){$('.visible').removeClass('visible');$('.rs-menu-toggle').removeClass('rs-menu-toggle-open').addClass("rs-menu-toggle-close");$('.rs-menu').css("height","0").addClass("rs-menu-close");$('span.rs-menu-parent').html(arrow_down);window_width=$(window).width();}});});



//================================Main Js



(function($) {

    "use strict";

    var header = $('.menu-sticky');

    var win = $(window);

    win.on('scroll', function() {

        var scroll = win.scrollTop();

        if (scroll < 300) {

            header.removeClass("sticky");

            $('.course-usp-block').css("top","442px");

        } else {

            header.addClass("sticky");

            $('.course-usp-block').css("top","432px");

        }

    });



    $('.latest-news-slider').slick({

        slidesToShow: 1,

        slidesToScroll: 1,

        arrows: true,

        fade: false,

        asNavFor: '.latest-news-nav'

    });

    $('.latest-news-nav').slick({

        slidesToShow: 4,

        slidesToScroll: 1,

        asNavFor: '.latest-news-slider',

        dots: false,

        centerMode: false,

        centerPadding: '0',

        focusOnSelect: true

    });

    $(window).on('load', function() {

        if ($(window).width() < 992) {

            $('.rs-menu').css('height', '0');

            $('.rs-menu').css('opacity', '0');

            $('.rs-menu-toggle').on('click', function() {

                $('.rs-menu').css('opacity', '1');

            });

        }

    })

    var owl = $('#home-slider');

    owl.owlCarousel({

        loop: true,

        margin: 0,

        navSpeed: 800,

        nav: true,

        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        items: 1,

        autoplay: true,

        transitionStyle: "fade",

    });

    function setAnimation(_elem, _InOut) {

        var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        _elem.each(function() {

            var $elem = $(this);

            var $animationType = 'animated ' + $elem.data('animation-' + _InOut);

            $elem.addClass($animationType).one(animationEndEvent, function() {

                $elem.removeClass($animationType);

            });

        });

    }

    owl.on('change.owl.carousel', function(event) {

        var $currentItem = $('.owl-item', owl).eq(event.item.index);

        var $elemsToanim = $currentItem.find("[data-animation-out]");

        setAnimation($elemsToanim, 'out');

    });

    owl.on('changed.owl.carousel', function(event) {

        var $currentItem = $('.owl-item', owl).eq(event.item.index);

        var $elemsToanim = $currentItem.find("[data-animation-in]");

        setAnimation($elemsToanim, 'in');

    });

    $('.rs-carousel').each(function() {

        var owlCarousel = $(this)

          , loop = owlCarousel.data('loop')

          , items = owlCarousel.data('items')

          , margin = owlCarousel.data('margin')

          , stagePadding = owlCarousel.data('stage-padding')

          , autoplay = owlCarousel.data('autoplay')

          , autoplayTimeout = owlCarousel.data('autoplay-timeout')

          , smartSpeed = owlCarousel.data('smart-speed')

          , dots = owlCarousel.data('dots')

          , nav = owlCarousel.data('nav')

          , navSpeed = owlCarousel.data('nav-speed')

          , xsDevice = owlCarousel.data('mobile-device')

          , xsDeviceNav = owlCarousel.data('mobile-device-nav')

          , xsDeviceDots = owlCarousel.data('mobile-device-dots')

          , smDevice = owlCarousel.data('ipad-device')

          , smDeviceNav = owlCarousel.data('ipad-device-nav')

          , smDeviceDots = owlCarousel.data('ipad-device-dots')

          , mdDevice = owlCarousel.data('md-device')

          , mdDeviceNav = owlCarousel.data('md-device-nav')

          , mdDeviceDots = owlCarousel.data('md-device-dots');

        owlCarousel.owlCarousel({

            loop: (loop ? true : false),

            items: (items ? items : 4),

            lazyLoad: true,

            margin: (margin ? margin : 0),

            autoplay: (autoplay ? true : false),

            autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),

            smartSpeed: (smartSpeed ? smartSpeed : 250),

            dots: (dots ? true : false),

            nav: (nav ? true : false),

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

            navSpeed: (navSpeed ? true : false),

            responsiveClass: true,

            responsive: {

                0: {

                    items: (xsDevice ? xsDevice : 1),

                    nav: (xsDeviceNav ? true : false),

                    dots: (xsDeviceDots ? true : false)

                },

                768: {

                    items: (smDevice ? smDevice : 3),

                    nav: (smDeviceNav ? true : false),

                    dots: (smDeviceDots ? true : false)

                },

                992: {

                    items: (mdDevice ? mdDevice : 4),

                    nav: (mdDeviceNav ? true : false),

                    dots: (mdDeviceDots ? true : false)

                }

            }

        });

    });

    if ($('.player').length) {

        $(".player").YTPlayer();

    }

    $('.collapse.show').prev('.card-header').addClass('active');

    $('#accordion, #bs-collapse, #accordion1').on('show.bs.collapse', function(a) {

        $(a.target).prev('.card-header').addClass('active');

    }).on('hide.bs.collapse', function(a) {

        $(a.target).prev('.card-header').removeClass('active');

    });

    //new WOW().init();

    var gridfilter = $('.grid');

    if (gridfilter.length) {

        $('.grid').imagesLoaded(function() {

            $('.gridFilter').on('click', 'button', function() {

                var filterValue = $(this).attr('data-filter');

                $grid.isotope({

                    filter: filterValue

                });

            });

            var $grid = $('.grid').isotope({

                itemSelector: '.grid-item',

                percentPosition: true,

                masonry: {

                    columnWidth: '.grid-item',

                }

            });

        });

    }

    if ($('.gridFilter button').length) {

        var projectfiler = $('.gridFilter button');

        if (projectfiler.length) {

            $('.gridFilter button').on('click', function(event) {

                $(this).siblings('.active').removeClass('active');

                $(this).addClass('active');

                event.preventDefault();

            });

        }

    }

    var imaggepoppup = $('.image-popup');

    if (imaggepoppup.length) {

        $('.image-popup').magnificPopup({

            type: 'image',

            callbacks: {

                beforeOpen: function() {

                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');

                }

            },

            gallery: {

                enabled: true

            }

        });

    }

    var popupyoutube = $('.popup-youtube');

    if (popupyoutube.length) {

        $('.popup-youtube').magnificPopup({

            disableOn: 700,

            type: 'iframe',

            mainClass: 'mfp-fade',

            removalDelay: 160,

            preloader: false,

            fixedContentPos: false

        });

    }

    var singleproduct = $('.single-product');

    if (singleproduct.length) {

        $('.single-product').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            arrows: false,

            fade: true,

            asNavFor: '.single-product-nav'

        });

    }

    var singleproductnav = $('.single-product-nav');

    if (singleproductnav.length) {

        $('.single-product-nav').slick({

            slidesToShow: 3,

            slidesToScroll: 1,

            asNavFor: '.single-product',

            dots: false,

            focusOnSelect: true,

            centerMode: true,

        });

    }

    $(window).on('load', function() {

        $(".book_preload").delay(2000).fadeOut(200);

        $(".book").on('click', function() {

            $(".book_preload").fadeOut(200);

        })

    })

    if ($('.counter-number').length) {

        $('.counter-number').counterUp({

            delay: 20,

            time: 1500

        });

    }

    var totop = $('#scrollUp');

    if (totop.length) {

        win.on('scroll', function() {

            if (win.scrollTop() > 150) {

                totop.fadeIn();

            } else {

                totop.fadeOut();

            }

        });

        totop.on('click', function() {

            $("html,body").animate({

                scrollTop: 0

            }, 500)

        });

    }

    if ($('#googleMap').length) {

        var initialize = function() {

            var mapOptions = {

                zoom: 10,

                scrollwheel: false,

                center: new google.maps.LatLng(40.837936,-73.412551),

                styles: [{

                    stylers: [{

                        saturation: -100

                    }]

                }]

            };

            var map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);

            var marker = new google.maps.Marker({

                position: map.getCenter(),

                animation: google.maps.Animation.BOUNCE,

                icon: 'images/map-marker.png',

                map: map

            });

        }

        google.maps.event.addDomListener(window, "load", initialize);

    }

    var togglebtn = $('.toggle-btn');

    if (togglebtn.length) {

        $(".toggle-btn").on("click", function() {

            $(this).toggleClass("active");

            $("body").toggleClass("hidden-menu");

        });

    }

    var navexpander = $('#nav-expander');

    if (navexpander.length) {

        $('#nav-expander').on('click', function(e) {

            e.preventDefault();

            $('body').toggleClass('nav-expanded');

        });

    }

    var navclose = $('#nav-close');

    if (navclose.length) {

        $('#nav-close').on('click', function(e) {

            e.preventDefault();

            $('body').removeClass('nav-expanded');

        });

    }

    var sidebarnavmenu = $('.sidebarnav_menu');

    if (sidebarnavmenu.length) {

        $(".sidebarnav_menu li.menu-item-has-children").on('click', function() {

            $(this).children("ul").slideToggle("slow", function() {});

        });

    }

}

)(jQuery);

