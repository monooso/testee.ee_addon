<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/libraries/Testee_test' .EXT;

class Test_testee_test extends Testee_unit_test_case {
	
	private $_test;
	
	function setUp()
	{
		$this->_test = new Testee_test();
	}
	
	
	function tearDown()
	{
		// Do nothing.
	}
	
	
	function test_construct()
	{
		$test = new Testee_test(array(
			'file_name'	=> 'example_test.php',
			'file_path'	=> '/path/to/test/example_test.php'
		));
		
		$this->assertEqual($test->file_name, 'example_test.php');
		$this->assertEqual($test->file_path, '/path/to/test/example_test.php');
		$this->assertNotEqual($test->file_name, 'wibble');
		$this->assertNotEqual($test->file_path, 'wibble');
	}
	
	
	function test_set_file_name()
	{
		$this->_test->file_name = 'example_test.php';
		
		$this->assertEqual($this->_test->file_name, 'example_test.php');
		$this->assertNotEqual($this->_test->file_name, 'wibble');
	}
	
	
	function test_set_file_path()
	{
		$this->_test->file_path = '/path/to/test/example_test.php';
		
		$this->assertEqual($this->_test->file_path, '/path/to/test/example_test.php');
		$this->assertNotEqual($this->_test->file_path, 'wibble');
	}
}

?>