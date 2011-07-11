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
		$extensions
		$OBJ
		$end_script
		$last_call
		$in_progress
		$s_cache
		$version_numbers
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE METHODS
	 * ------------------------------------------------------------ */
	public function call($which, $parameter_one = '') {}
	public function universal_call($which, &$parameter_one) {}
	public function active_hook($which) {}
	
}

/* End of file		: testee_mock_extensions.php */
/* File location	: third_party/testee/classes/testee_mock_extensions.php */