<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_test {
	
	/* --------------------------------------------------------------
	 * PROTECTED PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Test file name.
	 *
	 * @access	protected
	 * @var		string
	 */
	protected $_file_name = '';
	
	/**
	 * Test file path.
	 *
	 * @access	protected
	 * @var		string
	 */
	protected $_file_path = '';
	
	
	
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
		
		if (property_exists($this, $private_prop_name))
		{
			$this->$private_prop_name = $prop_value;
			return $this->$prop_name;
		}
		
		// Unknown property.
		return NULL;
	}
	
}

/* End of file		: Testee_test.php */
/* File location	: /system/expressionengine/third_party/testee/classes/Testee_test.php */