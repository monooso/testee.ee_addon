<?php

/**
 * Tests for the Testee_model class.
 *
 * @package			Testee
 * @author			Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright		Experience Internet
 */

require_once PATH_THIRD .'testee/models/testee_model' .EXT;

Mock::generatePartial(
	'Testee_db',
	'Mock_db',
	array('get')
);

class Test_testee_model extends Testee_unit_test_case {

	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */

	/**
	 * Runs before each test.
	 *
	 * @access	public
	 * @return	void
	 */
	public function setUp()
	{
		$this->_model = $this->_ee->load->model('testee_model');

		/**
		 * This would make much more sense in the constructor.
		 * 
		 * Unfortunately, that won't work, because SimpleTest
		 * needs to know which test is running when the mock
		 * object is created.
		 */

		$this->_ee->db =& new Mock_db($this);
		$this->_ee->db->setReturnReference('get', new stdClass());
		$this->_ee->db->__construct(parent::$_db);

	}



	/* --------------------------------------------------------------
	 * TEST METHODS
	 * ------------------------------------------------------------ */
	
	function test_get_package_name()
	{
		$this->assertEqual(
			strtolower($this->_ee->testee_model->get_package_name()),
			'testee'
		);
		
		$this->assertNotEqual(
			strtolower($this->_ee->testee_model->get_package_name()),
			'wibble'
		);
	}


	function test_get_package_version()
	{
		$this->assertPattern(
			'/^[0-9abcdehlprtv\.]+$/i',
			$this->_ee->testee_model->get_package_version()
		);
	}


	function test_get_simpletest_path()
	{
		$this->assertPattern(
			'/^[\/\-\._a-z0-9]+$/i',
			$this->_ee->testee_model->get_simpletest_path()
		);
	}


	function get_tests()
	{
		$this->assertIsA(
			$this->_ee->testee_model->get_tests(),
			'array'
		);

		$this->assertIsNotA(
			$this->_ee->testee_model->get_tests(),
			'string'
		);
	}


	function test_get_theme_url()
	{
		$this->assertPattern(
			'/^[a-z0-9:\/\.\-_]+$/i',
			$this->_ee->testee_model->get_theme_url()
		);
	}


	function test_install_module()
	{
		$this->assertIdentical(
			$this->_ee->testee_model->install_module(),
			TRUE
		);
	}


	function test_uninstall_module()
	{
		$this->assertIdentical(
			$this->_ee->testee_model->uninstall_module(),
			TRUE
		);
	}


	function test_update_module()
	{
		$this->assertIdentical(
			$this->_ee->testee_model->update_module($this->_ee->testee_model->get_package_version()),
			TRUE
		);

		$this->assertIdentical(
			$this->_ee->testee_model->update_module('wibble'),
			FALSE
		);
	}

}

/* End of file		: test_testee_model.php */
/* File location	: third_party/testee/tests/test_testee_model.php */
