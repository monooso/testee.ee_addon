<?php

/**
 * Testee NSM Add-on Updater information.
 *
 * @author          Stephen Lewis (http://github.com/experience/)
 * @copyright       Experience Internet
 * @package         Testee
 * @version         2.2.2
 */

if ( ! defined('TESTEE_NAME'))
{
  define('TESTEE_NAME', 'Testee');
  define('TESTEE_VERSION', '2.2.2');
}

$config['name']     = TESTEE_NAME;
$config['version']  = TESTEE_VERSION;
$config['nsm_addon_updater']['versions_xml']
  = 'http://experienceinternet.co.uk/software/feeds/testee';

/* End of file      : config.php */
/* File location    : third_party/campaigner/config.php */
