<?php

/**
 * Tests for the Testee_model class.
 *
 * @author			Stephen Lewis (http://github.com/experience/)
 * @copyright		Experience Internet
 * @package			Testee
 */

require_once PATH_THIRD .'testee/models/testee_model.php';

class Test_testee_model extends Testee_unit_test_case {

  private $_package_name;
  private $_package_version;
  private $_subject;

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

    $this->_package_name    = 'example_package';
    $this->_package_version = '1.2.3';

    $this->_subject = new Testee_model($this->_package_name,
      $this->_package_version);
	}



	/* --------------------------------------------------------------
	 * TEST METHODS
	 * ------------------------------------------------------------ */
	
	public function test__get_package_name__returns_correct_package_name()
	{
    $this->assertIdentical($this->_package_name,
      $this->_subject->get_package_name());
	}


	public function tests__get_package_version__retrieves_valid_version_number()
	{
    $this->assertIdentical($this->_package_name,
      $this->_subject->get_package_name());
	}


	public function test__get_theme_url__works_with_trailing_slash()
	{
    $themes_url = 'http://example.com/themes/';
    $full_url   = $themes_url .'third_party/' .$this->_package_name .'/';

		$this->EE->config->expectOnce('item', array('theme_folder_url'));
		$this->EE->config->setReturnValue('item', $themes_url);
		
    $this->assertIdentical($full_url, $this->_subject->get_theme_url());
	}


	public function test__get_theme_url__works_without_trailing_slash()
	{
    $themes_url = 'http://example.com/themes';
    $full_url   = $themes_url .'/third_party/' .$this->_package_name .'/';

		$this->EE->config->expectOnce('item', array('theme_folder_url'));
		$this->EE->config->setReturnValue('item', $themes_url);
		
    $this->assertIdentical($full_url, $this->_subject->get_theme_url());
	}


	public function test__install_module__adds_module_to_db_and_returns_true()
	{
    $module_data = array(
			'has_cp_backend'		  => 'y',
			'has_publish_fields'	=> 'n',
			'module_name'			    => $this->_package_name,
			'module_version'		  => $this->_package_version
    );

    $action_data = array(
      'class'  => $this->_package_name,
      'method' => 'run_tests'
    );

    $this->EE->db->expectCallCount('insert', 2);
		$this->EE->db->expectAt(0, 'insert', array('modules', $module_data));
		$this->EE->db->expectAt(1, 'insert', array('actions', $action_data));

		$this->assertIdentical(TRUE, $this->_subject->install_module());
	}


	public function test__uninstall_module__removes_module_from_db_and_returns_true()
	{
    $module_id  = '123';
    $db_result  = $this->_get_mock('db_query');
		$db_row     = (object) array('module_id' => $module_id);
		
    // Retrieve the module ID.
    $this->EE->db->expectOnce('select', array('module_id'));

    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => $this->_package_name)));

    $this->EE->db->setReturnReference('get_where', $db_result);

    $db_result->expectOnce('num_rows');
    $db_result->setReturnValue('num_rows', 1);

		$db_result->expectOnce('row');
		$db_result->setReturnReference('row', $db_row);

    // Delete the module.
    $this->EE->db->expectCallCount('delete', 3);

    $this->EE->db->expectAt(0, 'delete', array('module_member_groups',
      array('module_id' => $module_id)));
		
    $this->EE->db->expectAt(1, 'delete', array('modules',
      array('module_name' => $this->_package_name)));

    $this->EE->db->expectAt(2, 'delete', array('actions',
      array('class' => $this->_package_name)));

		$this->assertIdentical(TRUE, $this->_subject->uninstall_module());
  }


  public function test__uninstall_module__returns_false_if_module_not_found()
  {
    $db_result = $this->_get_mock('db_query');
		
    // Retrieve the module ID.
    $this->EE->db->expectOnce('select', array('module_id'));

    $this->EE->db->expectOnce('get_where', array('modules',
      array('module_name' => $this->_package_name)));

    $this->EE->db->setReturnReference('get_where', $db_result);

    $db_result->expectOnce('num_rows');
    $db_result->setReturnValue('num_rows', 0);
		$db_result->expectNever('row');

    // Should never get this far.
    $this->EE->db->expectNever('delete');

		$this->assertIdentical(FALSE, $this->_subject->uninstall_module());
  }


  public function test__update_module__returns_false_if_no_update_required()
  {
    $subject = $this->_subject;

    $this->assertIdentical(FALSE, $subject->update_module('1.0.0', '0.9.0'));
    $this->assertIdentical(FALSE, $subject->update_module('1.0b2', '1.0b1'));
    $this->assertIdentical(FALSE, $subject->update_module('1.0.0', ''));
  }


  public function test__update_module__returns_true_if_update_required()
  {
    $subject = $this->_subject;

    $this->assertIdentical(TRUE, $subject->update_module('10.0.0', '10.0.1'));
    $this->assertIdentical(TRUE, $subject->update_module('10.0b2', '10.0b3'));
    $this->assertIdentical(TRUE, $subject->update_module('', '0.1.0'));
  }


  public function test__update_module__registers_the_run_tests_action_if_upgrading_to_version_220b1()
  {
    $this->EE->db->expectOnce('insert', array('actions',
      array('class' => $this->_package_name, 'method' => 'run_tests')));
  
    $this->_subject->update_module('2.1.0', '2.2.0b1');
  }
  
	
	
}

/* End of file		: test_testee_model.php */
/* File location	: third_party/testee/tests/test.testee_model.php */
