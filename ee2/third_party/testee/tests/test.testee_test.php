<?php

/**
 * Tests for the Testee_test class.
 *
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once PATH_THIRD .'testee/classes/testee_test.php';

class Test_testee_test extends Testee_unit_test_case {
  
  private $_props;
  private $_subject;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  public function setUp()
  {
    $this->_props = array(
      'file_name' => 'example_file.php',
      'file_path' => '/path/to/example_file.php'
    );

    $this->_subject = new Testee_test($this->_props);
  }


  public function test__file_name__implicit_getter_retrieves_private_property()
  {
    $this->assertIdentical($this->_props['file_name'],
      $this->_subject->file_name);
  }


  public function test__file_path__implicit_getter_retrieves_private_property()
  {
    $this->assertIdentical($this->_props['file_path'],
      $this->_subject->file_path);
  }


  public function test__getter__returns_null_for_unknown_private_property()
  {
    $this->assertIdentical(NULL, $this->_subject->invalid);
  }
  
  
}


/* End of file      : test.testee_test.php */
/* File location    : third_party/testee/tests/test.testee_test.php */
