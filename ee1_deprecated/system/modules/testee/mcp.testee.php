<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

require_once dirname(__FILE__) .'/models/testee_model.php';

class Testee_cp {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Version.
	 *
	 * @access	public
	 * @var		string
	 */
	public $version;
	
	
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
	 * The model.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_model;
	
	
	
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
		$this->_model 	= new Testee_model();
		$this->version	= $this->_model->get_package_version();
		
		$this->_base_qs 	= 'C=modules' .AMP .'M=Testee';
		$this->_base_url	= BASE .AMP .$this->_base_qs;
		
		$this->_controller($switch);
		
		// Add a base breadcrumb.
		// $this->_ee->cp->set_breadcrumb($this->_base_url, $this->_ee->lang->line('testee_module_name'));
	}
	
	
	/**
	 * Deinstalls the module.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function testee_module_deinstall()
	{
		return $this->_model->uninstall_module();
	}
	
	
	/**
	 * Installs the module.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function testee_module_install()
	{
		return $this->_model->install_module();
	}
	
	
	/* --------------------------------------------------------------
	 * PRIVATE METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * The main controller method.
	 *
	 * @access	private
	 * @param	bool	$switch		Goodness knows. Seriously, I have no idea.
	 * @return	void
	 */
	private function _controller($switch = TRUE)
	{
		global $DSP, $IN;
		
		if ( ! $switch)
		{
			return;
		}
		
		switch ($IN->GBL('P'))
		{
			case 'run_test':
				$this->_view_results();
				break;
				
			default:
				$this->_view_default();
				break;
		}
	}
	
	
	/**
	 * Displays the default view.
	 *
	 * @access	private
	 * @return	void
	 */
	private function _view_default()
	{
		global $DSP, $FNS, $LANG;		// NOTE: $FNS is used in the view.
		
		// Retrieve the theme folder URL.
		$theme_url = $this->_model->get_theme_url();
		
		// CSS and JS.
		$headers = '<link rel="stylesheet" type="text/css" media="screen,projection" href="' .$theme_url .'css/cp.css" />';
		$footers = '<script type="text/javascript" src="' .$theme_url .'js/cp.js"></script>';
		
		// View variables.
		$vars = array(
			'form_action'		=> $this->_base_url .AMP .'P=run_test',
			'module_name'		=> $LANG->line('testee_module_name'),
			'module_version'	=> $this->_model->get_package_version(),
			'tests'				=> $this->_model->get_tests()
		);
		
		// Output everything.
		$DSP->extra_header	.= $headers;
		$DSP->title 		= $LANG->line('testee_module_name');
		$DSP->crumbline 	= TRUE;
		$DSP->crumb 		= $DSP->anchor($this->_base_url, $LANG->line('testee_module_name'));
		$DSP->body 			.= $DSP->view('tests_index', $vars, TRUE) .$footers;
	}
	
	
	/**
	 * Displays the test results.
	 *
	 * @access	private
	 * @return	void
	 */
	private function _view_results()
	{
		global $DB, $DSP, $EXT, $FNS, $IN, $LANG, $LOC, $OUT, $PREFS, $REGX, $SESS, $TMPL;
		
		if ( ! $test_path = $IN->GBL('tests', 'POST') OR ! is_array($test_path))
		{
			$FNS->redirect($this->_base_url);
			return;
		}
		
		// Load the unit tester base class, so the tests don't have to.
		require_once PATH_MOD .'testee/classes/testee_unit_test_case' .EXT;
		
		// Load the custom reporter.
		require_once PATH_MOD .'testee/classes/testee_reporter' .EXT;
		
		// Create the Test Suite.
		$test_suite = new TestSuite('Testee Test Suite');
		
		// Add the test files.
		foreach ($test_path AS $path)
		{
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
		
		$real_db 	= $DB;
		$real_dsp	= $DSP;
		$real_ext	= $EXT;
		$real_fns	= $FNS;
		$real_input = $IN;
		$real_lang	= $LANG;
		$real_loc	= $LOC;
		$real_out	= $OUT;
		$real_prefs	= $PREFS;
		$real_regx	= $REGX;
		$real_sess	= $SESS;
		$real_tmpl	= $TMPL;
		
		// Run the tests.
		ob_start();
		$test_suite->run(new Testee_reporter());
		$test_results = ob_get_clean();
		
		// Reinstate the real EE objects.
		$DB		= $real_db;
		$DSP	= $real_dsp;
		$EXT	= $real_ext;
		$FNS	= $real_fns;
		$IN		= $real_input;
		$LANG	= $real_lang;
		$LOC	= $real_loc;
		$OUT	= $real_out;
		$PREFS	= $real_prefs;
		$REGX	= $real_regx;
		$SESS	= $real_sess;
		$TMPL	= $real_tmpl;
		
		// Retrieve the theme folder URL.
		$theme_url = $this->_model->get_theme_url();
		
		// CSS.
		$headers = '<link rel="stylesheet" type="text/css" media="screen,projection" href="' .$theme_url .'css/cp.css" />';
		$footers = '<script type="text/javascript" src="' .$theme_url .'js/cp.js"></script>';

		// View variables.
		$vars = array(
			'form_action'		=> $this->_base_url .AMP .'P=run_test',
			'module_name'		=> $LANG->line('testee_module_name'),
			'module_version'	=> $this->_model->get_package_version(),
			'test_results'		=> $test_results,
			'tests_index_url'	=> $this->_base_url,
			'tests'				=> $test_path
		);
		
		// Output everything.
		$DSP->extra_header	.= $headers;
		$DSP->title 		= $LANG->line('test_results_title');
		$DSP->crumbline 	= TRUE;
		$DSP->crumb 		= $DSP->anchor($this->_base_url, $LANG->line('testee_module_name'));
		$DSP->body 			.= $DSP->view('test_results', $vars, TRUE) .$footers;
	}
	
}

/* End of file		: mcp.testee.php */
/* File location	: system/modules/testee/mcp.testee.php */
