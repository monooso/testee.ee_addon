<?php

/**
 * Base Testee unit test case.
 *
 * @package   Testee
 * @author    Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright Experience Internet
 */

require_once PATH_THIRD .'testee/classes/testee_equal_without_whitespace_expectation.php';
require_once PATH_THIRD .'testee/simpletest/unit_tester.php';
require_once PATH_THIRD .'testee/simpletest/mock_objects.php';

// Core.
require_once PATH_THIRD .'testee/mocks/core/mock.config.php';
require_once PATH_THIRD .'testee/mocks/core/mock.input.php';
require_once PATH_THIRD .'testee/mocks/core/mock.lang.php';
require_once PATH_THIRD .'testee/mocks/core/mock.loader.php';
require_once PATH_THIRD .'testee/mocks/core/mock.output.php';
require_once PATH_THIRD .'testee/mocks/core/mock.uri.php';

// Database.
require_once PATH_THIRD .'testee/mocks/database/mock.db.php';
require_once PATH_THIRD .'testee/mocks/database/mock.db_query.php';
require_once PATH_THIRD .'testee/mocks/database/mock.dbforge.php';
require_once PATH_THIRD .'testee/mocks/database/mock.dbutil.php';

// Helpers.

// Libraries.
require_once PATH_THIRD .'testee/mocks/libraries/mock.cp.php';
require_once PATH_THIRD .'testee/mocks/libraries/mock.email.php';
require_once PATH_THIRD .'testee/mocks/libraries/mock.extensions.php';
require_once PATH_THIRD .'testee/mocks/libraries/mock.functions.php';
require_once PATH_THIRD .'testee/mocks/libraries/mock.layout.php';
require_once PATH_THIRD .'testee/mocks/libraries/mock.template.php';


class Testee_unit_test_case extends UnitTestCase {
  
  protected $_ee;
  
  /**
   * The following methods return a reference to the $this->_ee->db object,
   * to enable active record chaining.
   *
   * @access  protected
   * @var   array
   */
  protected $_db_chaining_methods = array(
    'distinct', 'from', 'group_by', 'having',
    'join', 'like', 'limit', 'not_like', 'or_having',
    'or_like', 'or_not_like', 'or_where', 'or_where_in',
    'or_where_not_in', 'order_by', 'select', 'select_avg',
    'select_max', 'select_min', 'select_sum', 'set', 'where',
    'where_in', 'where_not_in'
  );
  
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Constructor.
   *
   * @access  public
   * @return  void
   */
  public function __construct()
  {
    // Retrieve the EE superglobal. Sorry, Singleton. Ahem.
    $this->_ee =& get_instance();
  }
  
  
  /**
   * Get things ready for the test.
   *
   * @access  public
   * @param array   $mock_methods   Additional 'ad hoc' methods for the mock
   *                                objects. e.g. array('db' => array(
   *                                'new_method_a', 'new_method_b'));
   * @return  void
   */
  public function setUp(Array $mock_methods = array())
  {
    /**
     * Create the mock objects. A class prefix is used to avoid 'redeclared
     * class' errors when generating mock object classes.
     */
    
    $class_prefix = get_class($this);
    
    $mocks = array('config', 'cp', 'db', 'db_query', 'dbforge', 'dbutil',
      'email', 'extensions', 'functions', 'input', 'lang', 'layout',
      'loader', 'output', 'template', 'uri');
    
    foreach ($mocks AS $mock)
    {
      $methods = isset($mock_methods[$mock]) && is_array($mock_methods[$mock])
        ? $mock_methods[$mock]
        : array();

      Mock::generate('Testee_mock_' .$mock,
        $class_prefix .'_mock_' .$mock, $methods);
    }

    
    // Assign the mock objects to the EE superglobal.
    $this->_ee->config    = $this->_get_mock('config');
    $this->_ee->cp        = $this->_get_mock('cp');
    $this->_ee->db        = $this->_get_mock('db');
    $this->_ee->dbforge   = $this->_get_mock('dbforge');
    $this->_ee->email       = $this->_get_mock('email');
    $this->_ee->extensions  = $this->_get_mock('extensions');
    $this->_ee->functions = $this->_get_mock('functions');
    $this->_ee->input     = $this->_get_mock('input');
    $this->_ee->lang      = $this->_get_mock('lang');
    $this->_ee->layout    = $this->_get_mock('layout');
    $this->_ee->load      = $this->_get_mock('loader');
    $this->_ee->output    = $this->_get_mock('output');
    $this->_ee->TMPL      = $this->_get_mock('template');
    $this->_ee->uri       = $this->_get_mock('uri');
    
    // First step towards getting rid of the dummy mocks...
    require_once BASEPATH .'libraries/Session.php';
    Mock::generate('CI_Session', $class_prefix .'_mock_session');

    $this->_ee->session = $this->_get_mock('session');
    $this->_ee->session->cache = array();

    // EE compatibility layer
    $this->_set_ee_mock_methods();
  }
  
  
  
  /* --------------------------------------------------------------
   * PRIVATE & PROTECTED METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Returns a mock object of the specified type.
   *
   * @access  protected
   * @param   string      $class    The class of mock object to return
   *                                e.g. 'db', or 'query'.
   * @return  bool|object
   */
  protected function _get_mock($class = '')
  {
    $class_name = get_class($this) .'_mock_' .$class;
    
    if (class_exists($class_name))
    {
      return new $class_name();
    }
    
    return FALSE;
  }


  /**
   * Set EE compatibility mock methods
   *
   * @return void
   * @author Jamie Rumbelow
   */
  protected function _set_ee_mock_methods() {
    foreach ($this->_db_chaining_methods as $method) {
      $this->_ee->db->setReturnValue($method, $this->_ee->db);
    }
  }


}


/* End of file    : testee_unit_test_case.php */
/* File location  : third_party/testee/classes/testee_unit_test_case.php */
