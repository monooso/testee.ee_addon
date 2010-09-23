<?php

/**
 * Base Testee unit test case.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/simpletest/unit_tester' .EXT;
require_once PATH_THIRD .'testee/simpletest/mock_objects' .EXT;

require_once PATH_THIRD .'testee/libraries/mocks/testee_mock_db' .EXT;
require_once PATH_THIRD .'testee/libraries/mocks/testee_mock_db_query' .EXT;
require_once PATH_THIRD .'testee/libraries/mocks/testee_mock_lang' .EXT;

class Testee_unit_test_case extends UnitTestCase {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
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
		
		// Language.
		$methods = isset($mock_methods['lang']) && is_array($mock_methods['lang'])
			? $mock_methods['lang']
			: array();
			
		Mock::generate('Testee_mock_lang', $class_prefix .'_mock_lang', $methods);
		
		// Assign the mock database object to the EE superglobal.
		$this->_ee->db 		= $this->_get_mock('db');
		$this->_ee->lang 	= $this->_get_mock('lang');
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

/* End of file		: testee_unit_test_case.php */
/* File location	: third_party/testee/libraries/testee_unit_test_case.php */
