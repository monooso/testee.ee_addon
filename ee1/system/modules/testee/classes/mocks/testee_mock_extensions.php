<?php

/**
 * Mock extensions class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_extensions {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$end_script
		$extensions
	    $in_progress
		$last_call
		$OBJ
	    $s_cache
	    $version_numbers
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function call_extension() {}
	public function universal_call_extension() {}
	public function active_hook() {}
	
}


/* End of file		: testee_mock_extensions.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_extensions.php */