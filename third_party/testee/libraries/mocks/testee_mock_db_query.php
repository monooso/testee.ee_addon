<?php

/**
 * Mock database query result class.
 *
 * @see 		http://codeigniter.com/user_guide/database/results.html
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_db_query {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * @see http://codeigniter.com/user_guide/database/call_function.html
	 * --------------------------------------------------------------
		$result_id
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/results.html
	 * ------------------------------------------------------------ */
	public function free_result() {}
	public function num_fields() {}
	public function num_rows() {}
	public function result() {}
	public function result_array() {}
	public function row() {}
	public function row_array() {}
	
	public function first_row() {}
	public function last_row() {}
	public function next_row() {}
	public function previous_row() {}
	
}


/* End of file		: testee_mock_db_query.php */
/* File location	: third_party/testee/libraries/testee_mock_db_query.php */