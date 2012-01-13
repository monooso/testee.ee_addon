<?php

/**
 * Mock template class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_template {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$loop_count
		$depth
		$in_point
		$template
		$final_template
		$fl_tmpl
		$cache_hash
		$cache_status
		$cache_timestamp
		$template_type
		$embed_type
		$template_hits
		$php_parse_location
		$template_edit_date
		$encode_email
		$hit_lock_override
		$hit_lock
		$parse_php
		$protect_javascript
		$templates_sofar
		$tag_data
		$modules
		$module_data
		$plugins
		$native_modules
		$var_single
		$var_cond
		$var_pair
		$global_vars
		$embed_vars
		$segment_vars
		$tagparts
		$tagdata
		$tagproper
		$no_results
		$no_results_block
		$search_fields
		$related_data
		$related_id
		$related_markers
		$site_ids
		$sites
		$site_prefs_cache
		$reverse_related_data
		$t_cache_path
		$p_cache_path
		$disable_caching
		$debugging
		$cease_processing
		$log
		$start_microtime
		$strict_urls
		$realm
		$marker
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function run_template_engine($template_group = '', $template = '') {}
	public function process_template($template_group = '', $template = '', $sub = FALSE, $site_id = '') {}
	public function process_sub_templates($template) {}
	public function parse_template() {}
	public function class_handler() {}
	public function assign_relationship_data($chunk) {}
	public function assign_class($tag) {}
	public function fetch_param($which) {}
	public function swap_var_single($search, $replace, $source) {}
	public function swap_var_pairs($open, $close, $source) {}
	public function delete_var_pairs($open, $close, $source) {}
	public function swap_conditional($search, $replace, $source) {}
	public function fetch_data_between_var_pairs($str, $variable) {}
	public function parse_template_php($str) {}
	public function replace_marker($i, $return_data) {}
	public function cache_status($cfile, $args, $cache_type = 'tag') {}
	public function get_cache_file($cfile, $cache_type = 'tag') {}
	public function write_cache_file($cfile, $data, $cache_type = 'tag') {}
	public function parse_template_uri() {}
	public function _404() {}	// Not sure if this is supposed to be public.
	public function fetch_template($template_group, $template, $show_default = TRUE, $site_id = '') {}
	public function no_results() {}
	public function convert_xml_declaration($str) {}
	public function restore_xml_declaration($str) {}
	public function remove_ee_comments($str) {}
	public function fetch_modules() {}
	public function fetch_plugins() {}
	public function parse_globals($str) {}
	public function parse_nocache($str) {}
	public function advanced_conditionals($str) {}
	public function segment_conditionals($str) {}
	public function global_vars_conditionals($str) {}
	public function array_conditionals($str, $vars = array()) {}
	public function log_item($str) {}
	public function template_authentication_basic() {}
	public function template_authentication_digest() {}
	public function template_authentication_check_digest($not_allowed_groups = array()) {}
	public function template_authentication_check_basic($not_allowed_groups = array()) {}
	
}


/* End of file		: testee_mock_template.php */
/* File location	: system/modules/testee/classes/mocks/testee_mock_template.php */