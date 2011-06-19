<?php

/**
 * Mock email class.
 *
 * @see         http://codeigniter.com/user_guide/libraries/email.html
 * @see         http://www.simpletest.org/en/mock_objects_documentation.html
 * @package     Testee
 * @author      Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright   Experience Internet
 */

class Testee_mock_email {

    /* --------------------------------------------------------------
     * CODEIGNITER PUBLIC PROPERTIES
     * --------------------------------------------------------------
        $useragent
        $mailpath
        $protocol
        $smtp_host
        $smtp_user
        $smtp_pass
        $smtp_port
        $smtp_timeout
        $wordwrap
        $wrapchars
        $mailtype
        $charset
        $multipart
        $alt_message
        $validate
        $priority
        $newline
        $crlf
        $send_multipart
        $bcc_batch_mode
        $bcc_batch_size
        $_safe_mode
        $_subject
        $_body
        $_finalbody
        $_alt_boundary
        $_atc_boundary
        $_header_str
        $_smtp_connect
        $_encoding
        $_IP
        $_smtp_auth
        $_replyto_flag
        $_debug_msg
        $_recipients
        $_cc_array
        $_bcc_array
        $_headers
        $_attach_name
        $_attach_type
        $_attach_disp
        $_protocols
        $_base_charsets
        $_bit_depths
        $_PRIORITIES
     * ------------------------------------------------------------ */

    // Magic methods to access properties.
    public function __get($prop_name) {}
    public function __set($prop_name, $prop_value) {}



    /* --------------------------------------------------------------
     * PUBLIC CODEIGNITER METHODS
     * ------------------------------------------------------------ */

    public function attach($filename, $disposition = 'attachment') {}
    public function batch_bcc_send() {}
    public function bcc($bcc, $limit = '') {}
    public function cc($cc) {}
    public function clean_email($email) {}
    public function clear($clear_attachments = FALSE) {}
    public function from($from, $name = '') {}
    public function print_debugger() {}
    public function reply_to($replyto, $name = '') {}
    public function send() {}
    public function set_alt_message($str = '') {}
    public function set_crlf($crlf = "\n") {}
    public function set_mailtype($type = 'text') {}
    public function set_newline($newline = "\n") {}
    public function set_priority($n = 3) {}
    public function set_protocol($protocol = 'mail') {}
    public function set_wordwrap($wordwrap = TRUE) {}
    public function subject($subject) {}
    public function to($to) {}
    public function valid_email($address) {}
    public function validate_email($email) {}
    public function word_wrap($str, $charlim = '') {}

    // Unused or overwritten by EE.
    // public function initialize($config = array()) {}
    // public function message($body) {}


    /* --------------------------------------------------------------
     * PUBLIC EXPRESSIONENGINE METHODS
     * ------------------------------------------------------------ */
    
    public function EE_initialize() {}
    public function message($body, $alt = '') {}
    


}


/* End of file      : testee_mock_email.php */
/* File location    : third_party/testee/classes/testee_mock_email.php */
