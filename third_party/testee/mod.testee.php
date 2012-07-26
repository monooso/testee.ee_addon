<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @author      Stephen Lewis
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once dirname(__FILE__) .'/classes/testee_json_reporter.php';

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
    $this->EE->load->model('testee_model');
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
    // Determine the tests to run.
    $input_tests = array_filter(
      explode('|', $this->EE->input->get_post('addon')));

    if ( ! $input_tests)
    {
      // @TODO : "no tests" JSON.
      exit('No tests specified');
      return;
    }

    // Are these known tests?
    $all_tests = $this->EE->testee_model->get_tests();
    $run_tests = array();

    foreach ($all_tests AS $addon)
    {
      if (in_array($addon->name, $input_tests))
      {
        foreach ($addon->tests AS $addon_test)
        {
          $run_tests[] = $addon_test->file_path;
        }

        unset($input_tests[$addon->name]);
      }
    }

    // Do we have anything to run?
    if ( ! $run_tests)
    {
      // @TODO : "no valid tests" JSON.
      exit('No valid tests');
      return;
    }
    
    // Run the tests.
    try
    {
      $json = $this->EE->testee_model->run_tests($run_tests,
        new Testee_json_reporter());
    }
    catch (Exception $e)
    {
      // @TODO : "error" JSON.
      $json = '';
    }
    
    @header('Content-Type: application/json');
    exit($json);
  }

	
}


/* End of file		: mod.testee.php */
/* File location	: third_party/testee/mod.testee.php */
