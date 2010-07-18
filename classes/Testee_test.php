<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/classes/Testee_base' .EXT;

class Testee_test extends Testee_base {
	
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
		parent::__construct($props);
	}
	
}

/* End of file		: Testee_test.php */
/* File location	: /system/expressionengine/third_party/testee/classes/Testee_test.php */