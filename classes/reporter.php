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
		parent::HtmlReporter();
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
		$class = ($this->getFailCount() + $this->getExceptionCount() > 0)
			? 'failure'
			: 'success';
			
		echo '<div class="' .$class .'">';
		echo '<p class="test_summary">';
		echo $this->getTestCaseProgress() .' of ' .$this->getTestCaseCount() .' test case(s) complete. ';
		echo '<span class="pass_summary">' .$this->getPassCount() .' passes</span>, ';
		echo '<span class="fail_summary">' .$this->getFailCount() .' fails</span>, and ';
		echo '<span class="exception_summary">' .$this->getExceptionCount() .' exceptions</span>.';
		echo '</p>';
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