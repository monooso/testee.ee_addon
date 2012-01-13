<?php

/**
 * Tests for the Testee_addon class.
 *
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once PATH_THIRD.'testee/classes/testee_addon.php';
require_once PATH_THIRD.'testee/classes/testee_test.php';

class Test_testee_addon extends Testee_unit_test_case {

  private $_props;
  private $_subject;
  
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  function setUp()
  {
    parent::setUp();

    $this->_props = array(
      'name'  => 'Addon_name',
      'tests' => array(new Testee_test())
    );

    $this->_subject = new Testee_addon($this->_props);
  }


  public function test__name__implicit_getter_retrieves_private_property()
  {
    $this->assertIdentical($this->_props['name'],
      $this->_subject->name);
  }


  public function test__tests__implicit_getter_retrieves_private_property()
  {
    $this->assertIdentical($this->_props['tests'],
      $this->_subject->tests);
  }


  public function test__tests__implicit_setter_resets_array_and_ignores_any_invalid_tests()
  {
    $this->_subject->tests = array(new Testee_test(), new StdClass());
    $all_tests = $this->_subject->tests;

    $this->assertIdentical(array(new Testee_test()), $all_tests);
  }
  
  
  public function test__getter__returns_null_for_unknown_private_property()
  {
    $this->assertIdentical(NULL, $this->_subject->invalid);
  }


  public function test__add_test__adds_valid_test_to_array()
  {
    $all_tests = $this->_subject->add_test(new Testee_test());

    $this->assertIdentical(count($this->_props['tests']) + 1,
      count($all_tests));
  }


  public function test__remove_all_tests__resets_the_tests_array()
  {
    $this->_subject->remove_all_tests();
    $this->assertIdentical(array(), $this->_subject->tests);
  }


}


/* End of file    : test.testee_addon.php */
/* File location  : third_party/testee/tests/test.testee_addon.php */
