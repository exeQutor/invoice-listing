(function($){

  init_common();
  init_sticky_header();
  init_meanmenu();
	init_invoice_dates();
	init_invoice_toggle_checkboxes();
	init_invoice_mark_as_paid();
	// init_invoice_ajax();

  // init_stellar();
  // init_scrollto();
  // init_testimonial_slider();
  // init_partner_slider();
  // init_header_hide();
  // init_header_hide2();
  // init_header_hide3();
  // init_dummy_load_more();

	function init_invoice_toggle_checkboxes() {
		$('#select-all-invoices').change(function() {
			var status = this.checked;

			$('.invoices-checkbox').each(function() {
				this.checked = status;
			});
		});

		$('.invoices-checkbox').change(function() {
			if (this.checked == false) $('#select-all-invoices')[0].checked = false;
			if ($('.invoices-checkbox:checked').length == $('.invoices-checkbox').length) $('#select-all-invoices')[0].checked = true;
		});
	}

	function init_invoice_mark_as_paid() {
		$('#invoice-mark-paid').click(function() {
			var selected = [];

			$('.invoices-checkbox:checked').each(function() {
				selected.push($(this).data('invoice-id'));

				$.ajax({
					type: 'post',
					dataType: 'json',
					url: OBJ.ajaxurl,
					data: {
						id: $(this).data('invoice-id'),
						action: 'mark_as_paid'
					},
					success: function(response) {
						console.log(response);
					}
				});
			});

			console.log(selected);
		});

	}

	function init_invoice_ajax() {
		$(document).on('click', '.invoice-pagenav .page-numbers', function(e) {
			e.preventDefault();

			var $this_el = $(this);
			var page = parseInt($this_el.text());
			var $current_page_el = $('.invoice-pagenav .page-numbers.current');
			var current_page = parseInt($current_page_el.text());
			var prev_page = page <= 1 ? 1 : page - 1;
			var next_page = page >= Math.ceil(OBJ.max_invoices / 3) ? Math.ceil(OBJ.max_invoices / 3) : page + 1;

			if ($this_el.hasClass('prev')) page = current_page - 1;
			if ($this_el.hasClass('next')) page = current_page + 1;

			$('.invoice-pagenav .page-numbers.prev').attr('href', OBJ.homeurl + '/invoices/page/' + prev_page + '/');
			$('.invoice-pagenav .page-numbers.next').attr('href', OBJ.homeurl + '/invoices/page/' + next_page + '/');

			$.ajax({
				type: 'get',
				dataType: 'json',
				url: OBJ.apiurl + '/invoice?per_page=3&page=' + page,
				success: function(response) {
					console.log(response);

					// if ($this_el.hasClass('prev') == false && $this_el.hasClass('next') == false) {
						$current_page_el.replaceWith('<a class="page-numbers" href="' + OBJ.homeurl + '/invoices/page/' + current_page + '/">' + current_page + '</a>');
						$this_el.replaceWith('<span class="page-numbers current">' + page + '</span>');
					// }
				}
			});
		});
	}

	function init_invoice_dates() {
		$('input[name="invoicedates"]').daterangepicker({
	    opens: 'left',
			autoUpdateInput: false,
			locale: {
				cancelLabel: 'Clear'
			}
	  }, function(start, end, label) {
			var url = new URL(window.location.href);
			var search_params = url.searchParams;

			search_params.set('start', start.format('YYYYMMDD'));
			search_params.set('end', end.format('YYYYMMDD'));

			url.search = search_params.toString();

			var new_url = url.toString();

			window.location.href = new_url;
	  });
	}

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
