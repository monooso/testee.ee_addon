<?php

/**
 * Base Testee unit test case.
 *
 * @author        Stephen Lewis (http://github.com/experience/)
 * @copyright     Experience Internet
 * @package       Testee
 */

// Classes extended by, but not 'required' by the 'mock' classes, below.
require_once BASEPATH .'database/DB_driver.php';
require_once BASEPATH .'libraries/Email.php';

// Classes mocked by Testee.
require_once BASEPATH .'database/DB_active_rec.php';
require_once BASEPATH .'database/DB_forge.php';
require_once BASEPATH .'database/DB_result.php';
require_once BASEPATH .'database/DB_utility.php';
require_once BASEPATH .'libraries/Javascript.php';

require_once APPPATH .'core/EE_Config.php';
require_once APPPATH .'core/EE_Input.php';
require_once APPPATH .'core/EE_Lang.php';
require_once APPPATH .'core/EE_Loader.php';
require_once APPPATH .'core/EE_Output.php';
require_once APPPATH .'core/EE_URI.php';

require_once APPPATH .'libraries/Cp.php';
require_once APPPATH .'libraries/EE_Email.php';
require_once APPPATH .'libraries/Extensions.php';
require_once APPPATH .'libraries/Functions.php';
require_once APPPATH .'libraries/Layout.php';
require_once APPPATH .'libraries/Session.php';
require_once APPPATH .'libraries/Template.php';

require_once PATH_THIRD .'testee/classes/testee_equal_without_whitespace_expectation.php';
require_once PATH_THIRD .'testee/simpletest/unit_tester.php';
require_once PATH_THIRD .'testee/simpletest/mock_objects.php';

class Testee_unit_test_case extends UnitTestCase {
  
  protected $EE;
  
  // @see _initialize_active_record_methods
  protected $_active_record_methods = array(
    'distinct', 'from', 'group_by', 'having',
    'join', 'like', 'limit', 'not_like', 'or_having',
    'or_like', 'or_not_like', 'or_where', 'or_where_in',
    'or_where_not_in', 'order_by', 'select', 'select_avg',
    'select_max', 'select_min', 'select_sum', 'set', 'where',
    'where_in', 'where_not_in'
  );
  
  // @see setUp
  protected $_mysql_methods = array(
    'db_connect', 'db_pconnect', 'reconnect', 'db_select',
    'trans_begin', 'trans_commit', 'trans_rollback', 'escape_str',
    'affected_rows', 'insert_id', 'count_all', 'escapes',
    'implicitly', 'maps'
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
    $this->EE =& get_instance();
  }
  
  
  /**
   * Get things ready for the test.
   *
   * @access  public
   * @return  void
   */
  public function setUp()
  {
    /**
     * Create the mock objects. A class prefix is used to avoid 'redeclared
     * class' errors when generating mock object classes.
     */
    
    $class_prefix = get_class($this);
    
    /**
     * TRICKY:
     * EE's support for multiple DB drivers makes life difficult. The 'master'
     * driver class defines a bunch of methods, but also delegates 
     * driver-specific calls to the relevant DB driver.
     *
     * The solution is to manually add the MySQL-specific methods to the DB 
     * mock. If you're not using MySQL, you can always sub-class this, and 
     * redefine the $_mysql_methods property.
     */

    Mock::generate('CI_DB_active_record', $class_prefix .'_mock_db',
      $this->_mysql_methods);

    // Everything else is much more straightforward.
    Mock::generate('EE_Config',     $class_prefix .'_mock_config');
    Mock::generate('Cp',            $class_prefix .'_mock_cp');
    Mock::generate('CI_DB_result',  $class_prefix .'_mock_db_query');
    Mock::generate('CI_DB_forge',   $class_prefix .'_mock_dbforge');
    Mock::generate('CI_DB_utility', $class_prefix .'_mock_dbutil');
    Mock::generate('EE_Email',      $class_prefix .'_mock_email');
    Mock::generate('EE_Extensions', $class_prefix .'_mock_extensions');
    Mock::generate('EE_Functions',  $class_prefix .'_mock_functions');
    Mock::generate('EE_Input',      $class_prefix .'_mock_input');
    Mock::generate('CI_Javascript', $class_prefix .'_mock_javascript');
    Mock::generate('EE_Lang',       $class_prefix .'_mock_lang');
    Mock::generate('Layout',        $class_prefix .'_mock_layout');
    Mock::generate('EE_Loader',     $class_prefix .'_mock_loader');
    Mock::generate('EE_Output',     $class_prefix .'_mock_output');
    Mock::generate('EE_Session',    $class_prefix .'_mock_session');
    Mock::generate('EE_Template',   $class_prefix .'_mock_template');
    Mock::generate('EE_URI',        $class_prefix .'_mock_uri');

    // Assign the mock objects to the EE superglobal.
    $this->EE->config       = $this->_get_mock('config');
    $this->EE->cp           = $this->_get_mock('cp');
    $this->EE->db           = $this->_get_mock('db');
    $this->EE->dbforge      = $this->_get_mock('dbforge');
    $this->EE->email        = $this->_get_mock('email');
    $this->EE->extensions   = $this->_get_mock('extensions');
    $this->EE->functions    = $this->_get_mock('functions');
    $this->EE->input        = $this->_get_mock('input');
    $this->EE->javascript   = $this->_get_mock('javascript');
    $this->EE->lang         = $this->_get_mock('lang');
    $this->EE->layout       = $this->_get_mock('layout');
    $this->EE->load         = $this->_get_mock('loader');
    $this->EE->output       = $this->_get_mock('output');
    $this->EE->session      = $this->_get_mock('session');
    $this->EE->TMPL         = $this->_get_mock('template');
    $this->EE->uri          = $this->_get_mock('uri');
    
    // EE compatibility layer
    $this->_initialize_active_record_methods();
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
   * Ensures that the 'chainable' Active Record mock methods still return a
   * reference to the mock DB class.
   *
   * @author Jamie Rumbelow
   * @author Stephen Lewis
   * @return void
   */
  protected function _initialize_active_record_methods()
  {
    foreach ($this->_active_record_methods AS $method)
    {
      $this->EE->db->setReturnReference($method, $this->EE->db);
    }
  }


}


/* End of file    : testee_unit_test_case.php */
/* File location  : third_party/testee/classes/testee_unit_test_case.php */
