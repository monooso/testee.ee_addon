<?php

/**
 * Testee Test Result datatype.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         Testee
 */

if ( ! class_exists('EI_datatype'))
{
  require_once dirname(__FILE__) .'/EI_datatype.php';
}

class Testee_test_result extends EI_datatype
{
  const TYPE_ERROR     = 'error';
  const TYPE_EXCEPTION = 'exception';
  const TYPE_FAIL      = 'fail';
  const TYPE_SKIP      = 'skip';

  protected $_known_types;


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
    parent::__construct($props);

    $this->_known_types = array(
      self::TYPE_ERROR,
      self::TYPE_EXCEPTION,
      self::TYPE_FAIL,
      self::TYPE_SKIP
    );
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
      case 'breadcrumb':
        $this->_set_array_property($prop_name, $prop_value);
        break;

      case 'message':
        $this->_set_string_property($prop_name, $prop_value);
        break;

      case 'type':
        if (in_array($prop_value, $this->_known_types))
        {
          $this->_set_string_property($prop_name, $prop_value);
        }
        break;
    }
  }


  /**
   * Resets the instance properties.
   *
   * @access  public
   * @return  Testee_test_result
   */
  public function reset()
  {
    $this->_props = array(
      'type'       => '',
      'message'    => '',
      'breadcrumb' => array()
    );

    return $this;
  }


}


/* End of file      : testee_test_result.php */
/* File location    : third_party/testee/classes/testee_test_result.php */
