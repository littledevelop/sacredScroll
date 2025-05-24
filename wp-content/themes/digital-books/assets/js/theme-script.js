jQuery(document).keyup(function(e) {
  if (e.key === "Escape") {
    if (jQuery('#offcanvas-menu').hasClass("offcanvas-menu-active")) {
      jQuery('#offcanvas-menu').removeClass("offcanvas-menu-active")
    }
  }
});
jQuery(document).ready(function() {
    var slider_loop = jQuery('#top-slider').attr('slider-loop');
    var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: slider_loop == 0 ? false : slider_loop,
    dots: false,
    navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });

  window.addEventListener('load', (event) => {
    jQuery(".loading").delay(1000).fadeOut("slow");
    jQuery(".loading2").delay(2000).fadeOut("slow");
  });
})

jQuery(document).ready(function(){
  jQuery('.search-box span a').click(function(){
    jQuery(".serach_outer").toggle();
  });
});

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(window).scroll(function() {
  var data_sticky = jQuery('.main_header').attr('data-sticky');

  if (data_sticky == "true") {
    if (jQuery(this).scrollTop() > 1){
      jQuery('.main_header').addClass("stick_header");
    } else {
      jQuery('.main_header').removeClass("stick_header");
    }
  }
});

jQuery(document).ready(function ($) {
// Menu Js
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Menu Toggle Js
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').on('focus', function () {
        $('.button-offcanvas-close').focus();
    });
});
