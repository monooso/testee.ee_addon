<?php

/**
 * Mock input class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_input {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$AGENT
	    $IP
	    $SID
	    $URI
	    $QSTR
	    $Pages_QSTR
	    $SEGS
		$trim_input
		$global_publics
		$whitelisted
		$blacklisted
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function check_blacklist() {}
	public function clean_input_data() {}
	public function clean_input_keys() {}
	public function fetch_input_data() {}
	public function fetch_uri_segment() {}
	public function filter_get_data() {}
	public function GBL() {}
	public function parse_qstr() {}
	public function parse_uri() {}
	public function sanitize() {}
	
}


/* End of file		: testee_mock_input.php */
/* File location	: third_party/testee/classes/mocks/testee_mock_input.php */