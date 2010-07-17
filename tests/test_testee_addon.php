<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/classes/Testee_addon' .EXT;

class Test_testee_addon extends UnitTestCase {
	
	private $_addon;
	
	function setUp()
	{
		$this->_addon = new Testee_addon();
	}
	
	
	function tearDown()
	{
		// Do nothing.
	}
	
	
	function test_construct()
	{
		$addon = new Testee_addon(array(
			'name'	=> 'Test Addon',
			'tests'	=> array(new Testee_test())
		));
		
		$this->assertTrue($addon->name = 'Test Addon');
		$this->assertEqual(count($addon->tests), 1);
		$this->assertNotEqual(count($addon->tests), 0);
	}
	
	
	function test_add_test()
	{
		$test = new Testee_test();
		
		$this->_addon->add_test($test);
		
		$this->assertEqual(count($this->_addon->tests), 1);
		$this->assertNotEqual(count($this->_addon->tests), 0);
	}
	
	
	function test_set_name()
	{
		$this->_addon->name = 'Test Addon';
		$this->assertEqual($this->_addon->name, 'Test Addon');
		$this->assertNotEqual($this->_addon->name, 'Wibble');
	}
	
	
	function test_set_tests()
	{
		$test = new Testee_test();
		
		$this->_addon->tests = array($test, $test, $test);
		$this->assertEqual(count($this->_addon->tests), 3);
		$this->assertNotEqual(count($this->_addon->tests), 1);
	}
}

?>