<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/classes/Testee_test' .EXT;

class Testee_addon {
	
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
		foreach ($props AS $id => $val)
		{
			$this->$id = $val;
		}
	}
	
	
	/**
	 * Retrieves a private property, if it exists.
	 *
	 * @access	public
	 * @param	string		$prop_name		The property name.
	 * @return	void
	 */
	public function __get($prop_name = '')
	{
		$private_prop_name = '_' .$prop_name;
		
		return property_exists($this, $private_prop_name)
			? $this->$private_prop_name
			: NULL;
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
		$private_prop_name = '_' .$prop_name;
		
		// We need to ensure that the tests are valid test objects.
		if ($private_prop_name == '_tests')
		{
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
		
		// Everything else.
		if (property_exists($this, $private_prop_name))
		{
			$this->$private_prop_name = $prop_value;
			return $this->$prop_name;
		}
		
		// Unknown property.
		return NULL;
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

/* End of file		: Testee_addon.php */
/* File location	: /system/expressionengine/third_party/testee/classes/Testee_addon.php */