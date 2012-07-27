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
    $this->EE->lang->loadfile('testee');
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
      // HTTP status code 412: Precondition Failed.
      $json = array('code' => 412,
        'message' => $this->EE->lang->line('json_error__412'));

      $this->_output_json(json_encode($json), 412);
      return;
    }

    // Are these known tests?
    $all_tests = $this->EE->testee_model->get_tests();
    $bad_tests = array();
    $run_tests = array();

    foreach ($input_tests AS $input_test)
    {
      // Locate the requested test.
      foreach ($all_tests AS $addon)
      {
        if ($addon->name != $input_test)
        {
          continue;
        }

        // The add-on exists. Grab all the associated tests.
        foreach ($addon->tests AS $addon_test)
        {
          $run_tests[] = $addon_test->file_path;
        }

        continue 2;   // Move to the next input add-on.
      }

      // Make a note of any missing tests.
      $bad_tests[] = $input_test;
    }

    // Were there any unknown tests?
    if ($bad_tests)
    {
      // HTTP status code 404: Unknown Test(s).
      $json = array(
        'code'    => 404,
        'message' => $this->EE->lang->line('json_error__404_details')
          .implode('; ', $bad_tests)
      );

      $this->_output_json(json_encode($json, 404));
    }

    /**
     * It's possible, although highly unlikely, that we could have found an 
     * add-on's test suite, but no associated tests.
     */

    if ( ! $run_tests)
    {
      // HTTP status code 404: (Tests) Not Found.
      $json = array('code' => 404,
        'message' => $this->EE->lang->line('json_error__404_general'));

      $this->_output_json(json_encode($json), 404);
      return;
    }
    
    // Finally, we can run the tests.
    try
    {
      $json = $this->EE->testee_model->run_tests($run_tests,
        new Testee_json_reporter());
    }
    catch (Exception $e)
    {
      // HTTP status code 500: Internal Server Error.
      $json = array('code' => 500,
        'message' => $this->EE->lang->line('json_error__500'));

      $this->_output_json(json_encode($json), 500);
      return;
    }
    
    $this->_output_json($json);
  }



  /* --------------------------------------------------------------
   * PROTECTED METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Outputs the supplied JSON.
   *
   * @access  protected
   * @param   string    $json    The JSON content.
   * @param   int    $code    The HTTP response code.
   * @return  void
   */
  protected function _output_json($json, $code = 200)
  {
    set_status_header($code);
    @header('Content-type: application/json');
    exit($json);
  }
  

}


/* End of file		: mod.testee.php */
/* File location	: third_party/testee/mod.testee.php */
