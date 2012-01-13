<?php

/**
 * Mock Display class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_display {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$publish_nav
		$sites_nav
		$title
		$body
		$crumb
		$rcrumb
		$crumbline
		$show_crumb
		$crumb_ov
		$refresh
		$ref_rate
		$url_append
		$body_props
		$initial_body
		$extra_css
		$manual_css
		$extra_header
		$rcrumb_css
		$padding_tabs
		$empty_menu
		$view_path
		$cached_vars
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	public function view($view, $vars = array(), $return = FALSE, $path = '') {}
	public function set_return_data($title = '', $body = '', $crumb = '',  $rcrumb = '') {}
	public function allowed_group($which = '') {}
	public function show_full_control_panel() {}
	public function show_restricted_control_panel() {}
	public function show_login_control_panel() {}
	public function html_header($title = '') {}
	public function fetch_stylesheet() {}
	public function file_open($file) {}
	public function page_header($header = TRUE) {}
	public function fetch_quicklinks() {}
	public function fetch_quicktabs() {}
	public function generate_quick_tab() {}
	public function simple_header($class = 'loginLogo') {}
	public function equalize_text($text = array()) {}
	public function page_navigation() {}
	public function clean_tab_text($str = '') {}
	public function content($padding = FALSE) {}
	public function secure_hash($str = '') {}
	public function build_crumb($crumbs = '') {}
	public function breadcrumb() {}
	public function right_crumb($title, $url = '', $extra = '', $pop = FALSE) {}
	public function crumb_item($item) {}
	public function required($blurb = '') {}
	public function content_close() {}
	public function copyright() {}
	public function html_footer() {}
	public function error_message($message = '', $n = 1) {}
	public function no_access_message($message = '') {}
	public function pager($base_url = '', $total_count = '', $per_page = '', $cur_page = '', $qstr_var = '') {}
	public function delete_confirmation($data = array()) {}
	public function div($style = 'default', $align = '', $id = '', $name = '', $extra = '') {}
	public function div_c() {}
	public function qdiv($style = '', $data = '', $id = '', $extra = '') {}
	public function span($style = 'default', $extra = '') {}
	public function span_c($style = 'default') {}
	public function qspan($style = '', $data = '', $id = '', $extra = '') {}
	public function heading($data = '', $h = '1') {}
	public function anchor($url, $name = '', $extra = '', $pop = FALSE) {}
	public function anchorpop($url, $name, $width = '500', $height = '480') {}
	public function pagepop($url, $name) {}
	public function mailto($email, $name = '') {}
	public function br($num = 1) {}
	public function qbr($num = 1) {}
	public function itemgroup($top = '', $bottom = '') {}
	public function nl($num = 1) {}
	public function nbs($num = 1) {}
	public function table_open($props = array()) {}
	public function table_row($array = array()) {}
	public function table_close($padding = FALSE) {}
	public function form_open($data = '', $hidden = array()) {}
	public function form_close() {}
	public function input_hidden($name, $value = '') {}
	public function input_text($name, $value = '', $size = '90', $maxl = '100', $style = 'input', $width = '100%', $extra = '', $convert = FALSE, $text_direction = 'ltr') {}
	public function input_pass($name, $value = '', $size = '20', $maxl = '100', $style = 'input', $width = '100%', $text_direction = 'ltr') {}
	public function input_textarea($name, $value = '', $rows = '20', $style = 'textarea', $width = '100%', $extra = '', $convert = FALSE, $text_direction = 'ltr') {}
	public function input_select_header($name, $multi = '', $size = 3, $width = '', $extra = '') {}
	public function input_select_option($value, $item, $selected = '', $extra = '') {}
	public function input_select_footer() {}
	public function input_checkbox($name, $value = '', $checked = '', $extra = '') {}
	public function input_radio($name, $value = '', $checked = 0, $extra = '') {}
	public function input_submit($value = '', $name = '', $extra = '') {}
	public function magic_checkboxes() {}
	public function toggle() {}
	public function table($style = '', $cellspacing = '0', $cellpadding = '0', $width = '100%', $border = '0', $align = '') {}
	public function table_qrow($style = '', $data = '', $auto_width = FALSE) {}
	public function table_qcell($style = '', $data = '', $width = '', $valign = '', $align = '') {}
	public function tr($style = '') {}
	public function td($style = '', $width = '', $colspan = '', $rowspan = '', $valign = '', $align = '') {}
	public function td_c() {}
	public function tr_c() {}
	public function table_c() {}
	public function form($action, $name = '', $method = 'post', $extras = '') {}
	public function form_c() {}
	public function invalid_custom_field_names() {}
	public function html_attribute_prep($label, $quotes = ENT_QUOTES) {}
	
}


/* End of file		: testee_mock_display.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_display.php */