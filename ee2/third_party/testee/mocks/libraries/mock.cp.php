<?php

/**
 * Mock Cp class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_cp {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$cp_theme
		$cp_theme_url
		$footer_item
		$installed_modules
		$its_all_in_your_head
		$js_files
		$xid_ttl
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function set_default_view_variables() {}
	public function masked_url($url) {}
	public function add_js_script($script = array(), $in_footer = TRUE) {}
	public function render_footer_js() {}
	public function set_right_nav($nav = array()) {}
	public function delete_layout_tabs($tabs = array(), $namespace = '', $channel_id = array()) {}
	public function add_layout_tabs($tabs = array(), $namespace = '', $channel_id = array()) {}
	public function add_layout_fields($tabs = array(), $channel_id = array()) {}
	public function delete_layout_fields($tabs, $channel_id = array()) {}
	public function get_safe_refresh() {}
	public function set_variable($name, $value) {}
	public function set_breadcrumb($link, $title) {}
	public function secure_forms() {}
	public function fetch_cp_themes() {}
	public function load_package_js($file) {}
	public function load_package_css($file) {}
	public function add_to_head($data) {}
	public function add_to_foot($data) {}
	public function allowed_group($which = '') {}
	public function get_installed_modules() {}
	public function invalid_custom_field_names() {}
	public function fetch_action_id($class, $method) {}
	
}

/* End of file		: testee_mock_cp.php */
/* File location	: third_party/testee/classes/testee_mock_cp.php */