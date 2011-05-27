<?php if ( ! defined('EXT')) exit('Invalid file request');

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

class Testee_upd {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * Module version.
	 *
	 * @access	public
	 * @var 	string
	 */
	public $version = '';
	
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
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
	 * @return	void
	 */
	public function __construct()
	{
		$this->_ee =& get_instance();
		
		$this->_ee->load->add_package_path(PATH_THIRD .'testee/');
		$this->_ee->load->model('testee_model');
		
		$this->version = $this->_ee->testee_model->get_package_version();
	}
	
	
	/**
	 * Module installer.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function install()
	{
		return $this->_ee->testee_model->install_module();
	}
	
	
	/**
	 * Module uninstaller.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function uninstall()
	{
		return $this->_ee->testee_model->uninstall_module();
	}
	
	
	/**
	 * Module updater.
	 *
	 * @access	public
	 * @param	string		$installed_version		The installed version.
	 * @return	bool
	 */
	public function update($installed_version = '')
	{
		return $this->_ee->testee_model->update_module($installed_version, $this->_ee->testee_model->get_package_version());
	}
	
}


/* End of file		: upd.testee.php */
/* File location	: /system/expressionengine/third_party/testee/upd.testee.php */
