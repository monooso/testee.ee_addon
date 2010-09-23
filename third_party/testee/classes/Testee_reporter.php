<?php

/**
 * Test-driven add-on development test reporter.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/simpletest/scorer' .EXT;

class Testee_reporter extends SimpleReporter {
	
	/* --------------------------------------------------------------
	 * STATIC PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Test result types.
	 *
	 * @static
	 * @access	private
	 * @var		int
	 */
	private static $TEST_ERROR 		= 0;
	private static $TEST_EXCEPTION 	= 1;
	private static $TEST_FAIL 		= 2;
	private static $TEST_SKIP 		= 3;
	
	
	
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
		parent::SimpleReporter();
	}
	
	
	/**
	 * Paints a test error.
	 *
	 * @access	public
	 * @param	string		$message	Error message.
	 * @return	void
	 */
	public function paintError($message = '')
	{
		parent::paintError($message);
		$this->_paintTestResult(Testee_reporter::$TEST_ERROR, $message);
	}
	
	
	/**
	 * Paints a test exception.
	 *
	 * @access	public
	 * @param	Exception		$exception		The exception that occurred.
	 * @return	void
	 */
	public function paintException(Exception $exception)
	{
		parent::paintException($message);
		$this->_paintTestResult(Testee_reporter::$TEST_EXCEPTION, '', $exception);
	}
	
	
	/**
	 * Paints a test failure.
	 *
	 * @access	public
	 * @param	string		$message	Failure message.
	 * @return	void
	 */
	public function paintFail($message = '')
	{
		parent::paintFail($message);
		$this->_paintTestResult(Testee_reporter::$TEST_FAIL, $message);
	}
	
	
	/**
	 * Paints a 'skipped' test.
	 *
	 * @access	public
	 * @param	string	$message	Skip message.
	 * @return	void
	 */
	public function paintSkip($message = '')
	{
		parent::paintSkip($message);
		$this->_paintTestResult(Testee_reporter::$TEST_SKIP, $message);
	}
	
	
	/**
	 * Paints the report footer.
	 *
	 * @access	public
	 * @param	string		$test_name		The test name.
	 * @return	void
	 */
	public function paintFooter($test_name = '')
	{
		parent::paintFooter($test_name);
		
		echo '<div class="test_result_summary ';
		echo (($this->getFailCount() > 0 OR $this->getExceptionCount() > 0) ? 'test_result_failure' : 'test_result_success');
		echo '">';
		
		echo '<p>';
		echo $this->getTestCaseProgress() .' of ' .$this->getTestCaseCount();
		echo ($this->getTestCaseCount() === 1 ? ' test ' : ' tests ');
		echo 'completed. ';
		echo $this->getPassCount() .($this->getPassCount() === 1 ? ' pass' : ' passes') .', ';
		echo $this->getFailCount() .($this->getFailCount() === 1 ? ' fail' : ' fails') .', and ';
		echo $this->getExceptionCount() .($this->getExceptionCount() === 1 ? ' exception' : ' exceptions') .'.';
		echo '</p>';
		
		echo '</div>';
	}
	
	
	
	/* --------------------------------------------------------------
	 * PRIVATE METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Paints a test result.
	 *
	 * @access	private
	 * @param	int				$result_type	The result type. A Testee_reporter constant.
	 * @param	string			$message		The message to display.
	 * @param	Exception		$exception		Optional exception object. Only used by exceptions.
	 * @return	void
	 */
	private function _paintTestResult($result_type = -1, $message = '', Exception $exception = null)
	{
		switch ($result_type)
		{
			case Testee_reporter::$TEST_EXCEPTION:
				$class = 'test_exception';
				$badge_label = 'Exception';
				
				// Construct the message.
				if ($exception instanceof Exception)
				{
					$message = 'Unexpected exception of type [' .get_class($exception) .'] '
						.'with message [' .$exception->getMessage() .'] '
						.'in [' .$exception->getFile() .' line ' .$exception->getLine() .']';
				}
				
				break;
				
			case Testee_reporter::$TEST_FAIL:
				$class = 'test_fail';
				$badge_label = 'Fail';
				break;
				
			case Testee_reporter::$TEST_SKIP:
				$class = 'test_skip';
				$badge_label = 'Skipped';
				break;
				
			case Testee_reporter::$TEST_ERROR:
			default:
				$class = 'test_error';
				$badge_label = 'Error';
				break;
		}
		
		echo '<div class="test_result ' .$class .'">';
		echo '<span class="badge">' .$badge_label .'</span>';
		
		$breadcrumb = $this->getTestList();
		array_shift($breadcrumb);
		
		echo '<p class="test_result_details"><strong>Test:</strong>' .implode(' &rarr; ', $breadcrumb) .'</p>';
		echo '<p class="test_result_details"><strong>Message:</strong>' .htmlentities($message, ENT_COMPAT) .'</p>';
		
		echo '</div>';
	}
	
}

/* End of file		: testee_reporter.php */
/* File location	: third_party/testee/classes/testee_reporter.php */