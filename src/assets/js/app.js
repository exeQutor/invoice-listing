import $ from 'jquery';
import 'what-input';
import moment from 'moment';
import Litepicker from 'litepicker';

// Foundation JS relies on a global variable. In ES6, all imports are hoisted
// to the top of the file so if we used `import` to import Foundation,
// it would execute earlier than we have assigned the global variable.
// This is why we have to use CommonJS require() here since it doesn't
// have the hoisting behavior.
window.jQuery = $;
require('foundation-sites');

// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

const picker = new Litepicker({
	element: document.getElementById('invoicedates'),
	singleMode: false,
	format: 'YYYYMMDD',
	autoApply: false,
	setup: (picker) => {
		picker.on('button:apply', (date1, date2) => {
			let url = new URL(window.location.href);
			let search_params = url.searchParams;
			search_params.set('start', moment(date1.dateInstance).format('YYYYMMDD'));
			search_params.set('end', moment(date2.dateInstance).format('YYYYMMDD'));
			url.search = search_params.toString();
			var new_url = url.toString();
			window.location.href = new_url;
		});
	}
});

// start all jQuery related methods
(function ($) {

  $(document).foundation();

  init_invoice_toggle_checkboxes();
  init_invoice_mark_as_paid();
	init_mobile_menu();

  function init_invoice_toggle_checkboxes() {
    $('#select-all-invoices').change(function () {
      var status = this.checked;

      $('.invoices-checkbox').each(function () {
        this.checked = status;
      });
    });

    $('.invoices-checkbox').change(function () {
      if (this.checked == false) $('#select-all-invoices')[0].checked = false;
      if ($('.invoices-checkbox:checked').length == $('.invoices-checkbox').length) $('#select-all-invoices')[0].checked = true;
    });
  }

  function init_invoice_mark_as_paid() {
    $('#invoice-mark-paid').click(function () {
      var selected = [];
      var $this_button = $(this);

      $this_button.prop('disabled', true);

      $('.invoices-checkbox:checked').each(function () {
        selected.push($(this).data('invoice-id'));

        $.ajax({
          type: 'post',
          dataType: 'json',
          url: OBJ.ajaxurl,
          data: {
            id: $(this).data('invoice-id'),
            action: 'mark_as_paid'
          },
          success: function (response) {
            if (response.result) {
              $('.status--' + response.id).removeClass('status--pending status--verified').addClass('status--paid').text('PAID');
            }

            $this_button.prop('disabled', false);
          }
        });
      });
    });
  }

  function init_mobile_menu() {
    $('#mobile-menu').click(function(e) {
			e.preventDefault();

			var $header_nav_list = $('.header-nav-list');
			var sp_class = 'header-nav-list--sp';

			if ($header_nav_list.hasClass(sp_class)) {
				$header_nav_list.removeClass(sp_class);
			} else {
				$header_nav_list.addClass(sp_class);
			}
		})
  }

})(jQuery);
