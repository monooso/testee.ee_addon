<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

class Testee {

  private $EE;


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
    $this->EE =& get_instance();
	}


  /**
   * Handles the 'run_tests' ACTion. Runs all of the available tests for the 
   * specified add-on, and outputs the results in JSON format.
   *
   * @access  public
   * @return  void
   */
  public function run_tests()
  {
    
  }

	
}


/* End of file		: mod.testee.php */
/* File location	: third_party/testee/mod.testee.php */
