<?php

/**
 * Mock database object. Overrides the EE DB object where required, to prevent
 * changes to the database during testing.
 *
 * @see 		http://codeigniter.com/user_guide/database/queries.html
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_db {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * The 'real' database, passed into the constructor.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_db;
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * The constructor.
	 *
	 * @access	public
	 * @param	object	$real_db	The 'real' database object.
	 * @return	void
	 */
	public function __construct($real_db)
	{
		$this->_db = $real_db;
	}
	
	
	/**
	 * Magic method. Delegates all non-defined methods to the 'real' database object.
	 *
	 * @access	public
	 * @param 	string		$method_name		The method that was called.
	 * @param 	array 		$arguments			The method arguments.
	 * @return 	mixed
	 */
	public function __call($method_name, $arguments)
	{
		if (method_exists($this->_db, $method_name))
		{
			return call_user_func_array(array($this->_db, $method_name), $arguments);
		}
	}
	
	
	/**
	 * Overrides the `count_all` method. 
	 *
	 * @access	public
	 * @param	string		$table			The table name.
	 * @return	int
	 */
	public function count_all($table) {}
	
	
	/**
	 * Overrides the `count_all_results` method.
	 *
	 * @access	public
	 * @param	string		$table			The table name.
	 * @return	void
	 */
	public function count_all_results($table) {}


	/**
	 * Overrides the `delete` method.
	 *
	 * @access	public
	 * @param	string			$table		The table name.
	 * @param	array|string	$where		The where clause.
	 * @return	void
	 */
	public function delete($table) {}


	/**
	 * Overrides the `empty_table` method.
	 *
	 * @access	public
	 * @param	string		$table			The table name.
	 * @return	void
	 */
	public function empty_table($table) {}


	/**
	 * Overrides the `get` method.
	 *
	 * @access	public
	 * @param	string		$table			The table name.
	 * @param	int			$limit			Limit to x records.
	 * @param	int			$offset			Offset to x records.
	 * @return	void
	 */
	public function get($table) {}


	/**
	 * Overrides the `get_where` method.
	 *
	 * @access	public
	 * @param	string		$table			The table name.
	 * @param	array		$where			The `where` clauses.
	 * @param	int			$limit			Limit to x records.
	 * @param	int			$offset			Offset by x records.
	 * @return	void
	 */
	public function get_where($table, $where, $limit, $offset) {}

	/**
	 * Overrides the `insert` method.
	 *
	 * @access	public
	 * @param 	string		$table			The table name.
	 * @param	array		$data			The data to insert.
	 * @return	void
	 */
	public function insert($table, $data) {}
	
	
	/**
	 * Overrides the `query` method.
	 *
	 * @access	public
	 * @param	string		$sql		The SQL to run.
	 * @return 	void
	 */
	public function query($sql) {}
	
	
	/**
	 * Overrides the `simple_query` method.
	 *
	 * @access	public
	 * @param	string	$sql	The SQL to run.
	 * @return	void
	 */
	public function simple_query($sql) {}
	

	/**
	 * Overrides the `truncate` method.
	 *
	 * @access	public
	 * @param	string		$table		The table name.
	 * @return	void
	 */
	public function truncate($table) {}


	/**
	 * Overrides the `update` method.
	 *
	 * @access	public
	 * @param	string			$table		The table name.
	 * @param	array			$data		The data to update.
	 * @param	array|string	$where		The where clause.
	 * @return	void
	 */
	public function update($table, $data, $where) {}

}

/* End of file		: Testee_db.php */
/* File location	: third_party/testee/classes/Testee_db.php */
