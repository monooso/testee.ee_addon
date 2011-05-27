/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

(function($) {

$('document').ready(function() {

	$('.addons_index > li').removeClass('expanded').addClass('collapsed');

	$('.addon_title a').click(function(e) {
		$(this).closest('.addon_title').next('.addon_tests').slideToggle();
	
		// Should be able to use a single string -- 'collapsed expanded' -- but not working.
		$(this).closest('li').toggleClass('collapsed');
		$(this).closest('li').toggleClass('expanded');
		
		e.preventDefault();
	});

	$('.addon_title :checkbox').click(function() {
		$(this).attr('checked')
			? $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').attr('checked', 'checked')
			: $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').removeAttr('checked')
	});

	// When the results page loads, focus on the 'submit' button.
	$('#repeat_tests').focus();
});

})(jQuery);
