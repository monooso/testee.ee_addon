<?php

/**
 * Testee Add-on datatype.
 *
 * @author		  Stephen Lewis
 * @copyright	  Experience Internet
 * @package		  Testee
 */

if ( ! class_exists('EI_datatype'))
{
  require_once dirname(__FILE__) .'/EI_datatype.php';
}

require_once dirname(__FILE__) .'/testee_test.php';

class Testee_addon extends EI_datatype {
  

  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @param 	array 		$props		An associative array of properties.
	 * @return	void
	 */
	public function __construct(Array $props = array())
	{
		parent::__construct($props);
	}

	
  /**
   * Magic setter.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @return  void
   */
  public function __set($prop_name, $prop_value)
  {
    switch ($prop_name)
    {
      case 'name':
        $this->_set_string_property($prop_name, $prop_value);
        break;

      case 'tests':
        // Start by resetting the tests array.
        $this->_set_array_property($prop_name, array());

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
        break;
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
    $this->_props['tests'][] = $test;
    return $this->tests;
  }
  
  
  /**
   * Clears the tests array.
   *
   * @access  public
   * @return  array
   */
  public function remove_all_tests()
  {
    $this->_props['tests'] = array();
    return $this->tests;
  }
  

  /**
   * Resets the instance properties.
   *
   * @access  public
   * @return  Testee_addon
   */
  public function reset()
  {
    $this->_props = array(
      'name'  => '',
      'tests' => array()
    );

    return $this;
  }


}


/* End of file    : testee_addon.php */
/* File location  : third_party/testee/classes/testee_addon.php */
