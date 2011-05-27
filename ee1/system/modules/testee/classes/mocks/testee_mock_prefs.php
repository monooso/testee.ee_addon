<?php

/**
 * Mock preferences class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_preferences {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$core_ini
	    $default_ini
	    $exceptions
	    $cp_cookie_domain
		$special_tlds
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function ini($which = '', $slash = FALSE) {}
	public function site_prefs($site_name, $site_id = 1) {}
	public function disable_tracking() {}
	public function divination($which) {}
	
}


/* End of file		: testee_mock_prefs.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_prefs.php */