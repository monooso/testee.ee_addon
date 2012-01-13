<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * @author		  Stephen Lewis (http://github.com/experience/)
 * @copyright	  Experience Internet
 * @package		  Testee
 */

require_once PATH_THIRD .'testee/classes/testee_base.php';

class Testee_test extends Testee_base {
	
	protected $_file_name = '';
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


/* End of file		: testee_test.php */
/* File location	: third_party/testee/classes/testee_test.php */
