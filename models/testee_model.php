<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module model.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 * @version		0.1.0
 */

class Testee_model extends CI_Model {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * ExpressionEngine singleton.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_ee;
	
	/**
	 * Package name.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_package_name;
	
	/**
	 * Package version.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_package_version;
	
	

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
		parent::CI_Model();
		
		$this->_ee =& get_instance();
		
		$this->_package_name	= 'Testee';
		$this->_package_version = '0.1.0';
	}
	
	
	/**
	 * Returns the package name.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_package_name()
	{
		return $this->_package_name;
	}
	
	
	/**
	 * Returns the package version.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_package_version()
	{
		return $this->_package_version;
	}
	
	
	/**
	 * Returns an array of all the available tests. Testee assumes that
	 * each add-on will define its own tests, in a /third_party/add_on/tests/
	 * directory.
	 *
	 * @access	public
	 * @return	array
	 */
	public function get_tests()
	{
		/**
		 * @todo omit add-ons that are not installed.
		 */
		
		// Load the file helper.
		$this->_ee->load->helper('file');
		
		$tests	= array();
		
		// Retrieve the contents of the third-party add-ons directory.
		if ( ! $all_addons = get_filenames(PATH_THIRD))
		{
			return $tests;
		}
		
		foreach ($all_addons AS $addon)
		{
			$test_dir_path = PATH_THIRD .$addon .DIRECTORY_SEPARATOR .'tests';
			if ( ! $all_tests = get_filenames($test_dir_path))
			{
				continue;
			}
			
			/**
			 * We're only interested in files that match the following 'pattern':
			 * test_my_test_name.php
			 */
			
			foreach ($all_tests AS $test)
			{
				if ( ! preg_match('/^test_([^.]*)' .EXT .'$/i', $test))
				{
					continue;
				}
				
				$tests[] = array(
					'addon_name'	=> $addon,
					'test_name'		=> $test,
					'test_path'		=> $test_dir_path .DIRECTORY_SEPARATOR .$test
				);
			}
			
		}
		
		return $tests;
	}
	
}

/* End of file		: testee_model.php */
/* File location	: /system/expressionengine/third_party/testee/models/testee_model.php */