<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/models/testee_model' .EXT;

class Test_testee_model extends UnitTestCase {
	
	private $_model;
	
	function setUp()
	{
		$this->_model = new Testee_model();
	}
	
	function tearDown()
	{
		// Do nothing.
	}
	
	function test_get_package_name()
	{
		$this->assertEqual($this->_model->get_package_name(), 'Testee');
	}
	
	function test_get_package_version()
	{
		$this->assertEqual($this->_model->get_package_version(), '0.1.0');
	}
	
}

?>