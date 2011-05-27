<?php

/**
 * Mock functions class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_functions {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$action_ids
		$cached_captcha
		$cached_index
	    $cached_url
	    $cached_path
		$catfields
	    $conditional_debug
		$file_paths
	    $seed
	    $template_map
	    $template_type
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function set_realpath($path) {}
	public function fetch_site_index($add_slash = 0, $sess_id = 1) {}
	public function create_url($segment, $trailing_slash = TRUE, $sess_id = 1) {}
	public function create_page_url($base_url, $segment, $trailing_slash = TRUE) {}
	public function fetch_current_uri() {}
	public function remove_double_slashes($str) {}
	public function remove_session_id($str) {}
	public function extract_path($str) {}
	public function var_swap($str, $data) {}
	public function redirect($location) {}
	public function bounce ($location) {}
	public function hash($str) {}
	public function random($type = 'encrypt', $len = 8) {}
	public function form_declaration($data) {}
	public function form_backtrack($offset = '') {}
	public function evaluate($str) {}
	public function encode_email($str) {}
	public function clear_spam_hashes() {}
	public function set_cookie($name = '', $value = '', $expire = '') {}
	public function char_limiter($str, $num = 500) {}
	public function word_limiter($str, $num = 100) {}
	public function fetch_email_template($name) {}
	public function encoding_menu($which, $name, $selected = '') {}
	public function create_directory_map($source_dir, $top_level_only = FALSE) {}
	public function render_map_as_select_options($zarray, $array_name = '') {}
	public function language_pack_names($default) {}
	public function clear_caching($which, $sub_dir = '', $relationships = FALSE) {}
	public function delete_directory($path, $del_root = FALSE) {}
	public function fetch_assigned_weblogs($all_sites = FALSE) {}
	public function fetch_assigned_template_group() {}
	public function log_search_terms($terms = '', $type = 'site') {}
	public function log_referrer() {}
	public function fetch_action_id($class, $method) {}
	public function insert_action_ids($str) {}
	public function compile_relationship($data, $parent_entry = TRUE, $reverse = FALSE) {}
	public function get_categories($cat_group, $entry_id) {}
	public function process_subcategories($parent_id) {}
	public function add_form_security_hash($str) {}
	public function remap_pm_urls() {}
	public function create_captcha($old_word = '') {}
	public function sql_andor_string($str, $field, $prefix = '', $null = FALSE) {}
	public function assign_conditional_variables($str, $slash = '/', $LD = '{', $RD = '}') {}
	public function assign_variables($str = '', $slash = SLASH) {}
	public function full_tag($str, $chunk = '', $open = '', $close = '') {}
	public function fetch_simple_conditions($str) {}
	public function fetch_data_variables($datestr) {}
	public function assign_parameters($str) {}
	public function prep_conditional($cond = '') {}
	public function reverse_key_sort($a, $b) {}
	public function prep_conditionals($str, $vars, $safety = 'n', $prefix = '') {}
	public function filename_security($str) {}
	public function fetch_file_paths() {}
	public function clone_object($object) {}
	
}


/* End of file		: testee_mock_functions.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_functions.php */