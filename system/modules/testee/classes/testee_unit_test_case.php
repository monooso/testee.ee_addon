<?php

/**
 * Test-driven add-on development module.
 *
 * @package     Testee
 * @author      Stephen Lewis <stephen@experienceinternet.co.uk>
 * @copyright   Experience Internet
 */

require_once PATH_MOD .'testee/simpletest/unit_tester' .EXT;
require_once PATH_MOD .'testee/simpletest/mock_objects' .EXT;
require_once PATH_MOD .'testee/classes/testee_equal_without_whitespace_expectation' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_db' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_db_cache' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_display' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_extensions' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_functions' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_input' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_language' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_localize' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_output' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_prefs' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_regex' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_session' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_template' .EXT;
require_once PATH_MOD .'testee/classes/mocks/testee_mock_weblog' .EXT;

class Testee_unit_test_case extends UnitTestCase {
    
    /**
     * Get things ready for the test.
     *
     * @access  public
     * @param   array       $mock_methods       Additional 'ad hoc' methods for the mock objects.
     *                                          e.g. array('db' => array('new_method_a', 'new_method_b'));
     * @return  void
     */
    public function setUp(Array $mock_methods = array())
    {
        global $DB, $DSP, $EXT, $FNS, $IN, $LANG, $LOC, $OUT, $PREFS, $REGX, $SESS, $TMPL;
        
        /**
         * Create the mock objects. A class prefix is used to avoid 'redeclared class'
         * errors when generating mock object classes.
         */
        
        $class_prefix = get_class($this);
        
        // EE's naming 'conventions' are all over the shop. This is an attempt to accommodate them.
        $mocks = array(
            array('class_name' => 'db'          , 'short_name' => 'db'),
            array('class_name' => 'db_cache'    , 'short_name' => 'db_cache'),
            array('class_name' => 'display'     , 'short_name' => 'dsp'),
            array('class_name' => 'extensions'  , 'short_name' => 'ext'),
            array('class_name' => 'functions'   , 'short_name' => 'fns'),
            array('class_name' => 'input'       , 'short_name' => 'in'),
            array('class_name' => 'language'    , 'short_name' => 'lang'),
            array('class_name' => 'localize'    , 'short_name' => 'loc'),
            array('class_name' => 'output'      , 'short_name' => 'out'),
            array('class_name' => 'preferences' , 'short_name' => 'prefs'),
            array('class_name' => 'regex'       , 'short_name' => 'regx'),
            array('class_name' => 'session'     , 'short_name' => 'sess'),
            array('class_name' => 'template'    , 'short_name' => 'tmpl'),
            array('class_name' => 'weblog'      , 'short_name' => 'weblog')
        );
        
        foreach ($mocks AS $mock)
        {
            $methods = isset($mock_methods[$mock['short_name']]) && is_array($mock_methods[$mock['short_name']])
                ? $mock_methods[$mock['short_name']]
                : array();

            Mock::generate('Testee_mock_' .$mock['class_name'], $class_prefix .'_mock_' .$mock['short_name'], $methods);
        }
        
        // Overwrite EE's objects with the mocks.
        $DB     = $this->_get_mock('db');
        $DSP    = $this->_get_mock('dsp');
        $EXT    = $this->_get_mock('ext');
        $FNS    = $this->_get_mock('fns');
        $IN     = $this->_get_mock('in');
        $LANG   = $this->_get_mock('lang');
        $LOC    = $this->_get_mock('loc');
        $OUT    = $this->_get_mock('out');
        $PREFS  = $this->_get_mock('prefs');
        $REGX   = $this->_get_mock('regx');
        $SESS   = $this->_get_mock('sess');
        $TMPL   = $this->_get_mock('tmpl');
    }
    
    
    
    /* --------------------------------------------------------------
     * PRIVATE & PROTECTED METHODS
     * ------------------------------------------------------------ */
    
    /**
     * Returns a mock object of the specified type.
     *
     * @access  protected
     * @param   string      $class      The class of mock object to return (e.g. 'db', or 'query').
     * @return  bool|object
     */
    protected function _get_mock($class = '')
    {
        $class_name = get_class($this) .'_mock_' .$class;
        
        if (class_exists($class_name))
        {
            return new $class_name();
        }
        
        return FALSE;
    }
    
}

/* End of file      : testee_unit_tester.php */
/* File location    : system/modules/testee/classes/testee_unit_tester.php */
