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
	 * Base module query string.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_base_qs = '';
	
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
		$this->_ee 			=& get_instance();
		$this->_base_qs 	= 'C=addons_modules' .AMP .'M=show_module_cp' .AMP .'module=testee';
		$this->_base_url	= BASE .AMP .$this->_base_qs;
		
		// Load the model.
		$this->_ee->load->model('testee_model');
		
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
		// Load our glamorous assistants.
		$this->_ee->load->helper('form');
		$this->_ee->load->library('table');
		
		// Retrieve the theme folder URL.
		$theme_url = $this->_ee->testee_model->get_theme_url();
		
		// Include the main JS file.
		$this->_ee->cp->add_to_foot('<script type="text/javascript" src="' .$theme_url .'js/cp.js"></script>');
		$this->_ee->javascript->compile();

		// Include the CSS.
		$this->_ee->cp->add_to_head('<link media="screen, projection" rel="stylesheet" type="text/css" href="' .$theme_url .'css/cp.css" />');
		
		$vars = array(
			'form_action'		=> $this->_base_qs .AMP .'method=run_test',
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
		if ( ! $test_path = $this->_ee->input->post('tests') OR ! is_array($test_path))
		{
			$this->_ee->functions->redirect($this->_base_url);
			return;
		}
		
		// Load the unit tester base class, so the tests don't have to.
		require_once PATH_THIRD .'testee/classes/testee_unit_test_case' .EXT;
		
		// Load the custom reporter.
		require_once PATH_THIRD .'testee/classes/testee_reporter' .EXT;
		
		// Create the Test Suite.
		$test_suite =& new TestSuite('Testee Test Suite');
		
		// Add the test files.
		foreach ($test_path AS $path)
		{
			/**
			 * @todo : remove the `add_package_path` code. We should be mocking the EE->load object anyway.
			 */
			
			// Extract the package name.
			$pattern = '#^' .preg_quote(PATH_THIRD, '#') .'([\w\d\-]+)/tests/#i';
			preg_match($pattern, $path, $matches);
			
			if ( ! isset($matches[1]))
			{
				continue;
			}
			
			// Automatically load the add-on package path. Note that EE isn't smart
			// enough to add the slash to the end of the path, so we need to do it.
			$this->_ee->load->add_package_path(PATH_THIRD .$matches[1] .'/');
			
			// Add the test file.
			if (file_exists($path))
			{
				$test_suite->addFile($path);
			}
		}
		
		/**
		 * Make a note of the real EE objects. These are replaced by
		 * mock objects during testing.
		 */
		
		$real_config		= $this->_ee->config;
		$real_db 			= $this->_ee->db;
		$real_extensions	= $this->_ee->extensions;
		$real_functions		= $this->_ee->functions;
		$real_input 		= $this->_ee->input;
		$real_lang			= $this->_ee->lang;
		$real_output		= $this->_ee->output;
		
		// Prepare the view variables.
		ob_start();
		$test_suite->run(new Testee_reporter());
		$test_results = ob_get_clean();
		
		// Reinstate the real EE objects.
		$this->_ee->config		= $real_config;
		$this->_ee->db 			= $real_db;
		$this->_ee->extensions	= $real_extensions;
		$this->_ee->functions	= $real_functions;
		$this->_ee->input 		= $real_input;
		$this->_ee->lang		= $real_lang;
		$this->_ee->output		= $real_output;
		
		// Retrieve the theme folder URL.
		$theme_url = $this->_ee->testee_model->get_theme_url();
		
		// Include the CSS.
		$this->_ee->cp->add_to_head('<link media="screen, projection" rel="stylesheet" type="text/css" href="' .$theme_url .'css/cp.css" />');
		
		$vars = array(
			'form_action'		=> $this->_base_qs .AMP .'method=run_test',
			'tests_index_url'	=> $this->_base_url,
			'cp_page_title'		=> 'Testee Test Results',
			'test_results'		=> $test_results,
			'tests'				=> $test_path
		);
		
		return $this->_ee->load->view('test_results', $vars, TRUE);
	}
	
}


/* End of file		: mcp.testee.php */
/* File location	: /system/expressionengine/third_party/testee/mcp.testee.php */
