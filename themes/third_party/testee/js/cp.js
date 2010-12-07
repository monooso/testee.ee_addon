/**
 * Test-driven add-on development module.
 *
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 * @package		Testee
 */

(function($) {

	$(document).ready(function() {
		
		/* --------------------------------------
		 * Tests index.
		 * ----------------------------------- */
		
		$('.addons_index > li').removeClass('expanded').addClass('collapsed');

		$('.addon_title a').click(function(e) {
			$(this).closest('.addon_title').next('.addon_tests').slideToggle();
			$(this).closest('li').toggleClass('collapsed expanded');

			e.preventDefault();
		});

		$('.addon_title :checkbox').click(function() {
			$(this).attr('checked')
				? $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').attr('checked', 'checked')
				: $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').removeAttr('checked')
		});
		
		
		/* --------------------------------------
		 * Test results.
		 * ----------------------------------- */
		
		$('#retest_submit').focus();
	});
	
	
})(window.jQuery);

/* End of file		: cp.js */
/* File location	: themes/third_party/testee/js/cp.js */