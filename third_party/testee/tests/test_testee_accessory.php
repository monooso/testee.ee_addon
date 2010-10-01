<?php

/**
 * Tests for the Testee_acc accessory.
 *
 * @package		Testee
 * @author		Jamie Rumbelow <jamie@jamierumbelow.net>
 * @copyright	Experience Internet
 */

require_once PATH_THIRD .'testee/acc.testee' .EXT;

class Test_testee_accessory extends Testee_unit_test_case {
	private $_acc;
	
	/**
	 * Ran before every test
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function setUp() {
		parent::setUp();
		$this->_acc = new Testee_acc();
	}
	
	/**
	 * Test set_sections()
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function test_set_sections() {
		// Mock the TestEE model
		Mock::generate('Testee_model', 'Testee_model_mock');
		$real_model = $this->_ee->testee_model;
		$this->_ee->testee_model = new Testee_model_mock();
		
		// Make sure we get the tests we CAN run
		$this->_ee->testee_model->expectOnce('get_tests');
		
		// Make sure if we have tests we run them
		$this->_ee->testee_model->expectOnce('run_tests');
		
		// Make sure we load the views
		$this->_ee->load->expectOnce('view');
		
		// Go!
		$this->_acc->set_sections();
		
		// Reset the TestEE model
		$this->_ee->testee_model = $real_model;
	}
	
	/**
	 * Test the process_save() method
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function test_process_save() {
		// Make sure we get the input
		$this->_ee->input->expectMinimumCallCount('post', 2);
		$this->_ee->input->expectAt(0, 'post', array('tests'));
		$this->_ee->input->expectAt(1, 'post', array('url'));
		$this->_ee->input->setReturnValue('post', 'Test');
		
		// Make sure that we save the serialized tests
		$this->_ee->config->expectOnce('_update_config');
		$this->_ee->config->expectAt(0, '_update_config', array(array('testee_accessory_tests' => addslashes(serialize('Test')))));
		
		// Make sure we redirect
		$this->_ee->functions->expectOnce('redirect');
		$this->_ee->functions->expectAt(0, 'redirect', array('Test'));
		
		// Do it
		$this->_acc->process_save();
	}
	
	/**
	 * Test the accessory install
	 *
	 * @return void
	 * @author Jamie Rumbelow
	 */
	public function test_install() {
		// Make sure that we add the config values
		$this->_ee->config->expectOnce('_update_config');
		$this->_ee->config->expectAt(0, '_update_config', array(array('testee_accessory_tests' => serialize(array()))));
		
		// Go, mofo
		$this->_acc->install();
	}
}