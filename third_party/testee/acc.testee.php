<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development helper accessory.
 *
 * @package		Testee
 * @author		Jamie Rumbelow <jamie@jamierumbelow.net>
 * @copyright	Experience Internet
 */

class Testee_acc {
	public $name 			= 'TestEE';
	public $id 				= 'testee';
	public $version 		= '1.0.0';
	public $description		= 'Pain-free unit testing for ExpressionEngine add-ons.';
	public $sections 		= array();
	public $data 			= array();

	private $ee;
	
	/**
	 * Accessory constructor
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function __construct() {
		$this->ee =& get_instance();
	}
	
	/**
	 * Set sections (run the tests and load the view)
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function set_sections() {
		$this->ee->load->model('testee_model');
				
		// What tests do we want to run?
		$tests = unserialize(stripslashes($this->ee->config->item('testee_accessory_tests')));
		
		// Get & run the tests
		$this->data['url'] = $this->get_current_url();
		$this->data['tests'] = $this->ee->testee_model->get_tests();
		$this->data['test_results'] = $this->ee->testee_model->run_tests($tests);

		// Load the views
		$this->sections[$this->name . ' Test Results'] = $this->data['test_results'];
		$this->sections[$this->name . ' Tests'] = $this->ee->load->view('accessory_tests', $this->data, TRUE);
	}
	
	/**
	 * Save the tests to run on each page
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function process_save() {
		// Get the input
		$tests = $this->ee->input->post('tests');
		$url = $this->ee->input->post('url');
		
		// Save the config
		$this->ee->config->_update_config(array('testee_accessory_tests' => addslashes(serialize($tests))));
		
		// Redirect
		$this->ee->functions->redirect($url);
	}
	
	/**
	 * Install the accessory
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function install() {
		$this->ee->config->_update_config(array('testee_accessory_tests' => serialize(array())));
	}
	
	/**
	 * Get current page URL
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	protected function get_current_url() {
		$protocol = 'http';
		
	    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
	        $protocol .= 's';
	        $protocol_port = $_SERVER['SERVER_PORT'];
	    } else {
	        $protocol_port = 80;
	    }
	    
		$host = $_SERVER['HTTP_HOST'];
	    $port = $_SERVER['SERVER_PORT'];
	    $request = $_SERVER['PHP_SELF'];
	    $query = substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1);
	    $toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request . (empty($query) ? '' : '?' . $query);
	    
		return $toret;
	}
}