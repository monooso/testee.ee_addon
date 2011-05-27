<?php

/**
 * Mock Email class.
 *
 * @see				http://www.simpletest.org/en/mock_objects_documentation.html
 * @package 		Testee
 * @author 			Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright		Experience Internet
 */

class Testee_mock_eemail {
	
	/* --------------------------------------------------------------
	 * PUBLIC PROPERTIES
	 * --------------------------------------------------------------
		$protocol
		$mailpath
		$smtp_host
		$smtp_user
		$smtp_pass
		$smtp_auth
		$smtp_port
		$smtp_timeout
		$debug
		$wordwrap
		$wrapchars
		$mailtype
		$charset
		$encoding
		$multipart
		$validate
		$priority
		$newline
		$crlf
		$bcc_batch_mode
		$bcc_batch_tot
		$safe_mode
		$send_multipart
	 * ------------------------------------------------------------ */
	
	// Magic methods to access properties.
	public function __get($prop_name) {}
	public function __set($prop_name, $prop_value) {}
	
	
	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */
	public function add_error_message($msg) {}
	public function add_header($header, $value) {}
	public function attach($filename, $disposition = 'attachment') {}
	public function batch_bcc_send() {}
	public function bcc($bcc, $limit = '') {}
	public function build_finalbody() {}
	public function build_headers() {}
	public function cc($cc) {}
	public function clean_email($email) {}
	public function initialize() {}
	public function from($from, $name = '') {}
	public function get_content_type() {}
	public function get_data() {}
	public function get_debug() {}
	public function get_encoding($return = TRUE) {}
	public function get_hostname() {}
	public function get_protocol($return = TRUE) {}
	public function good_message($msg) {}
	public function mail_spool() {}
	public function message($body, $alt = '') {}
	public function mime_message() {}
	public function mime_types($ext = '') {}
	public function prep_q_encoding($str, $from = FALSE) {}
	public function prep_quoted_printable($str, $charlim = '') {}
	public function print_message() {}
	public function remove_nl_callback($matches) {}
	public function reply_to($reply_to, $name = '') {}
	public function send() {}
	public function send_with_mail() {}
	public function send_with_sendmail() {}
	public function send_with_smtp() {}
	public function set_boundaries() {}
	public function send_command($cmd, $data = '') {}
	public function send_data($data) {}
	public function set_config_values() {}
	public function set_date() {}
	public function set_message_id() {}
	public function show_error_message() {}
	public function smtp_authenticate() {}
	public function smtp_connect() {}
	public function str_to_array($email) {}
	public function strip_html() {}
	public function subject($subject) {}
	public function to($to) {}
	public function unwrap_specials() {}
	public function valid_email($address) {}
	public function validate_email($email) {}
	public function word_wrap($str, $charlim = '') {}
	public function write_header_string() {}
	public function 
	public function 
	public function 
	
}


/* End of file		: testee_mock_eemail.php */
/* File location	: third_party/testee/classes/mocks/testee_mock_eemail.php */