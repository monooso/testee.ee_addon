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
	 * Returns the row count of the specified table.
	 *
	 * @access	public
	 * @param	string		$table_name		The table name.
	 * @return	int
	 */
	public function count_all($table_name = '')
	{
		return 0;
	}
	
	
	/**
	 * Overrides the `query` method.
	 *
	 * @access	public
	 * @param	string		$sql		The SQL to run.
	 * @return 	mixed
	 */
	public function query($sql = '')
	{
		error_log('The fools wish to run this SQL: ' .$sql);
		return TRUE;
	}
	
	
	/**
	 * Overrides the `simple_query` method.
	 *
	 * @access	public
	 * @param	string	$sql	The SQL to run.
	 * @return	bool
	 */
	public function simple_query($sql = '')
	{
		return TRUE;
	}
	
	/**
	 * count_all_results
	 * get
	 * get_where
	 * insert
	 * update
	 * delete
	 * empty_table
	 * truncate
	 */
	
	
}

/* End of file		: Testee_db.php */
/* File location	: third_party/testee/classes/Testee_db.php */