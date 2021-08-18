(function($){

  init_common();
  init_sticky_header();
  init_meanmenu();
  // init_stellar();
  // init_scrollto();
  // init_testimonial_slider();
  // init_partner_slider();
  // init_header_hide();
  // init_header_hide2();
  // init_header_hide3();
  // init_dummy_load_more();


  function init_common() {
    // Foundation JavaScript
    $(document).foundation();

    $('p').has('img').addClass('has-image');
  }

  function init_sticky_header() {
    window.onscroll = function() {bm_sticky()};

    var header = document.getElementById("sticky-header");
    var sticky = header.offsetTop + 400;

    function bm_sticky() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  }

  function init_meanmenu() {
    $('.sticky-header .header-nav').meanmenu({
      meanMenuContainer: '.header-mobile-nav',
      meanScreenWidth: 1023,
      meanRemoveAttrs: true,
      // removeElements: '.header-phone'
    });
  }

  function init_stellar() {
    $(window).stellar();
  }

  function init_scrollto() {
    $("a").click(function() {
      var target = $(this).attr('href');

      if (target != '#') {
        $([document.documentElement, document.body]).animate({
          scrollTop: $(target).offset().top - 100
        }, 1000);
      }
    });
  }

  function init_testimonial_slider() {
    $('.home-testimonial-list').slick({
      infinite: true,
      slidesToShow: 1,
      autoplay: true,
      arrows: false,
      dots: true
    });
  }

  function init_partner_slider() {
    $('.partner-list').slick({
      infinite: true,
      slidesToShow: 4,
      autoplay: true,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
  }

  function init_header_hide() {
    if ($('body').hasClass('home')) {
      $('.header').hide();

      $('.header').on('sticky.zf.stuckto:top', function() {
        // console.log('sticky.zf.stuckto:top ...');
        $('.header').slideDown();
      });

      $('.header').on('sticky.zf.unstuckfrom:top', function() {
        $('.header').hide();
        // console.log('sticky.zf.unstuckfrom:top ...')
      });
    } else {
      $('.header').on('sticky.zf.stuckto:top', function() {
        // console.log('sticky.zf.stuckto:top ...');
        $('.header').hide();
        $('.header').slideDown();
      });
    }
  }

  function init_header_hide2() {
    $('.sticky-header').on('sticky.zf.stuckto:top', function() {
      $('.sticky-header').hide();
      $('.sticky-header').slideDown();
    });
  }

  function init_header_hide3() {
    $('.sticky-header').on('sticky.zf.stuckto:top', function() {
      $('.sticky-header').hide();
      $('.sticky-header').slideDown();
    });

    $('.sticky-header').on('sticky.zf.unstuckfrom:top', function() {
      $('.sticky-header').hide();
    });
  }

  function init_dummy_load_more() {
    // char char nga load more ...
    $('.js-load-more').click(function(e) {
      var $thisButton = $(this);
      var $list = $('.review-list');
      var len = $list.find('li.hide').length;
      var limit = 20;
      var ctr = 0;

      if (len > limit) {
        len = limit;
      }

      $list.find('li').each(function() {
        if (ctr >= len) return false;

        if ($(this).hasClass('hide')) {
          $(this).removeClass('hide');

          ctr++;
        }
      });

      if ( ! $list.find('li.hide').length) {
        $thisButton.remove();
      }

      e.preventDefault();
    });
  }

})(jQuery);
