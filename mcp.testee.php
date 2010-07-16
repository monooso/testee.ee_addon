<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_mcp {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Base module URL.
	 *
	 * @access	private
	 * @var 	string
	 */
	private $_base_url = '';
	
	/**
	 * ExpressionEngine object reference.
	 *
	 * @access	private
	 * @var 	object
	 */
	private $_ee;
	
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Constructor.
	 *
	 * @access	public
	 * @param 	bool		$switch 	My whole life I don't know what this song means.
	 * @return	void
	 */
	public function __construct($switch = TRUE)
	{
		$this->_ee =& get_instance();
		$this->_base_url = BASE .AMP .'C=addons_modules' .AMP .'M=show_module_cp' .AMP .'module=testee';
		
		// Load our glamorous assistants.
		$this->_ee->load->helper('form');
		$this->_ee->load->library('table');
		$this->_ee->load->model('testee_model');
		
		/**
		 * Load the module CSS.
		 *
		 * @todo Move everything to themes/third_party/testee/ folder instead.
		 */
		$this->_ee->cp->load_package_css('testee');
		
		// Add a base breadcrumb.
		$this->_ee->cp->set_breadcrumb($this->_base_url, $this->_ee->lang->line('testee_module_name'));
	}
	
	
	/**
	 * Displays the default module control panel page.
	 *
	 * @access	public
	 * @return	string
	 */
	public function index()
	{
		$vars = array(
			'base_test_url'		=> $this->_base_url .AMP .'method=run_test' .AMP .'test_path=',
			'cp_page_title'		=> $this->_ee->lang->line('testee_module_name'),
			'tests'				=> $this->_ee->testee_model->get_tests()
		);
		
		return $this->_ee->load->view('tests_index', $vars, TRUE);
	}
	
	
	/**
	 * Handles a 'run_test' request.
	 *
	 * @access	public
	 * @return	void
	 */
	public function run_test()
	{
		$test_path = urldecode($this->_ee->input->get('test_path'));
		
		if ( ! file_exists($test_path))
		{
			$this->_ee->functions->redirect($this->_base_url);
			return;
		}
		
		// Load the SimpleTest libraries, so the tests don't have to.
		require_once(BASEPATH .'simpletest/unit_tester' .EXT);
		require_once(BASEPATH .'simpletest/reporter' .EXT);
		
		// Load the custom reporter.
		require_once(PATH_THIRD .'testee/classes/reporter' .EXT);
		
		// Create the Test Suite.
		$test_suite =& new TestSuite('Testee Test Suite');
		
		// Add the test file.
		$test_suite->addFile($test_path);
		
		// Prepare the view variables.
		ob_start();
		$test_suite->run(new Testee_reporter());
		$test_results = ob_get_clean();
		
		$vars = array(
			'cp_page_title'	=> 'Testee Test Results',
			'test_results'	=> $test_results
		);
		
		return $this->_ee->load->view('test_results', $vars, TRUE);
	}
	
}


/* End of file		: mcp.testee.php */
/* File location	: /system/expressionengine/third_party/testee/mcp.testee.php */