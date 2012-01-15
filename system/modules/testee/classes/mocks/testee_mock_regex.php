<?php

/**
 * Mock Regex class.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_regex {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
	 	$xss_hash;
		$never_allowed_str
		$never_allowed_regex
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function valid_email($address) {}
	public function valid_ip($ip) {}
	public function prep_url($str = '') {}
	public function prep_query_string($str) {}
	public function decode_qstr($str) {}
	public function form_prep($str = '', $strip = 0) {}
	public function encode_php_tags($str) {}
	public function encode_ee_tags($str, $convert_curly = FALSE) {}
	public function convert_quotes($str) {}
	public function xml_convert($str, $protect_all = FALSE) {}
	public function ascii_to_entities($str) {}
	public function entities_to_ascii($str, $all = TRUE) {}
	public function trim_slashes($str) {}
	public function remove_extra_commas($str) {}
	public function strip_quotes($str) {}
	public function keyword_clean($str) {}
	public function convert_dissallowed_chars($str) {}
	public function xss_protection_hash() {}
	public function xss_clean($str, $is_image = FALSE) {}
	public function create_url_title($str, $lowercase = FALSE) {}
	public function convert_accented_characters($match) {}
	public function unhtmlentities($str) {}
	public function array_stripslashes($vals) {}
	
	
	
	/* --------------------------------------------------------------
	 * "PRIVATE" METHODS
	 * --------------------------------------------------------------
	 * An underscore at the start of the method _should_ mark it as
	 * private, but EE seems to play pretty fast and loose with
	 * this rule, and doesn't enforce it.
	 * ------------------------------------------------------------ */
	public function _remove_invisible_characters($str) {}
	public function _compact_exploded_words($matches) {}
	public function _sanitize_naughty_html($matches) {}
	public function _js_link_removal($match) {}
	public function _js_img_removal($match) {}
	public function _filter_attributes($str) {}
	public function _convert_attribute($match) {}
	public function _html_entity_decode_callback($match) {}
	public function _html_entity_decode($str, $charset = 'ISO-8859-1')  {}
	
}


/* End of file		: testee_mock_regex.php */
/* File location	: third_party/testee/classes/mocks/testee_mock_regex.php */
