<?php

require_once BASEPATH .'simpletest/reporter' .EXT;

class Testee_reporter extends HtmlReporter {
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @param 	string		$character_set		The character set to use for the output.
	 * @return	void
	 */
	public function __construct($character_set = 'utf-8')
	{
		parent::HtmlReporter($character_set);
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
		echo '<div class="test_result">';
		echo '<div class="summary">';
		
		echo '<p>';
		echo $this->getTestCaseProgress() .' of ' .$this->getTestCaseCount() .' test(s) completed. ';
		echo '<span class="summary_pass">' .$this->getPassCount() .' passes</span>, ';
		echo '<span class="summary_fail">' .$this->getFailCount() .' fails</span>, and ';
		echo '<span class="summary_exception">' .$this->getExceptionCount() .' exceptions</span>.';
		echo '</p>';
		
		echo '</div>';
		echo '</div>';
	}
	
	
	/**
	 * Paints the report header.
	 *
	 * @access	public
	 * @param	string		$test_name		The test name.
	 * @return	void
	 */
	public function paintHeader($test_name = '')
	{
		// Does nothing.
	}
	
}

?>