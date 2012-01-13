<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Testee module installation and update methods.
 *
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

class Testee_upd {
  
  private $EE;
  public $version = '';
  
  
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
    
    $this->EE->load->add_package_path(PATH_THIRD .'testee/');
    $this->EE->load->model('testee_model');
    
    $this->version = $this->EE->testee_model->get_package_version();
  }
  
  
  /**
   * Installs the module.
   *
   * @access  public
   * @return  bool
   */
  public function install()
  {
    return $this->EE->testee_model->install_module();
  }
  
  
  /**
   * Uninstalls the module.
   *
   * @access  public
   * @return  bool
   */
  public function uninstall()
  {
    return $this->EE->testee_model->uninstall_module();
  }
  
  
  /**
   * Updates the module.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @return  bool
   */
  public function update($installed_version = '')
  {
    return $this->EE->testee_model->update_module($installed_version,
      $this->EE->testee_model->get_package_version());
  }


}


/* End of file    : upd.testee.php */
/* File location  : third_party/testee/upd.testee.php */
