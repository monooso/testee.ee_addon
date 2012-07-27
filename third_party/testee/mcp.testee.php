<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Testee module control panel.
 *
 * @author      Stephen Lewis
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once dirname(__FILE__) .'/classes/testee_cp_reporter.php';

class Testee_mcp {
  
  protected $_base_qs;
  protected $_base_url;
  protected $_model;
  protected $EE;
  
  
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  
  /**
   * Constructor.
   *
   * @access  public
   * @param   bool    $switch   My whole life I don't know what this song means.
   * @return  void
   */
  public function __construct($switch = TRUE)
  {
    $this->EE =& get_instance();
    $this->EE->load->model('testee_model');

    $this->_model =& $this->EE->testee_model;

    $this->_base_qs = 'C=addons_modules' .AMP .'M=show_module_cp'
      .AMP .'module=testee';

    $this->_base_url = BASE .AMP .$this->_base_qs;
    
    $this->EE->cp->set_breadcrumb($this->_base_url,
      $this->EE->lang->line('testee_module_name'));

    // Retrieve the theme folder URL.
    $theme_url = $this->_model->get_theme_url();
    
    // Include the custom CSS and JS on all pages.
    $this->EE->cp->add_to_head('<link rel="stylesheet" href="'
      .$theme_url .'css/cp.css" />');
    
    $this->EE->cp->add_to_foot('<script src="'
      .$theme_url .'js/cp.js"></script>');

    $this->EE->javascript->compile();
  }
  
  
  /**
   * Displays the default module control panel page.
   *
   * @access  public
   * @return  string
   */
  public function index()
  {
    $this->EE->load->helper('form');
    $this->EE->load->library('table');

    $action_url = $this->EE->functions->fetch_site_index()
      .'?ACT=' .$this->EE->cp->fetch_action_id(
          $this->_model->get_package_name(), 'run_tests')
      .'&addon={addon_name}';
    
    $vars = array(
      'action_url'    => $action_url,
      'form_action'   => $this->_base_qs .AMP .'method=run_test',
      'cp_page_title' => $this->EE->lang->line('testee_module_name'),
      'docs_url'      => 'http://exhq.co/software/testee/docs/',
      'tests'         => $this->_model->get_tests()
    );
    
    return $this->EE->load->view('tests_index', $vars, TRUE);
  }
  
  
  /**
   * Handles a 'run_test' request.
   *
   * @access  public
   * @return  void
   */
  public function run_test()
  {
    $test_path = $this->EE->input->post('tests') OR ! is_array($test_path);
    
    try
    {
      $test_results = $this->_model->run_tests($test_path,
        new Testee_cp_reporter());
    }
    catch (Exception $e)
    {
      $this->EE->functions->redirect($this->_base_url);
      return;
    }
    
    $vars = array(
      'form_action'     => $this->_base_qs .AMP .'method=run_test',
      'tests_index_url' => $this->_base_url,
      'cp_page_title'   => 'Testee Test Results',
      'results'         => $test_results,
      'tests'           => $test_path
    );
    
    return $this->EE->load->view('test_results', $vars, TRUE);
  }
  
}


/* End of file    : mcp.testee.php */
/* File location  : third_party/testee/mcp.testee.php */
