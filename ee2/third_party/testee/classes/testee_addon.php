<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/classes/testee_base' .EXT;
require_once PATH_THIRD .'testee/classes/testee_test' .EXT;

class Testee_addon extends Testee_base {
	
	/* --------------------------------------------------------------
	 * PROTECTED PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Add-on name.
	 *
	 * @access	protected
	 * @var		string
	 */
	protected $_name = '';
	
	/**
	 * Add-on tests.
	 *
	 * @access	protected
	 * @var		array
	 */
	protected $_tests = array();
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @param 	array 		$props		An associative array of properties.
	 * @return	void
	 */
	public function __construct(Array $props = array())
	{
		parent::__construct($props);
	}
	
	
	/**
	 * Sets a private property, if it exists.
	 *
	 * @access	public
	 * @param	string		$prop_name		The property name.
	 * @param	string		$prop_value		The property value.
	 * @return	mixed
	 */
	public function __set($prop_name = '', $prop_value = '')
	{
		if ($prop_name != 'tests')
		{
			return parent::__set($prop_name, $prop_value);
		}
		
		/**
		 * We need to ensure that the tests are valid test objects.
		 */
		
		if ( ! is_array($prop_value))
		{
			$prop_value = array($prop_value);
		}
		
		foreach ($prop_value AS $test)
		{
			$this->add_test($test);
		}
			
		return $this->$prop_name;
	}
	
	
	/**
	 * Add test.
	 *
	 * @access	public
	 * @param	Testee_test		$test		The test to add.
	 * @return	array
	 */
	public function add_test(Testee_test $test)
	{
		$this->_tests[] = $test;
		return $this->_tests;
	}
	
	
	/**
	 * Clears the tests array.
	 *
	 * @access	public
	 * @return	void
	 */
	public function remove_all_tests()
	{
		$this->_tests = array();
	}
	
}

/* End of file		: testee_addon.php */
/* File location	: /system/expressionengine/third_party/testee/classes/testee_addon.php */