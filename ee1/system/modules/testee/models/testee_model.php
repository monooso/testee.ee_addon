<?php

/**
 * Test-driven add-on development module model.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 * @version		1.1.2
 */

require_once PATH_MOD .'testee/classes/testee_addon' .EXT;

class Testee_model {
	
	private $_package_name;
	private $_package_version;
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
		$this->_package_name	= 'Testee';
		$this->_package_version = '1.1.2';
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
	 * each add-on will define its own tests, in a /system/tests/addon_name/
	 * directory.
	 *
	 * @access	public
	 * @return	array
	 */
	public function get_tests()
	{
		$tests_path = PATH .'tests' .DIRECTORY_SEPARATOR;
		$tests = array();
		
		// Retrieve the contents of the third-party add-ons directory.
		if ( ! $all_addons = $this->get_directory_names($tests_path))
		{
			return $tests;
		}
		
		foreach ($all_addons AS $addon)
		{
			$test_dir_path = $tests_path .$addon .DIRECTORY_SEPARATOR;
			
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
				if ( ! preg_match('/^test[_|\.](.*)' .EXT .'$/i', $test))
				{
					continue;
				}
				
				$addon_tests[] = new Testee_test(array(
					'file_name' => $test,
					'file_path' => $test_dir_path .$test
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
		global $PREFS;
		
		if ( ! $this->_theme_folder_url)
		{
			$this->_theme_folder_url = $PREFS->ini('theme_folder_url');
			$this->_theme_folder_url .= substr($this->_theme_folder_url, -1) == '/'
				? 'cp_themes/default/'
				: '/cp_themes/default/';
				
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
		global $DB;
		
		$DB->query($DB->insert_string(
			'exp_modules',
			array(
				'has_cp_backend'		=> 'y',
				'module_id'				=> '',
				'module_name'			=> $this->get_package_name(),
				'module_version'		=> $this->get_package_version()
			)
		));

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
		global $DB;
		
		$db_module = $DB->query("SELECT module_id
			FROM exp_modules
			WHERE module_name = '{$this->get_package_name()}'");
			
		$DB->query("DELETE FROM exp_module_member_groups
			WHERE module_id = '{$db_module->row['module_id']}'");
		
		$DB->query("DELETE FROM exp_modules
			WHERE module_name = '{$this->get_package_name()}'");

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
