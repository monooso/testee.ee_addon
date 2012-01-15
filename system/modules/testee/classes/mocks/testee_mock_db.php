<?php

/**
 * Mock database class. Just an interface, really.
 *
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_db {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
	 	$cache_dir
		$conntype
		$database
		$debug
		$enable_cache
		$error_footer
		$error_header
		$hostname
		$password
		$prefix
		$username
		
	 * --------------------------------------------------------------
 	 * SUPPOSEDLY PRIVATE PROPERTIES
	 * --------------------------------------------------------------
	 * The EE database class claims these are "private" properties,
	 * even though they can't be declared as such because of PHP4
	 * compatibility.
	 *
	 * However, this is horse shit. EE itself regularly accesses these
	 * "private" properties willy-nilly, and at least two are actually
	 * documented as being publicly accessible.
	 *
	 * Go encapsulation!
	 * --------------------------------------------------------------
		$affected_rows;
		$conn_id;
		$cache_enabled;
		$cache_file;
		$cache_path;
		$exp_prefix;
		$fetch_fields;
		$field_names;
		$insert_id;
		$q_count;
		$query_id;
		$queries;
		$server_info;
		$show_queries;
		$sql_table;
		$tables_list;
	 
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function db_close() {}
	public function db_connect() {}
	public function db_error() {}
	public function delete_cache() {}
	public function delete_directory() {}		// WTF? How is this database related?
	public function enable_cache() {}
	public function escape_like_str() {}
	public function escape_str() {}
	public function fetch_tables() {}
	public function get_cache() {}
	public function insert_string() {}
	public function query() {}
	public function reconnect() {}
	public function select_db() {}
	public function store_cache() {}
	public function table_exists() {}
	public function update_string() {}
	
}


/* End of file		: testee_mock_db.php */
/* File location	: third_party/testee/classes/mocks/testee_mock_db.php */