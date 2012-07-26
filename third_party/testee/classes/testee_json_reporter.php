<?php

/**
 * Outputs tests results in JSON format.
 *
 * @author    Stephen Lewis
 * @copyright Experience Internet
 * @package   Testee
 */

require_once dirname(__FILE__) .'/testee_reporter.php';

class Testee_json_reporter extends Testee_reporter {

  
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
  }


  /**
   * Outputs the test results gathered by the parent class.
   *
   * @access  public
   * @param   string  $test_name  The test name.
   * @return  void
   */
  public function paintFooter($test_name)
  {
    parent::paintFooter($test_name);

    $errors = $exceptions = $fails = $skips = array();

    // Process the test results.
    foreach ($this->_test_results AS $result)
    {
      // Sneaky. We pluralise the type to get the target array name.
      $target = $result->type .'s';

      // We can't use $$target[] = $result->to_array();
      array_push($$target, $result->to_array());
    }

    $failed = ($errors OR $exceptions OR $fails OR $skips);

    $result = array(
      'summary' => array(
        'result'          => $failed ? 'failed' : 'passed',
        'pass_count'      => $this->getPassCount(),
        'error_count'     => count($errors),
        'exception_count' => count($exceptions),
        'fail_count'      => count($fails),
        'skip_count'      => count($skips)
      ),
      'errors'     => $errors,
      'exceptions' => $exceptions,
      'fails'      => $fails,
      'skips'      => $skips
    );

    echo json_encode($result);
  }
  
  
}


/* End of file    : testee_json_reporter.php */
/* File location  : third_party/testee/classes/testee_json_reporter.php */
