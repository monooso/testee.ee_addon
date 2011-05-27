<?php

/**
 * Mock session class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_session {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$user_session_len
		$cpan_session_len
		$c_session
		$c_uniqueid
		$c_password
		$c_expire
		$c_anon
		$c_prefix
		$sdata
		$userdata
		$tracker
		$flashdata
		$sess_crypt_key
		$validation_type
		$session_length
		$cookies_exist
		$session_exists
		$access_cp
		$gc_probability
		$cache
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}

    // The cache should always be an array.
    public $cache = array();
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function fetch_session_data() {}
	public function fetch_guest_data() {}
	public function fetch_member_data() {}
	public function update_session() {}
	public function create_new_session($member_id, $admin_session = FALSE) {}
	public function initialize_session() {}
	public function update_cookies() {}
	public function userdata($which) {}
	public function tracker() {}
	public function flashdata($key = '') {}
	public function set_flashdata($key, $val = '') {}
	public function ban_check($type = 'ip', $match = '') {}
	public function nation_ban_check($show_error = TRUE) {}
	public function delete_old_sessions() {}
	public function save_password_lockout($username = '') {}
	public function check_password_lockout($username = '') {}
	public function delete_password_lockout() {}
	
}

/* End of file		: testee_mock_session.php */
/* File location	: third_party/testee/classes/testee_mock_session.php */
