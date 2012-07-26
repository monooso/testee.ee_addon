<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module model.
 *
 * @author      Stephen Lewis (http://github.com/experience/)
 * @copyright   Experience Internet
 * @package     Testee
 */

require_once dirname(__FILE__) .'/../config.php';
require_once dirname(__FILE__) .'/../classes/testee_addon.php';
require_once dirname(__FILE__) .'/../classes/testee_unit_test_case.php';

class Testee_model extends CI_Model {

  private $EE;
  private $_package_name;
  private $_package_version;


  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */

  /**
   * Constructor.
   *
   * @access  public
   * @param   string    $package_name     Mock package name.
   * @param   string    $package_version  Mock package version.
   * @return  void
   */
  public function __construct($package_name = '', $package_version = '')
  {
    parent::__construct();

    $this->EE =& get_instance();

    /**
     * Constants defined in the NSM Add-on Updater config.php file, so we don't 
     * have the package name and version defined in multiple locations.
     */

    $this->_package_name = $package_name
      ? $package_name
      : TESTEE_NAME;

    $this->_package_version = $package_version
      ? $package_version
      : TESTEE_VERSION;
  }


  /**
   * Returns the child sub-directories of the specified directory.
   *
   * @access  public
   * @param   string      $dir_path     The directory to examine.
   * @return  array
   */
  public function get_directory_names($dir_path = '')
  {
    return $this->_get_directory_contents($dir_path, 'DIRECTORY');
  }


  /**
   * Returns the child files of the specified directory.
   *
   * @access  public
   * @param   string      $dir_path     The directory to examine.
   * @return  array
   */
  public function get_file_names($dir_path = '')
  {
    return $this->_get_directory_contents($dir_path, 'FILE');
  }


  /**
   * Returns the package name.
   *
   * @access  public
   * @return  string
   */
  public function get_package_name()
  {
    return $this->_package_name;
  }


  /**
   * Returns the package version.
   *
   * @access  public
   * @return  string
   */
  public function get_package_version()
  {
    return $this->_package_version;
  }


  /**
   * Returns an array of all the available tests. Testee assumes that
   * each add-on will define its own tests, in a /third_party/add_on/tests/
   * directory.
   *
   * @access  public
   * @return  array
   */
  public function get_tests()
  {
    $tests  = array();

    // Retrieve the contents of the third-party add-ons directory.
    if ( ! $all_addons = $this->get_directory_names(PATH_THIRD))
    {
      return $tests;
    }

    foreach ($all_addons AS $addon)
    {
      $test_dir_path = PATH_THIRD .$addon .DIRECTORY_SEPARATOR .'tests';

      if ( ! $all_tests = $this->get_file_names($test_dir_path))
      {
        continue;
      }

      $test_pattern = '/^test[_|\.]([^\.]*)\.php$/i';
      $addon_tests  = array();

      foreach ($all_tests AS $test)
      {
        if ( ! preg_match($test_pattern, $test))
        {
          continue;
        }

        $addon_tests[] = new Testee_test(array(
          'file_name' => $test,
          'file_path' => $test_dir_path .DIRECTORY_SEPARATOR .$test
        ));
      }

      if ($addon_tests)
      {
        $tests[] = new Testee_addon(array(
          'name'  => $addon,
          'tests' => $addon_tests
        ));
      }
    }

    return $tests;
  }


  /**
   * Run the tests.
   *
   * @author  Stephen Lewis
   * @author  Jamie Rumbelow
   * @author  Bjørn Børresen
   * @param   array             $test_path  The tests to run.
   * @param   Testee_reporter   $reporter   The custom reporter used for output.
   * @return  string
   */
  public function run_tests(Array $test_path = array(),
    Testee_reporter $reporter
  )
  {
    // Can't do anything without tests to run.
    if ( ! $test_path)
    {
      throw new Exception('Missing test path(s).');
    }

    // Get rid of E_DEPRECATION errors for anybody using PHP5.3.
    if (phpversion() >= 5.3)
    {
      error_reporting(error_reporting() & ~E_DEPRECATED);
    }

    // Create the Test Suite.
    $test_suite = new TestSuite('Testee Test Suite');

    // Add the test files.
    foreach ($test_path AS $path)
    {
      /**
       * Handle Windows paths correctly.
       *
       * @author  Bjørn Børresen (http://twitter.com/bjornbjorn)
       * @since   0.9.0
       */

      $package_path = explode(DIRECTORY_SEPARATOR,
        str_replace(PATH_THIRD, '', $path));

      if (count($package_path) == 3
        && $package_path[1] == 'tests'
        && file_exists($path)
      )
      {
        $test_suite->addFile($path);
      }
    }

    /**
     * Make a note of the real EE objects. These are replaced by
     * mock objects during testing.
     */

    $real_config      = $this->EE->config;
    $real_db          = $this->EE->db;
    $real_extensions  = $this->EE->extensions;
    $real_functions   = $this->EE->functions;
    $real_input       = $this->EE->input;
    $real_lang        = $this->EE->lang;
    $real_loader      = $this->EE->load;
    $real_output      = $this->EE->output;
    $real_session     = $this->EE->session;
    $real_uri         = $this->EE->uri;

    // These don't always exist.
    $real_cp       = (isset($this->EE->cp)) ? $this->EE->cp : FALSE;
    $real_dbforge  = (isset($this->EE->dbforge)) ? $this->EE->dbforge : FALSE;
    $real_email    = (isset($this->EE->email)) ? $this->EE->email : FALSE;
    $real_layout   = (isset($this->EE->layout)) ? $this->EE->layout : FALSE;
    $real_table    = (isset($this->EE->table)) ? $this->EE->table : FALSE;
    $real_template = (isset($this->EE->template)) ? $this->EE->template : FALSE;
    $real_tmpl     = (isset($this->EE->TMPL)) ? $this->EE->TMPL : FALSE;

    $real_javascript = (isset($this->EE->javascript))
      ? $this->EE->javascript : FALSE;

    $real_typography = (isset($this->EE->typography))
      ? $this->EE->typography : FALSE;

    // Prepare the view variables.
    ob_start();
    $test_suite->run($reporter);
    $test_results = ob_get_clean();

    // Reinstate the real EE objects.
    $this->EE->config     = $real_config;
    $this->EE->cp         = $real_cp;
    $this->EE->db         = $real_db;
    $this->EE->extensions = $real_extensions;
    $this->EE->functions  = $real_functions;
    $this->EE->input      = $real_input;
    $this->EE->lang       = $real_lang;
    $this->EE->load       = $real_loader;
    $this->EE->output     = $real_output;
    $this->EE->session    = $real_session;
    $this->EE->uri        = $real_uri;

    // The optional extras.
    if ($real_cp)         $this->EE->cp         = $real_cp;
    if ($real_dbforge)    $this->EE->dbforge    = $real_dbforge;
    if ($real_email)      $this->EE->email      = $real_email;
    if ($real_javascript) $this->EE->javascript = $real_javascript;
    if ($real_layout)     $this->EE->layout     = $real_layout;
    if ($real_table)      $this->EE->table      = $real_table;
    if ($real_template)   $this->EE->template   = $real_template;
    if ($real_tmpl)       $this->EE->TMPL       = $real_tmpl;
    if ($real_typography) $this->EE->typography = $real_typography;

    return $test_results;
  }


  /**
   * Returns the `theme` folder URL.
   *
   * @access  public
   * @return  string
   */
  public function get_theme_url()
  {
    $url = $this->EE->config->item('theme_folder_url');
    $url .= substr($url, -1) == '/' ? 'third_party/' : '/third_party/';
    $url .= strtolower($this->get_package_name()) .'/';

    return $url;
  }


  /**
   * Installs the module.
   *
   * @access  public
   * @return  bool
   */
  public function install_module()
  {
    // Register the module.
    $this->EE->db->insert('modules', array(
      'has_cp_backend'      => 'y',
      'has_publish_fields'  => 'n',
      'module_name'         => $this->get_package_name(),
      'module_version'      => $this->get_package_version()
    ));

    // Register the module actions.
    $this->EE->db->insert('actions',
      array('class' => $this->get_package_name(), 'method' => 'run_tests'));

    return TRUE;
  }


  /**
   * Uninstalls the module.
   *
   * @access  public
   * @return  bool
   */
  public function uninstall_module()
  {
    $db_module = $this->EE->db
      ->select('module_id')
      ->get_where('modules', array('module_name' => $this->get_package_name()));

    if ($db_module->num_rows() !== 1)
    {
      return FALSE;
    }

    $this->EE->db->delete('module_member_groups',
      array('module_id' => $db_module->row()->module_id));

    $this->EE->db->delete('modules',
      array('module_name' => $this->get_package_name()));

    $this->EE->db->delete('actions',
      array('class' => $this->get_package_name()));

    return TRUE;
  }


  /**
   * Updates the module.
   *
   * @access  public
   * @param   string    $installed_version    The installed version.
   * @param   string    $package_version      The package version.
   * @return  bool
   */
  public function update_module($installed_version = '', $package_version = '')
  {
    if (version_compare($installed_version, $package_version, '>='))
    {
      return FALSE;
    }

    if (version_compare($installed_version, '2.2.0b1', '<'))
    {
      // Register the action.
      $this->EE->db->insert('actions',
        array('class' => $this->get_package_name(), 'method' => 'run_tests'));
    }

    return TRUE;
  }



  /* --------------------------------------------------------------
   * PRIVATE METHODS
   * ------------------------------------------------------------ */

  /**
   * Returns the contents of a directory.
   *
   * @access  private
   * @param   string    $dir_path     The directory to examine.
   * @param   string    $item_type    'DIRECTORY' or 'FILE'.
   * @return  void
   */
  private function _get_directory_contents($dir_path = '',
    $item_type = 'DIRECTORY'
  )
  {
    $return     = array();
    $item_type  = strtoupper($item_type);

    if ($dir_handle = @opendir($dir_path))
    {
      $dir_path = rtrim(realpath($dir_path), DIRECTORY_SEPARATOR)
        .DIRECTORY_SEPARATOR;

      while (($dir_item = readdir($dir_handle)) !== FALSE)
      {
        // Ignore any hidden files or directories.
        if (substr($dir_item, 0, 1) == '.')
        {
          continue;
        }

        switch ($item_type)
        {
          case 'DIRECTORY':
            if (is_dir($dir_path .$dir_item))
            {
              $return[] = $dir_item;
            }
            break;

          case 'FILE':
            if (is_file($dir_path .$dir_item))
            {
              $return[] = $dir_item;
            }
            break;

          default:
            continue;
            break;
        }
      }
    }

    return $return;
  }


}


/* End of file      : testee_model.php */
/* File location    : third_party/testee/models/testee_model.php */
