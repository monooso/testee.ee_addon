<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once PATH_THIRD .'testee/classes/testee_base' .EXT;
require_once PATH_THIRD .'testee/classes/testee_test' .EXT;

class Testee_addon extends Testee_base {
  
  protected $_name = '';
  protected $_tests = array();
  
  
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Sets a private property, if it exists.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @param   string    $prop_value   The property value.
   * @return  void
   */
  public function __set($prop_name = '', $prop_value = '')
  {
    // Everything bar the tests is simple.
    if ($prop_name != 'tests')
    {
      parent::__set($prop_name, $prop_value);
    }

    // Tests require a bit more work.
    $this->_tests = array();

    if ( ! is_array($prop_value))
    {
      $prop_value = array($prop_value);
    }

    foreach ($prop_value AS $test)
    {
      if ($test instanceof Testee_test)
      {
        $this->add_test($test);
      }
    }
  }
  
  
  /**
   * Adds a test to the tests array.
   *
   * @access  public
   * @param   Testee_test   $test   The test to add.
   * @return  array
   */
  public function add_test(Testee_test $test)
  {
    $this->_tests[] = $test;
    return $this->_tests;
  }
  
  
  /**
   * Clears the tests array.
   *
   * @access  public
   * @return  array
   */
  public function remove_all_tests()
  {
    $this->_tests = array();
    return $this->_tests;
  }
  

}


/* End of file    : testee_addon.php */
/* File location  : third_party/testee/classes/testee_addon.php */
