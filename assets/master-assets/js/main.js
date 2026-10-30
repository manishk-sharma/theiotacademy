(function ($) {
  'use strict';

  //mobile menu
  // $(".menu-toggle").on('click', function(){
  //     $("#resmenu").addClass('open')
  //     $("body").addClass("resmenu-overlay");
  // });

  // $(".resmenu-close").on('click', function(){
  //     $("#resmenu").removeClass('open')
  //     $("body").removeClass("resmenu-overlay");
  // });

  // $(".res-submenu > a").on('click', function(e){
  //     e.preventDefault();
  //     $(this).next().slideToggle();
  // });

  //menu fixed
  // var $window = $(window);
  // $window.on('scroll', function() {
  //     if ($window.scrollTop() > 73) {
  //         $('.header').addClass('fixed');
  //     } else if ($window.scrollTop() > 400) {
  //         $('.header').removeClass('fixed');
  //     } else {
  //         $('.header').removeClass('fixed');
  //     }
  // });

  $('.srchbtn').click(function () {
    $('#srbar').slideToggle();
  });

  var lastId,
    topMenu = jQuery('#master-nav-wrapper'),
    topMenuHeight = topMenu.outerHeight() + 1,
    menuItems = topMenu.find('a'),
    scrollItems = menuItems.map(function () {
      var item = jQuery(jQuery(this).attr('href'));
      if (item.length) {
        return item;
      }
    });

  //     $('a[href*="#"]').on('click', function(e) {
  //     $('html,body').animate({
  //         scrollTop: $($(this).attr('href')).offset().top - 60
  //     }, 500);
  //     e.preventDefault();
  // });

  $('.m1').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master1').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m2').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master2').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m3').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master3').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m4').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master4').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m5').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master5').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m6').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master6').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m77').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master77').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m7').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master7').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m8').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master8').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m9').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master9').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m10').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master10').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });
  $('.m11').click(function (e) {
    $('html,body').animate(
      {
        scrollTop: $('#master11').offset().top - 30
      },
      500
    );
    e.preventDefault();
  });

  jQuery(window).scroll(function () {
    var fromTop = jQuery(this).scrollTop() + topMenuHeight;
    var cur = scrollItems.map(function () {
      if (jQuery(this).offset().top < fromTop) return this;
    });
    cur = cur[cur.length - 1];
    var id = cur && cur.length ? cur[0].id : '';
    if (id != '' && id != 'undefined') {
      if (lastId !== id) {
        lastId = id;
        menuItems
          .parent()
          .removeClass('active')
          .end()
          .filter("[href='#" + id + "']")
          .parent()
          .addClass('active');
        var active = jQuery('#master-nav-list li.active');
        var left = active.position().left;
        var currScroll = jQuery('#master-nav-wrapper').scrollLeft();
        var contWidth = jQuery('#master-nav-wrapper').width() / 2;
        var activeOuterWidth = active.outerWidth() / 2;
        left = left + currScroll - contWidth + activeOuterWidth;
        jQuery('#master-nav-wrapper').animate({ scrollLeft: left }, 'slow');
      }
    }
  });

  // if (jQuery('.mastersection1').length > 0 || jQuery('.mastersection2').length > 0) {
  if (jQuery('.mastersection1').length > 0) {
    // var master_con_height = jQuery(".mastersection1").outerHeight(true);
    // var master_con2_height = jQuery(".mastersection2").outerHeight(true);
    var master_con2_height = jQuery('.mastersection1').outerHeight(true);

    var total_height = master_con2_height + 345;

    jQuery(window).on('scroll', function () {
      var scroll = jQuery(window).scrollTop();
      // if (scroll >= master_con2_height) {
      if (scroll >= total_height) {
        //alert('this is true');
        jQuery('.master-nav ').addClass('master-nav-scroll-fixed');
      } else {
        jQuery('.master-nav ').removeClass('master-nav-scroll-fixed');
      }
    });
  }

  //Smooth Scrolling Using Navigation Menu
})(jQuery);

$(document).ready(function () {
  $('.accsection').click(function () {
    $('.accsection').removeClass('on');
    $('.accsection').parent().removeClass('active');
    $('.accContent').slideUp('normal');
    if ($(this).next().is(':hidden') == true) {
      $(this).addClass('on');
      $(this).parent().addClass('active');
      $(this).next().slideDown('normal');
    }
  });
  $('.accContent').hide();
  $('.accContent:first').show();
  $('.accsection:first').addClass('on');
  $('.accsection:first').parent().addClass('active');

  $('.closeuser').click(function () {
    $('#tabdrop').hide();
  });
});

$(document).ready(function () {
  $('.accsection2').click(function () {
    $('.accsection2').removeClass('on2');
    $('.accsection2').parent().removeClass('active');
    $('.accContent2').slideUp('normal');
    if ($(this).next().is(':hidden') == true) {
      $(this).addClass('on2');
      $(this).parent().addClass('active');
      $(this).next().slideDown('normal');
    }
  });
  $('.accContent2').hide();
  $('.accContent2:first').show();
  $('.accsection2:first').addClass('on2');
  $('.accsection2:first').parent().addClass('active');

  $('.closeuser').click(function () {
    $('#tabdrop').hide();
  });
});

$(document).ready(function () {
  $('.jp_tittle_slider_content_wrapper .owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayHoverPause: true,
    responsiveClass: true,
    navText: [
      '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
      '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
    ],
    // animateOut: 'bounceInDown',
    // animateIn: 'bounceInDown',
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 1,
        nav: true
      },
      1000: {
        items: 1,
        nav: true,
        loop: true,
        margin: 20
      }
    }
  });

  $('.uni_slide').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.tranding_slide').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.offerslider, .coachslider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.testi_slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.new_alumni_testi_slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.studyslider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('#gallery').slick({
    slidesToShow: 7,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    arrows: false,
    dots: false,
    pauseOnHover: true,
    focusOnSelect: true,
    accessibility: false,
    speed: 5000,
    mobileFirst: true,
    cssEase: 'linear',
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 7
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 5
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 359,
        settings: {
          slidesToShow: 2,
          speed: 3000
        }
      }
    ]
  });

  $('#gallery11').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 10000,
    pauseOnHover: true,
    arrows: false,
    focusOnSelect: true,
    accessibility: false,
    mobileFirst: true,
    cssEase: 'linear'
  });
});

// Scroll On TOP //
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $('.cd-top').fadeIn();
  } else {
    $('.cd-top').fadeOut();
  }
});
$('.cd-top').click(function () {
  $('html, body').animate(
    {
      scrollTop: 0
    },
    600
  );
  return false;
});

$(document).ready(function () {
  'use strict';
  // variables
  var contextWindow = $(window);
  // ----------------------
  // ++ Header .. Start
  // ------------------------
  // Desktop Hover navigation
  $('.tg-themetabnav > li > a').hover(function () {
    if ($(this).parent().hasClass('active')) {
      $(this).parent().siblings().removeClass('active');
      $(this).parent().siblings().find('.tab-pane').removeClass('active');
      $(this).parent().removeClass('active');
    } else {
      $(this).parent().siblings().removeClass('active');
      $(this).parent().siblings().find('.tab-pane').removeClass('active');
      $(this).parent('li').addClass('active');
      $(this).parent().find('.tab-pane').addClass('active');
    }
  });

  $('.tg-small-nav li a').on('click', function () {
    // $(this).off('click');
    $('.dropdown-animate[data-toggle=hover]').removeClass('active show');
    if ($(this).parent().hasClass('active')) {
      $(this).parent().siblings().removeClass('active');
      $(this).parent().siblings().find('.tab-pane').removeClass('active');
      $(this).parent().removeClass('active');
    } else {
      $(this).parent().siblings().removeClass('active');
      $(this).parent().siblings().find('.tab-pane').removeClass('active');
      $(this).parent('li').addClass('active');
      $(this).parent().find('.tab-pane').addClass('active');
    }
  });

  ///////////////headerbg/////////////////
  if ($(window).width() > 1024) {
    $(
      '.quick-size, .quicksize-drop, .btn-rounded-rb, .dropdown-menu-right, .menu-item-has-mega-menu'
    ).mouseover(function () {
      $('.overlay-navright').stop().fadeIn(200);
    });
    $(
      '.quick-size, .quicksize-drop, .btn-rounded-rb, .dropdown-menu-right, .menu-item-has-mega-menu'
    ).mouseout(function () {
      $('.overlay-navright').stop().fadeOut(100);
    });
  }
  $(document).click(function (e) {
    $('.overlay-navright').hide();
    $('.bt-action-login').removeClass('active');
  });

  $('.tg-themetabnav li a').mouseenter(function () {
    $('.tg-themetabnav li').removeClass('active');
    $(this).parent('li').addClass('active');
  });

  ////////////// dropdown menu on hover ///////////////////
  /*$('.dropdown-menu').on('click', function(event){
        event.stopPropagation();
    });*/
  ////////////// @end dropdown menu on hover ///////////////////

  //$('.ddlogin_link:first-child, .ddlogin_link:first-child a').addClass('active');
  $('.ddlogin_link').click(function () {
    $('.login_list').hide();
    $('.ddlogin_link, .ddlogin_link a').removeClass('active');
    $(this).addClass('active');
    //$(this).find('a').addClass('active')
    $(this).find('ul').show();
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    e.target; // newly activated tab
    e.relatedTarget; // previous active tab
  });

  if ($(window).width() > 1024) {
    $('.dropdown[data-toggle=hover]')
      .mouseover(function () {
        $(this).addClass('show').attr('aria-expanded', 'true');
        $(this).find('.dropdown-menu').addClass('show');
      })
      .mouseout(function () {
        $(this).removeClass('show').attr('aria-expanded', 'false');
        $(this).find('.dropdown-menu').removeClass('show');
      });
  } else if ($(window).width() <= 1024) {
    $('.btn-action').click(function () {
      //alert('');
      $('.mobileMenu').removeClass('open');

      $('.bt-action-login').toggleClass('active');
      $('.overlay-navright').toggle();
      $('body').toggleClass('noscroll bodyfix');
    });

    $('.overlay-navright').on('click', function (e) {
      $('.bt-action-login').removeClass('active');
      $('body').removeClass('noscroll bodyfix');
    });
  }

  $(function () {
    // init zeynepjs side menu
    var zeynep = $('#zeynep').zeynep({
      opened: function () {
        // log
        console.log('the  zeynep1 side menu opened');
      },
      closed: function () {
        // log
        console.log('the side menu closed');
      }
    });

    // dynamically bind 'closing' event
    zeynep.on('closing', function () {
      // log
      console.log('this event is dynamically binded');
    });

    // handle zeynepjs overlay click
    $('.zeynep-overlay').on('click', function () {
      zeynep.close();
    });

    // open zeynepjs side menu
    $('.btn-open').on('click', function () {
      zeynep.open();
    });
  });
});

//start js of mlsLandingPage slider
$('.mls_slider').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 5000,
  arrows: true,
  dots: true,
  pauseOnHover: false,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1
      }
    },
    {
      breakpoint: 520,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

//end js of mlsLandingPage slider

// add new slider mlsLandingPage
$('.alumini_slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 1500,
  arrows: true,
  prevArrow:
    '<button type="button" class="slick-prev someoneNew prevBtnAlumini">Previous</button>',
  nextArrow:
    '<button type="button" class="slick-next someoneNew nextBtnAlumini">Next</button>',
  dots: false,
  pauseOnHover: false,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1
      }
    },
    {
      breakpoint: 520,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
// add new slider mlsLandingPage
