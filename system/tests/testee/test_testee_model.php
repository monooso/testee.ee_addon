<?php

/**
 * Tests for the Testee_model class.
 *
 * @package			Testee
 * @author			Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright		Experience Internet
 */

require_once PATH_MOD .'testee/models/testee_model' .EXT;

class Test_testee_model extends Testee_unit_test_case {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Model.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_model;
	
	
	
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
		global $PREFS;
		
		$PREFS->expectOnce('ini', array('theme_folder_url'));
		$PREFS->setReturnValue('ini', 'path/to/themes/', array('theme_folder_url'));
		
		$this->assertPattern(
			'#^path/to/themes/cp_themes/default/[a-z\-_]+/$#i',
			$this->_model->get_theme_url()
		);
	}
	
	
	function test_install_module()
	{
		global $DB;
		
		$DB->expectOnce('insert_string', array('exp_modules', array(
			'has_cp_backend'	=> 'y',
			'module_id'			=> '',
			'module_name'		=> $this->_model->get_package_name(),
			'module_version'	=> $this->_model->get_package_version()
		)));
		
		$DB->expectOnce('query');
		
		$this->assertIdentical(
			$this->_model->install_module(),
			TRUE
		);
	}
	
	
	function test_uninstall_module()
	{
		global $DB;
		
		/**
		 * NOTE:
		 * Whitespace is important in the expectAt methods.
		 *
		 * Unfortunately, this means that the actual queries
		 * must be formatted identically to the expectAt tests
		 * for the tests to pass.
		 *
		 * Far from ideal, and makes for some pretty brittle tests,
		 * but I haven't found a solution to this yet.
		 */
		
		// Mock query row.
		$result_row = array('module_id' => 'test');
		
		// Mock query object.
		$module_result =& $this->_get_mock('db_cache');
		$module_result->setReturnValue('__get', '1', array('num_rows'));
		$module_result->setReturnReference('__get', $result_row, array('row'));
		
		// Expecting 3 calls to the 'query' method.
		$DB->expectCallCount('query', 3);
		
		// Retrieve the module ID.
		$DB->expectAt(0, 'query', array("SELECT module_id
			FROM exp_modules
			WHERE module_name = '{$this->_model->get_package_name()}'"));
			
		$DB->setReturnReferenceAt(0, 'query', $module_result);
		
		// Delete records from the exp_module_member_groups table.
		$DB->expectAt(1, 'query', array("DELETE FROM exp_module_member_groups
			WHERE module_id = '{$result_row['module_id']}'"));
		
		// Delete records from the exp_modules table.
		$DB->expectAt(2, 'query', array("DELETE FROM exp_modules
			WHERE module_name = '{$this->_model->get_package_name()}'"));
		
		// Run.
		$this->assertIdentical($this->_model->uninstall_module(), TRUE);
	}


	function test_update_module()
	{
		$model =& $this->_model;
		
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
/* File location	: system/tests/testee/test_testee_model.php */