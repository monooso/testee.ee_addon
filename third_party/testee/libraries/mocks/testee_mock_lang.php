<?php

/**
 * Mock language class.
 *
 * @see 		http://codeigniter.com/user_guide/libraries/language.html
 * @see 		http://expressionengine.com/user_guide/development/usage/language.html
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_language {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$is_loaded
		$language
		$user_lang
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function load() {}
	public function loadfile() {}
	public function line() {}
	
}


/* End of file		: Testee_mock_db.php */
/* File location	: third_party/testee/libraries/Testee_mock_db.php */