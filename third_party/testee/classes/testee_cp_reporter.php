<?php

/**
 * Outputs the results of a Testee test suite to the EE CP.
 *
 * @author    Stephen Lewis
 * @copyright Experience Internet
 * @package   Testee
 */

require_once dirname(__FILE__) .'/testee_reporter.php';

class Testee_cp_reporter extends Testee_reporter {
  

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
   * @param   string    $test_name    The test name.
   * @return  void
   */
  public function paintFooter($test_name = '')
  {
    parent::paintFooter($test_name);

    // Output the individual test results.
    foreach ($this->_test_results AS $result)
    {
      switch ($result->type)
      {
        case Testee_test_result::TYPE_ERROR:
          $class = 'test_error';
          $label = 'Error';
          break;
          
        case Testee_test_result::TYPE_EXCEPTION:
          $class = 'test_exception';
          $label = 'Exception';
          break;
          
        case Testee_test_result::TYPE_FAIL:
          $class = 'test_fail';
          $label = 'Fail';
          break;
          
        case Testee_test_result::TYPE_SKIP:
          $class = 'test_skip';
          $label = 'Skipped';
          break;

        default:
          continue;
      }

      echo '<div class="test_result ' .$class .'">'
        .'<span class="badge">' .$label .'</span>'
        .'<p class="test_result_details"><strong>Test:</strong>'
        .implode(' &rarr; ', $result->breadcrumb)
        .'</p>'
        .'<p class="test_result_details"><strong>Message:</strong>'
        .htmlentities($result->message, ENT_COMPAT)
        .'</p>'
        .'</div>';
    }

    // Output the summary.
    $summary_class = ($this->getFailCount() + $this->getExceptionCount())
      ? 'test_result_failure' : 'test_result_success';

    echo '<div class="test_result_summary ' .$summary_class .'">';
    echo '<p>';

    echo $this->getTestCaseProgress() .' of ' .$this->getTestCaseCount();
    echo ($this->getTestCaseCount() === 1 ? ' test ' : ' tests ');
    echo 'completed. ';

    echo $this->getPassCount()
      .($this->getPassCount() === 1 ? ' pass' : ' passes') .', ';

    echo $this->getFailCount()
      .($this->getFailCount() === 1 ? ' fail' : ' fails') .', and ';

    echo $this->getExceptionCount()
      .($this->getExceptionCount() === 1 ? ' exception' : ' exceptions') .'.';

    echo '</p>';
    echo '</div>';
  }
  

}


/* End of file    : testee_reporter.php */
/* File location  : third_party/testee/classes/testee_reporter.php */
