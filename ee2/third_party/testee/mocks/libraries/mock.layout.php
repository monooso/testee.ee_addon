<?php

/**
 * Mock layout class.
 *
 * @see         http://www.simpletest.org/en/mock_objects_documentation.html
 * @package     Testee
 * @author      Stephen Lewis (http://experienceinternet.co.uk/)
 * @copyright   Experience Internet
 */

class Testee_mock_layout {
  
  /* --------------------------------------------------------------
   * PUBLIC PROPERTIES
   * --------------------------------------------------------------
    $custom_layout_fields
   * ------------------------------------------------------------ */
  
  // Magic methods to access properties.
  public function __get($prop_name) {}
  public function __set($prop_name, $prop_value) {}
  
  
  /* --------------------------------------------------------------
   * PUBLIC METHODS
   * ------------------------------------------------------------ */
  public function add_layout_fields($tabs = array(), $channel_id = array()) {}

  public function add_layout_tabs($tabs = array(), $namespace = '',
    $channel_id = array()) {}

  public function delete_channel_layouts($channel_id) {}
  public function delete_layout_fields($tabs, $channel_id = array()) {}

  public function delete_layout_tabs($tabs = array(), $namespace = '',
    $channel_id = array()) {}

  public function duplicate_layout($dupe_id, $channel_id) {}
  public function edit_channel_layouts($channel_id) {}

  public function sync_layout($fields = array(), $channel_id = '',
    $changes_only = TRUE) {}


}

/* End of file    : testee_mock_layout.php */
/* File location  : third_party/testee/classes/testee_mock_layout.php */
