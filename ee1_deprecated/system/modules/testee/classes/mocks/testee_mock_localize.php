<?php

/**
 * Mock localize class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_localize {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$server_now
		$now
		$ctz
		$zones
		$cached
		$format
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function set_gmt() {}
	public function timestamp_to_gmt() {}
	public function set_localized_time() {}
	public function set_server_time() {}
	public function set_server_offset() {}
	public function set_localized_offset() {}
	public function set_human_time() {}
	public function convert_human_date_to_gmt() {}
	public function simpl_offset() {}		/* This is not a typo. Or at least it's not my typo. */
	public function offset_entry_dst() {}
	public function format_timespan() {}
	public function fetch_date_params() {}
	public function decode_date() {}
	public function localize_month() {}
	public function convert_timestamp() {}
	public function zone_offset() {}
	public function timezone_menu() {}
	public function zones() {}
	public function set_localized_timezone() {}
	public function fetch_days_in_month() {}
	public function adjust_date() {}
	
}


/* End of file		: testee_mock_localize.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_localize.php */