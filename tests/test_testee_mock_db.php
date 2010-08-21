<?php

/**
 * Tests for the Testee_mock_db class.
 *
 * @package			Testee
 * @author			Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright		Experience Internet
 */

class Test_testee_mock_db extends Testee_unit_test_case {

	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */

	/**
	 * Runs before each test.
	 *
	 * @access	public
	 * @return	void
	 */
	public function setUp()
	{
		parent::setUp(array('db' => array('nonsense_method')));
	}



	/* --------------------------------------------------------------
	 * TEST METHODS
	 * ------------------------------------------------------------ */
	
	function test_select()
	{
		$db =& $this->_ee->db;
		$db->setReturnReference('select', $db);
		
		$ret = $db->select();
		$this->assertReference($ret, $db);
		$this->assertTrue(method_exists($ret, 'get_where'));
	}
	
	
	function test_nonsense_method()
	{
		$db =& $this->_ee->db;
		$db->setReturnValue('nonsense_method', 'wibble');
		
		$this->assertEqual($db->nonsense_method(), 'wibble');
	}

}

/* End of file		: test_testee_model.php */
/* File location	: third_party/testee/tests/test_testee_model.php */
