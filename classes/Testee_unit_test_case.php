<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/simpletest/unit_tester' .EXT;
require_once PATH_THIRD .'testee/classes/Testee_db' .EXT;
require_once PATH_THIRD .'testee/simpletest/mock_objects' .EXT;

class Testee_unit_test_case extends UnitTestCase {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * 'Proper' database.
	 *
	 * @static
	 * @access	protected
	 * @var		object
	 */
	protected static $_db;
	
	/**
	 * ExpressionEngine instance.
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $_ee;
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->_ee =& get_instance();
		
		if ( ! isset(self::$_db))
		{
			self::$_db = $this->_ee->db;
		}
	}
	
	
	/**
	 * Destructor.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __destruct()
	{
		$this->_ee->db = self::$_db;
	}
	
}

/* End of file		: Testee_unit_tester.php */
/* File location	: third_party/testee/classes/Testee_unit_tester.php */
