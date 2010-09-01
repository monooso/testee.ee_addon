<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/simpletest/unit_tester' .EXT;
require_once PATH_THIRD .'testee/simpletest/mock_objects' .EXT;

require_once PATH_THIRD .'testee/libraries/mocks/Testee_mock_db' .EXT;
require_once PATH_THIRD .'testee/libraries/mocks/Testee_mock_db_query' .EXT;

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
		// Retrieve the EE superglobal. Sorry, Singleton. Ahem.
		$this->_ee =& get_instance();
		
		// Assign the 'real' database object to a static property.
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
	
	
	/**
	 * Get things ready for the test.
	 *
	 * @access	public
	 * @param	array		$mock_methods		Additional 'ad hoc' methods for the mock objects.
	 *											e.g. array('db' => array('new_method_a', 'new_method_b'));
	 * @return	void
	 */
	public function setUp(Array $mock_methods = array())
	{
		/**
		 * Create the mock objects.
		 */
		
		// Used to avoid 'redeclared class' errors when generating mock object classes.
		$class_prefix = get_class($this);
		
		// Database.
		$methods = isset($mock_methods['db']) && is_array($mock_methods['db'])
			? $mock_methods['db']
			: array();
			
		Mock::generate('Testee_mock_db', $class_prefix .'_mock_db', $methods);
		
		// Query result.
		$methods = isset($mock_methods['query']) && is_array($mock_methods['query'])
			? $mock_methods['query']
			: array();
			
		Mock::generate('Testee_mock_db_query', $class_prefix .'_mock_query', $methods);
		
		// Assign the mock database object to the EE superglobal.
		$this->_ee->db = $this->_get_mock('db');
	}
	
	
	
	/* --------------------------------------------------------------
	 * PRIVATE & PROTECTED METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Returns a mock object of the specified type.
	 *
	 * @access	protected
	 * @param	string		$class		The class of mock object to return (e.g. 'db', or 'query').
	 * @return	bool|object
	 */
	protected function _get_mock($class = '')
	{
		$class_name = get_class($this) .'_mock_' .$class;
		
		if (class_exists($class_name))
		{
			return new $class_name();
		}
		
		return FALSE;
	}
	
}

/* End of file		: Testee_unit_tester.php */
/* File location	: third_party/testee/libraries/Testee_unit_tester.php */
