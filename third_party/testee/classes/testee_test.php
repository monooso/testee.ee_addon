<?php

/**
 * Testee Test datatype.
 *
 * @author		  Stephen Lewis
 * @copyright	  Experience Internet
 * @package		  Testee
 */

if ( ! class_exists('EI_datatype'))
{
  require_once dirname(__FILE__) .'/EI_datatype.php';
}

class Testee_test extends EI_datatype {
	
	
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
      case 'file_name':
      case 'file_path':
        $this->_set_string_property($prop_name, $prop_value);
        break;
    }
  }


  /**
   * Resets the instance properties.
   *
   * @access  public
   * @return  Testee_test
   */
  public function reset()
  {
    $this->_props = array(
      'file_name' => '',
      'file_path' => ''
    );

    return $this;
  }


}


/* End of file		: testee_test.php */
/* File location	: third_party/testee/classes/testee_test.php */
