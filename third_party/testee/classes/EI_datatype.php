<?php

/**
 * Base Experience Internet datatype.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         EI
 */

require_once dirname(__FILE__) .'/../helpers/EI_number_helper.php';

class EI_datatype
{
  protected $_props;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   array    $props    Associative array of property names and values.
   * @return  void
   */
  public function __construct(Array $props = array())
  {
    $this->reset();

    foreach ($props AS $prop_name => $prop_value)
    {
      $this->$prop_name = $prop_value;
    }
  }


  /**
   * Magic 'getter' method.
   *
   * @access  public
   * @param   string    $prop_name    The requested property.
   * @return  mixed
   */
  public function __get($prop_name)
  {
    return $this->_is_valid_property($prop_name)
      ? $this->_props[$prop_name] : NULL;
  }


  /**
   * Magic 'isset' method, for checking whether a property is set.
   *
   * @access  public
   * @param   string    $prop_name    The property to check.
   * @return  bool
   */
  public function __isset($prop_name)
  {
    return isset($this->_props[$prop_name]);
  }


  /**
   * Magic 'setter' method. Most datatypes will want to override this, to
   * include some form of validation.
   *
   * @access  public
   * @param   string    $prop_name    The property to set.
   * @param   mixed     $prop_value   The new property value.
   * @return  void
   */
  public function __set($prop_name, $prop_value)
  {
    if ( ! $this->_is_valid_property($prop_name))
    {
      return;
    }

    $this->_props[$prop_name] = $prop_value;
  }


  /**
   * Returns a string representation of the class instance.
   *
   * @access  public
   * @return  string
   */
  public function __toString()
  {
    return 'An instance of the ' .get_class($this) .' class.';
  }


  /**
   * Magic 'unset' method, for 'unsetting' a property.
   *
   * @access  public
   * @param   string    $prop_name    The property to unset.
   * @return  void
   */
  public function __unset($prop_name)
  {
    if ($this->_is_valid_property($prop_name))
    {
      unset($this->_props[$prop_name]);
    }
  }


  /**
   * Resets the instance properties. Sub-classes must override this.
   *
   * @access  public
   * @return  EI_datatype
   */
  public function reset()
  {
    $this->_props = array();
    return $this;
  }


  /**
   * Returns the class instance as an associative array.
   *
   * @access  public
   * @param   string  $prefix   Optional key prefix.
   * @return  array
   */
  public function to_array($prefix = '')
  {
    $prefix = ($prefix && is_string($prefix))
      ? rtrim($prefix, ':') .':'
      : '';

    $return = array();

    foreach ($this->_props AS $key => $val)
    {
      $return[$prefix .$key] = $val;
    }

    return $return;
  }



  /* --------------------------------------------------------------
   * PROTECTED METHODS
   * ------------------------------------------------------------ */

  /**
   * Determines whether the given property name is valid.
   *
   * @access  protected
   * @param   string      $prop_name    The property name being checked.
   * @return  bool
   */
  protected function _is_valid_property($prop_name)
  {
    return array_key_exists($prop_name, $this->_props);
  }


  /**
   * Attempts to set an array property.
   *
   * @access  protected
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @return  array
   */
  protected function _set_array_property($prop_name, $prop_value)
  {
    if (is_array($prop_value))
    {
      $this->_props[$prop_name] = $prop_value;
    }

    return $this->$prop_name;
  }



  /**
   * Attempts to set a boolean property.
   *
   * @access  protected
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @return  bool
   */
  protected function _set_bool_property($prop_name, $prop_value)
  {
    if (is_bool($prop_value))
    {
      $this->_props[$prop_name] = (bool) $prop_value;
    }

    return $this->$prop_name;
  }


  /**
   * Attempts to set a custom datatype property.
   *
   * @access  protected
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @param   string    $prop_type    The expected class.
   * @return  mixed
   */
  protected function _set_custom_property($prop_name, $prop_value, $prop_type)
  {
    if (get_class($prop_value) === $prop_type)
    {
      $this->_props[$prop_name] = $prop_value;
    }

    return $this->$prop_name;
  }


  /**
   * Attempts to set a float property.
   *
   * @access  protected
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @param   float     $min_value    The minimum allowable value (optional).
   * @param   float     $max_value    The maximum allowable value (optional).
   * @return  float
   */
  protected function _set_float_property($prop_name, $prop_value,
    $min_value = NULL, $max_value = NULL
  )
  {
    if (valid_float($prop_value, $min_value, $max_value))
    {
      $this->_props[$prop_name] = (float) $prop_value;
    }

    return $this->$prop_name;
  }


  /**
   * Attempts to set an integer property.
   *
   * @access  protected
   * @param   string    $prop_name    The property name.
   * @param   mixed     $prop_value   The property value.
   * @param   int       $min_value    The minimum allowable value (optional).
   * @param   int       $max_value    The maximum allowable value (optional).
   * @return  int
   */
  protected function _set_int_property($prop_name, $prop_value,
    $min_value = NULL, $max_value = NULL
  )
  {
    if (valid_int($prop_value, $min_value, $max_value))
    {
      $this->_props[$prop_name] = (int) $prop_value;
    }

    return $this->$prop_name;
  }


  /**
   * Attempts to set a string property.
   *
   * @access  protected
   * @param   string    $prop_name      The property name.
   * @param   mixed     $prop_value     The property value.
   * @return  string
   */
  protected function _set_string_property($prop_name, $prop_value)
  {
    if (is_string($prop_value))
    {
      $this->_props[$prop_name] = (string) $prop_value;
    }

    return $this->$prop_name;
  }


}


/* End of file      : EI_datatype.php */
/* File location    : third_party/testee/classes/EI_datatype.php */