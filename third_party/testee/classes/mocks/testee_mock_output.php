<?php

/**
 * Mock output class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_output {
	
	/* --------------------------------------------------------------
	 * PUBLIC CODEIGNITER PROPERTIES
	 * --------------------------------------------------------------
		$final_output;
		$cache_expiration
		$headers
		$enable_profiler
		$parse_exec_vars
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE PROPERTIES
	 * --------------------------------------------------------------
		$out_type
		$refresh_msg
		$refresh_time
		$remove_unparsed_variables
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC CODEIGNITER METHODS
	 * ------------------------------------------------------------ */
	public function get_output() {}
	public function set_output($output) {}
	public function append_output($output) {}
	public function set_status_header($code = 200, $text = '') {}
	public function enable_profiler($val = TRUE) {}
	public function set_profiler_sections($sections) {}
	public function cache($time) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC EXPRESSIONENGINE METHODS
	 * ------------------------------------------------------------ */
	public function set_header($header, $replace = TRUE) {}
	public function fatal_error($error_msg = '', $use_lang = TRUE) {}
	public function system_off_msg() {}
	public function show_message($data, $xhtml = TRUE) {}
	public function show_user_error($type = 'submission', $errors, $heading = '') {}
	public function send_ajax_response($msg, $error = FALSE) {}
	
}

/* End of file		: testee_mock_output.php */
/* File location	: third_party/testee/classes/testee_mock_output.php */