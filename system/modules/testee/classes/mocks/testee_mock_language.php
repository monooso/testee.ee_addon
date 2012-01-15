<?php

/**
 * Mock language class. Note that EE also defines a global 'lang' function, which
 * isn't mocked (in fact, I'm not sure whether it can be).
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_language {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$language
	    $cur_used
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function fetch_language_file() {}
	public function line() {}
	
}

/* End of file		: testee_mock_language.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_language.php */