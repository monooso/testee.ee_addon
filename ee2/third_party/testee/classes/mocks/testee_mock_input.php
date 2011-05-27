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
	 * PUBLIC CODEIGNITER PROPERTIES
	 * --------------------------------------------------------------
		$ip_address
		$user_agent
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE PROPERTIES
	 * --------------------------------------------------------------
		$SID
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC CODEIGNITER METHODS
	 * ------------------------------------------------------------ */
	public function get($index = '', $xss_clean = FALSE) {}
	public function post($index = '', $xss_clean = FALSE) {}
	public function get_post($index = '', $xss_clean = FALSE) {}
	public function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '') {}
	public function server($index = '', $xss_clean = FALSE) {}
	public function ip_address() {}
	public function valid_ip($ip) {}
	public function user_agent() {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE METHODS
	 * ------------------------------------------------------------ */
	public function cookie($index = '') {}
	public function filter_get_data($request_type = 'PAGE') {}
	
}


/* End of file		: testee_mock_input.php */
/* File location	: third_party/testee/classes/testee_mock_input.php */