<?php

/**
 * Mock config class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_config {
	
	/* --------------------------------------------------------------
	 * PUBLIC CODEIGNITER PROPERTIES
	 * --------------------------------------------------------------
		$config
		$is_loaded
	
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE PROPERTIES
	 * --------------------------------------------------------------
		$config_path
		$database_path
		$default_ini
		$exceptions
		$cp_cookie_domain
		$special_tlds
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC CODEIGNITER METHODS
	 * ------------------------------------------------------------ */
	public function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE) {}
	public function item($item, $index = '') {}
	public function slash_item($item) {}
	public function site_url($uri = '') {}
	public function system_url() {}
	public function set_item($item, $value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE METHODS
	 * ------------------------------------------------------------ */
	public function site_prefs($site_name, $site_id = 1) {}
	public function disable_tracking() {}
	public function divination($which) {}
	public function update_site_prefs($new_values = array(), $site_id = FALSE, $find = '', $replace = '') {}
}

/* End of file		: testee_mock_config.php */
/* File location	: third_party/testee/classes/testee_mock_config.php */