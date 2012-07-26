<?php

/**
 * Records the results of a Testee test suite.
 *
 * @author    Stephen Lewis
 * @copyright Experience Internet
 * @package   Testee
 */

require_once dirname(__FILE__) .'/../simpletest/scorer.php';
require_once dirname(__FILE__) .'/testee_test_result.php';

class Testee_reporter extends SimpleReporter {

  protected $_test_results;
  

  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Constructor.
   *
   * @access  public
   * @return  void
   */
  public function __construct()
  {
    parent::__construct();
    $this->_test_results = array();
  }
  
  
  /**
   * Logs a test error.
   *
   * @access  public
   * @param   string    $message  Error message.
   * @return  void
   */
  public function paintError($message = '')
  {
    parent::paintError($message);
    $this->_logTestResult(Testee_test_result::TYPE_ERROR, $message);
  }
  
  
  /**
   * Logs a test exception.
   *
   * @access  public
   * @param   Exception   $e  The exception that occurred.
   * @return  void
   */
  public function paintException(Exception $e)
  {
    parent::paintException($e);

    // Construct the message.
    $message = 'Unexpected exception of type [' .get_class($e) .']'
      .' with message [' .$e->getMessage() .']'
      .' in [' .$e->getFile() .' line ' .$e->getLine() .']';

    // Log it.
    $this->_logTestResult(Testee_test_result::TYPE_EXCEPTION, $message);
  }
  
  
  /**
   * Logs a test failure.
   *
   * @access  public
   * @param   string    $message  Failure message.
   * @return  void
   */
  public function paintFail($message = '')
  {
    parent::paintFail($message);
    $this->_logTestResult(Testee_test_result::TYPE_FAIL, $message);
  }
  
  
  /**
   * Logs a 'skipped' test.
   *
   * @access  public
   * @param   string  $message  Skip message.
   * @return  void
   */
  public function paintSkip($message = '')
  {
    parent::paintSkip($message);
    $this->_logTestResult(Testee_test_result::TYPE_SKIP, $message);
  }
  
  
  /**
   * Paints the report footer.
   *
   * @access  public
   * @param string    $test_name    The test name.
   * @return  void
   */
  public function paintFooter($test_name = '')
  {
    parent::paintFooter($test_name);
  }
  
  
  
  /* --------------------------------------------------------------
   * PROTECTED METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Logs a test result.
   *
   * @access  protected
   * @param   string    $type       The result type.
   * @param   string    $message    The message to display.
   * @return  void
   */
  protected function _logTestResult($type, $message)
  {
    $breadcrumb = $this->getTestList();
    array_shift($breadcrumb);

    $this->_test_results[] = new Testee_test_result(array(
      'breadcrumb' => $breadcrumb,
      'message'    => $message,
      'type'       => $type
    ));
  }

  
}


/* End of file    : testee_reporter.php */
/* File location  : third_party/testee/classes/testee_reporter.php */
