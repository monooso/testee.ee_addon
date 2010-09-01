/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

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