<?php if ( ! defined('BASEPATH')) exit('Invalid file request');

/**
 * Test-driven add-on development module model.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 * @version		0.1.0
 */

require_once PATH_THIRD .'testee/libraries/Testee_addon' .EXT;

class Testee_model extends CI_Model {
	
	/* --------------------------------------------------------------
	 * PRIVATE PROPERTIES
	 * ------------------------------------------------------------ */
	
	/**
	 * ExpressionEngine singleton.
	 *
	 * @access	private
	 * @var		object
	 */
	private $_ee;
	
	/**
	 * Package name.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_package_name;
	
	/**
	 * Package version.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_package_version;
	
	/**
	 * The package 'theme' folder URL.
	 *
	 * @access	private
	 * @var		string
	 */
	private $_theme_folder_url;
	
	
	

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
		parent::CI_Model();
		
		$this->_ee =& get_instance();
		
		$this->_package_name	= 'Testee';
		$this->_package_version = '0.1.0';
	}
	
	
	/**
	 * Returns the child sub-directories of the specified directory.
	 *
	 * @access	public
	 * @param 	string 		$dir_path 		The directory to examine.
	 * @return	array
	 */
	public function get_directory_names($dir_path = '')
	{
		return $this->_get_directory_contents($dir_path, 'DIRECTORY');
	}
	
	
	/**
	 * Returns the child files of the specified directory.
	 *
	 * @access	public
	 * @param	string		$dir_path		The directory to examine.
	 * @return	array
	 */
	public function get_file_names($dir_path = '')
	{
		return $this->_get_directory_contents($dir_path, 'FILE');
	}
	
	
	/**
	 * Returns the package name.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_package_name()
	{
		return $this->_package_name;
	}
	
	
	/**
	 * Returns the package version.
	 *
	 * @access	public
	 * @return	string
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
	 * @access	public
	 * @return	array
	 */
	public function get_tests()
	{
		/**
		 * @todo omit add-ons that are not installed.
		 */
		
		$tests	= array();
		
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
			
			/**
			 * We're only interested in files that match the following 'pattern':
			 * test_my_test_name.php
			 */
			
			$addon_tests = array();
			
			foreach ($all_tests AS $test)
			{
				if ( ! preg_match('/^test_([^.]*)' .EXT .'$/i', $test))
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
					'name'	=> $addon,
					'tests'	=> $addon_tests
				));
			}
		}
		
		return $tests;
	}
	
	
	/**
	 * Returns the `theme` folder URL.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_theme_url()
	{
		if ( ! $this->_theme_folder_url)
		{
			$this->_theme_folder_url = $this->_ee->config->item('theme_folder_url');
			$this->_theme_folder_url .= substr($this->_theme_folder_url, -1) == '/'
				? 'third_party/'
				: '/third_party/';
				
			$this->_theme_folder_url .= strtolower($this->get_package_name()) .'/';
		}

		return $this->_theme_folder_url;
	}


	/**
	 * Installs the module.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function install_module()
	{
		$this->_ee->db->insert(
			'modules',
			array(
				'has_cp_backend'		=> 'y',
				'has_publish_fields'	=> 'n',
				'module_name'			=> $this->get_package_name(),
				'module_version'		=> $this->get_package_version()
			)
		);

		return TRUE;
	}


	/**
	 * Uninstalls the module.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function uninstall_module()
	{
		$db_module = $this->_ee->db
			->select('module_id')
			->get_where('modules', array('module_name' => $this->get_package_name()));

		$this->_ee->db->delete(
			'module_member_groups',
			array('module_id' => $db_module->row()->module_id)
		);

		$this->_ee->db->delete(
			'modules',
			array('module_name' => $this->get_package_name())
		);

		return TRUE;
	}


	/**
	 * Updates the module.
	 *
	 * @access	public
	 * @param	string		$current_version		The installed version.
	 * @return	bool
	 */
	public function update_module($current_version = '')
	{
		return version_compare(
			$this->get_package_version(),
			$current_version,
			'=='
		);
	}
	
	
	
	/* --------------------------------------------------------------
	 * PRIVATE METHODS
	 * ------------------------------------------------------------ */
	
	/**
	 * Returns the contents of a directory.
	 *
	 * @access	private
	 * @param	string		$dir_path		The directory to examine.
	 * @param	string		$item_type		The item type to return ('DIRECTORY', or 'FILE').
	 * @return	void
	 */
	private function _get_directory_contents($dir_path = '', $item_type = 'DIRECTORY')
	{
		$return = array();
		$item_type = strtoupper($item_type);
		
		if ($dir_handle = @opendir($dir_path))
		{
			$dir_path = rtrim(realpath($dir_path), DIRECTORY_SEPARATOR) .DIRECTORY_SEPARATOR;
			
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

/* End of file		: testee_model.php */
/* File location	: /system/expressionengine/third_party/testee/models/testee_model.php */
