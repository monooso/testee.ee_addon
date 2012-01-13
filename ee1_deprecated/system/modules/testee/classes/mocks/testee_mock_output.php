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
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$out_queue
		$out_type
		$refresh_msg
		$remove_unparsed_variables
		$resresh_time 		// No, really.
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function build_queue($output) {}
	public function http_status_header($code, $text = '') {}
	public function display_final_output($output = '') {}
	public function fatal_error($error_msg = '', $use_lang = TRUE) {}
	public function system_off_msg() {}
	public function show_message($data, $xhtml = TRUE) {}
	public function show_user_error($type = 'submission', $errors, $heading = '') {}
	
}


/* End of file		: testee_mock_output.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_output.php */