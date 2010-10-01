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

require_once PATH_THIRD .'testee/classes/mocks/testee_mock_config' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_db' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_db_query' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_dbforge' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_dbutil' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_extensions' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_functions' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_input' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_lang' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_loader' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_output' .EXT;
require_once PATH_THIRD .'testee/classes/mocks/testee_mock_session' .EXT;

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
	
	/**
	 * Methods to return $this->db from in the 
	 * database mock (for EE compat)
	 *
	 * @var string
	 */
	protected $_db_chaining_methods = array(
		'distinct', 'from', 'group_by', 'having', 'join', 'like', 'limit', 'not_like', 'or_having', 'or_like', 'or_not_like', 'or_where', 'or_where_in', 'or_where_not_in', 'order_by', 'select', 'select_avg', 'select_max', 'select_min', 'select_sum', 'set', 'where', 'where_in', 'where_not_in'
	);
	
	
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
		 * Create the mock objects. A class prefix is used to avoid 'redeclared class'
		 * errors when generating mock object classes.
		 */
		
		$class_prefix = get_class($this);
		
		$mocks = array(
			'config',
			'db',
			'db_query',
			'dbforge',
			'dbutil',
			'extensions',
			'functions',
			'input',
			'lang',
			'loader',
			'output',
			'session'
		);
		
		foreach ($mocks AS $mock)
		{
			$methods = isset($mock_methods[$mock]) && is_array($mock_methods[$mock])
				? $mock_methods[$mock]
				: array();

			Mock::generate('Testee_mock_' .$mock, $class_prefix .'_mock_' .$mock, $methods);
		}
		
		// Assign the mock objects to the EE superglobal.
		$this->_ee->config		= $this->_get_mock('config');
		$this->_ee->db 			= $this->_get_mock('db');
		$this->_ee->dbforge 	= $this->_get_mock('dbforge');
		$this->_ee->extensions	= $this->_get_mock('extensions');
		$this->_ee->functions	= $this->_get_mock('functions');
		$this->_ee->input 		= $this->_get_mock('input');
		$this->_ee->lang 		= $this->_get_mock('lang');
		$this->_ee->load		= $this->_get_mock('loader');
		$this->_ee->output 		= $this->_get_mock('output');
		$this->_ee->session		= $this->_get_mock('session');
		
		// EE compatibility layer
		$this->_set_ee_mock_methods();
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
	
	/**
	 * Set EE compatibility mock methods
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	protected function _set_ee_mock_methods() {
		foreach ($this->_db_chaining_methods as $method) {
			$this->_ee->db->setReturnValue($method, $this->_ee->db);
		}
	}
	
}

/* End of file		: testee_unit_test_case.php */
/* File location	: third_party/testee/classes/testee_unit_test_case.php */