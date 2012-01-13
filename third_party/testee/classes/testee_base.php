<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

class Testee_base {
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Constructor.
   *
   * @access  public
   * @param   array     $props    An associative array of properties.
   * @return  void
   */
  public function __construct(Array $props = array())
  {
    foreach ($props AS $id => $val)
    {
      $this->$id = $val;
    }
  }
  
  
  /**
   * Retrieves a private property, if it exists.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @return  void
   */
  public function __get($prop_name = '')
  {
    $private_prop_name = '_' .$prop_name;
    
    return property_exists($this, $private_prop_name)
      ? $this->$private_prop_name : NULL;
  }
  
  
  /**
   * Returns whether a private property is set.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @return  bool
   */
  public function __isset($prop_name = '')
  {
    $private_prop_name = '_' .$prop_name;
    
    return property_exists($this, $private_prop_name)
      ? isset($this->$private_prop_name) : FALSE;
  }
  
  
  /**
   * Sets a private property, if it exists.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @param   string    $prop_value   The property value.
   * @return  mixed
   */
  public function __set($prop_name = '', $prop_value = '')
  {
    $private_prop_name = '_' .$prop_name;
    
    if (property_exists($this, $private_prop_name))
    {
      $this->$private_prop_name = $prop_value;
      return $this->$prop_name;
    }
    
    return NULL;
  }
  
  
  /**
   * Unsets a private property.
   *
   * @access  public
   * @param   string    $prop_name    The property name.
   * @return  void
   */
  public function __unset($prop_name = '')
  {
    $private_prop_name = '_' .$prop_name;
    
    if (property_exists($this, $private_prop_name))
    {
      unset($this->$private_prop_name);
    }
  }


}

/* End of file    : testee_base.php */
/* File location  : third_party/testee/classes/testee_base.php */
