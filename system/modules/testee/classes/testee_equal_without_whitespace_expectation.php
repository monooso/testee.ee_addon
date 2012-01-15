<?php

/**
 * White-space agnostic custom expectation class.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_MOD .'testee/simpletest/expectation' .EXT;

class EqualWithoutWhitespaceExpectation extends EqualExpectation {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * The string to check.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_subject;
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @param 	string		$subject		The subject.
	 * @param	string		$message		Custom failure message.
	 * @return	void
	 */
	public function __construct($subject, $message = '%s')
	{
		$this->_subject = $subject;
		parent::__construct($subject, $message);
	}
	
	
	/**
	 * Tests the expectation.
	 *
	 * @access	public
	 * @param	string		$compare		The comparison string.
	 * @return	bool
	 */
	public function test($compare = '')
	{
		$search = '#\s#';
		$replace = '';
		
		return (preg_replace($search, $replace, $this->_subject) == preg_replace($search, $replace, $compare));
	}
	
	
	/**
	 * Returns a human-readable test message.
	 *
	 * @access	public
	 * @param	string	$compare	The comparison string.
	 * @return	string
	 */
	public function testMessage($compare = '')
	{
		return $this->test($compare)
			? 'Whitespace-agnostic equal expectation [' .$this->dumper->describeValue($this->_subject) .']'
			: 'Whitespace-agnostic equal expectation fails ' .$this->dumper->describeDifference($this->_subject, $compare);
	}
	
}

/* End of file		: testee_equal_without_whitespace_expectation.php */
/* File location	: system/modules/testee/classes/testee_equal_without_whitespace_expectation.php */