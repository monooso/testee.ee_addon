<?php

/**
 * Mock database class. Just an interface, really.
 *
 * @see 		http://codeigniter.com/user_guide/database/index.html
 * @see			http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 	Testee
 * @author 		Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mock_db {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * @see http://codeigniter.com/user_guide/database/call_function.html
	 * --------------------------------------------------------------
		$conn_id
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/queries.html
	 * ------------------------------------------------------------ */
	public function escape() {}
	public function escape_like_str() {}
	public function escape_str() {}
	public function query() {}
	public function simple_query() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/helpers.html
	 * ------------------------------------------------------------ */
	public function affected_rows() {}
	public function count_all() {}
	public function insert_id() {}
	public function insert_string() {}
	public function last_query() {}
	public function platform() {}
	public function update_string() {}
	public function version() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/active_record.html
	 *
	 * Note: count_all is already declared above.
	 * ------------------------------------------------------------ */
	public function count_all_results() {}
	public function delete() {}
	
	public function empty_table() {}
	public function flush_cache() {}
	public function get() {}
	public function get_where() {}
	public function insert() {}
	public function start_cache() {}
	public function stop_cache() {}
	public function truncate() {}
	public function update() {}	
	
	public function distinct() {}
	public function from() {}
	public function group_by() {}
	public function having() {}
	public function join() {}
	public function like() {}
	public function limit() {}
	public function not_like() {}
	public function or_having() {}
	public function or_like() {}
	public function or_not_like() {}
	public function or_where() {}
	public function or_where_in() {}
	public function or_where_not_in() {}
	public function order_by() {}
	public function select() {}
	public function select_avg() {}
	public function select_max() {}
	public function select_min() {}
	public function select_sum() {}
	public function set() {}
	public function where() {}
	public function where_in() {}
	public function where_not_in() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/table_data.html
	 * ------------------------------------------------------------ */
	public function list_tables() {}
	public function table_exists() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/fields.html
	 * ------------------------------------------------------------ */
	public function field_data() {}
	public function field_exists() {}
	public function list_fields() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/call_function.html
	 * ------------------------------------------------------------ */
	public function call_function() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/caching.html
	 * ------------------------------------------------------------ */
	public function cache_delete() {}
	public function cache_delete_all() {}
	public function cache_off() {}
	public function cache_on() {}
	public function close() {}
	
	
	/* --------------------------------------------------------------
	 * @see http://codeigniter.com/user_guide/database/transactions.html
	 * ------------------------------------------------------------ */
	public function trans_begin() {}
	public function trans_commit() {}
	public function trans_complete() {}
	public function trans_rollback() {}
	public function trans_start() {}
	public function trans_status() {}
	public function trans_strict() {}
	
}


/* End of file		: testee_mock_db.php */
/* File location	: third_party/testee/classes/testee_mock_db.php */