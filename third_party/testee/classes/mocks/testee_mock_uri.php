<?php

/**
 * Mock URI class.
 *
 * @see 		http://codeigniter.com/user_guide/libraries/uri.html
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_uri {

	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$keyval
		$page_query_string
		$query_string
		$reserved
		$rsegments
		$segments
		$session_id
		$uri_string
	 * ------------------------------------------------------------ */

	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}



	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */

	public function assoc_to_uri($array) {}
	public function rsegment($n, $no_result = FALSE) {}
	public function rsegment_array()
	public function ruri_string()
	public function ruri_to_assoc($n = 3, $default = array()) {}
	public function segment($n, $no_result = FALSE) {}
	public function segment_array()
	public function slash_rsegment($n, $where = 'trailing') {}
	public function slash_segment($n, $where = 'trailing') {}
	public function total_rsegments()
	public function total_segments()
	public function uri_string()
	public function uri_to_assoc($n = 3, $default = array()) {}

}


/* End of file		: testee_mock_uri.php */
/* File location	: third_party/testee/classes/testee_mock_uri.php */
