<?php

/**
 * Test-driven add-on development module.
 *
 * @package		Testee
 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright	Experience Internet
 */

$lang = array(
	
/* --------------------------------------------------------------
 * REQUIRED LANGUAGE STRINGS
 * ------------------------------------------------------------ */
'testee_module_name'        => 'Testee',
'testee_module_description' => 'Pain-free unit testing for ExpressionEngine add-ons.',

/* --------------------------------------------------------------
 * ADDONS INDEX
 * ------------------------------------------------------------ */
'test_link_title' => 'See the %addon_name% add-on tests',
'no_tests'        => 'No add-on tests were found.',
'or'              => 'or',
'retest'          => 'Repeat Tests',
'run_tests'       => 'Run Selected Tests',
'start_over'      => 'start over',
'test'            => 'test',
'tests'           => 'tests',

/* --------------------------------------------------------------
 * JSON ERRORS
 * ------------------------------------------------------------ */
'json_error__404' => "We couldn't find any tests for the requested add-on.",
'json_error__412' => "Your request was missing a valid 'addon' query string parameter.",
'json_error__500' => "Epic add-on fail! Something went wrong when running the tests. This usually means we couldn't locate the test files.",

// All done.
'' => ''

);

/* End of file		: lang.testee.php */
/* File location	: /system/expressionengine/third_party/testee/language/english/lang.testee.php */
