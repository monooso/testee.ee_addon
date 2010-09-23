<?php

/**
 * Mock loader class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @see			http://codeigniter.com/user_guide/libraries/loader.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_loader {
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function library($library = '', $params = NULL, $object_name = NULL) {}
	public function model($model, $name = '', $db_conn = FALSE) {}
	public function database($params = '', $return = FALSE, $active_record = NULL) {}
	public function dbutil() {}
	public function dbforge() {}
	public function view($view, $vars = array(), $return = FALSE) {}
	public function file($path, $return = FALSE) {}
	public function vars($vars = array(), $val = '') {}
	public function helper($helpers = array()) {}
	public function helpers($helpers = array()) {}
	public function language($file = array(), $lang = '') {}
	public function config($file = '', $use_sections = FALSE, $fail_gracefully = FALSE) {}
	public function driver($library = '', $params = NULL, $object_name = NULL) {}
	public function add_package_path($path) {}
	public function remove_package_path($path = '', $remove_config_path = TRUE) {}
	
}

/* End of file		: testee_mock_loader.php */
/* File location	: third_party/testee/classes/testee_mock_loader.php */