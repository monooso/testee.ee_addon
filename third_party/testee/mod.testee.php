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
      // HTTP status code 404: (Tests) Not Found.
      $json = array('code' => 404,
        'message' => $this->EE->lang->line('json_error__404'));

      $this->_output_json(json_encode($json), 404);
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
