<?php

/**
 * Tests for the Testee_model class.
 *
 * @package			Testee
 * @author			Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright		Experience Internet
 */

require_once PATH_THIRD .'testee/models/testee_model' .EXT;

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
		parent::setUp();
		$this->_model = new Testee_model();
	}



	/* --------------------------------------------------------------
	 * TEST METHODS
	 * ------------------------------------------------------------ */
	
	function test_get_package_name()
	{
		$this->assertEqual(
			strtolower($this->_model->get_package_name()),
			'testee'
		);
		
		$this->assertNotEqual(
			strtolower($this->_model->get_package_name()),
			'wibble'
		);
	}


	function test_get_package_version()
	{
		$this->assertPattern(
			'/^[0-9abcdehlprtv\.]+$/i',
			$this->_model->get_package_version()
		);
	}


	function get_tests()
	{
		$this->assertIsA(
			$this->_model->get_tests(),
			'array'
		);

		$this->assertIsNotA(
			$this->_model->get_tests(),
			'string'
		);
	}


	function test_get_theme_url()
	{
		$this->_ee->config->expectOnce('item', array('theme_folder_url'));
		$this->_ee->config->setReturnValue('item', 'path/to/themes/', array('theme_folder_url'));
		
		$this->assertPattern(
			'#^path/to/themes/third_party/[a-z\-_]+/$#i',
			$this->_model->get_theme_url()
		);
	}


	function test_install_module()
	{
		$db = $this->_ee->db;
		
		$db->expectOnce('insert', array('modules', array(
			'has_cp_backend'		=> 'y',
			'has_publish_fields'	=> 'n',
			'module_name'			=> $this->_model->get_package_name(),
			'module_version'		=> $this->_model->get_package_version()
		)));
		
		$this->assertIdentical(
			$this->_model->install_module(),
			TRUE
		);
	}


	function test_uninstall_module()
	{
		// Shortcuts.
		$db = $this->_ee->db;
		
		// Mock query row.
		$result_row = new StdClass();
		$result_row->module_id = 'test';
		
		// Mock query object.
		$module_result =& $this->_get_mock('db_query');
		$module_result->expectOnce('row');
		$module_result->setReturnReference('row', $result_row);
		
		// $db->select
		$db->setReturnReference('select', $db);
		
		// $db->get_where
		$db->expectOnce('get_where', array('modules', array('module_name' => $this->_model->get_package_name())));
		$db->setReturnReference('get_where', $module_result);
		
		// $db->delete
		$db->expectCallCount('delete', 2);
		$db->expectAt(0, 'delete', array('module_member_groups', array('module_id' => $result_row->module_id)));
		$db->expectAt(1, 'delete', array('modules', array('module_name' => $this->_model->get_package_name())));
		
		// Run.
		$this->assertIdentical(
			$this->_model->uninstall_module(),
			TRUE
		);
	}


	function test_update_module()
	{
		$this->assertIdentical(
			$this->_model->update_module($this->_model->get_package_version()),
			TRUE
		);

		$this->assertIdentical(
			$this->_model->update_module('wibble'),
			FALSE
		);
	}

}

/* End of file		: test_testee_model.php */
/* File location	: third_party/testee/tests/test_testee_model.php */
