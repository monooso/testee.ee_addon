<?php

/**
 * Mock Weblog class.
 *
 * @see         http://www.simpletest.org/en/mock_objects_documentation.html
 * @package     Testee
 * @author      Stephen Lewis <addons@experienceinternet.co.uk>
 * @copyright   Experience Internet
 */

class Testee_mock_weblog {

    public $sql;

    /* --------------------------------------------------------------
     * PUBLIC PROPERTIES
     * --------------------------------------------------------------
        $limit
        $query
        $TYPE
        $entry_id
        $uri
        $uristr
        $return_data
        $tb_action_id
	    $basepath
	    $hit_tracking_id
        $sql
        $display_tb_rdf
        $cfields
        $dfields
        $rfields
        $mfields
        $categories
	    $catfields
        $weblog_name
        $weblogs_array
        $related_entries
        $reverse_related_entries
        $reserved_cat_segment
	    $use_category_names
	    $dynamic_sql
	    $tb_captcha_hash
	    $cat_request
	    $enable
        $category_list
	    $cat_full_array
	    $cat_array
	    $temp_array
	    $category_count
        $paginate
	    $field_pagination
        $paginate_data
        $pagination_links
        $page_next
        $page_previous
	    $current_page
	    $total_pages
	    $multi_fields
	    $display_by
	    $total_rows
	    $pager_sql
	    $p_limit
	    $p_page
	    $sql_cache_dir
	    $misc
     * ------------------------------------------------------------ */


    /* --------------------------------------------------------------
     * PUBLIC METHODS
     * ------------------------------------------------------------ */
    public function add_pagination_data() {}
    public function build_sql_query($qstring = '') {}
    public function calendar() {}
    public function categories() {}
    public function category_archive() {}
    public function category_heading() {}
    public function category_subtree($cdata = array()) {}
    public function category_totals() {}
    public function category_tree($cdata = array()) {}
    public function close_ul($parent_id, $depth = 0) {}
    public function create_pagination() {}
    public function entries() {}
    public function entry_form($return_form = FALSE, $captcha = '') {}
    public function fetch_cache($identifier = '') {}
    public function fetch_categories() {}
    public function fetch_custom_member_fields() {}
    public function fetch_custom_weblog_fields() {}
    public function fetch_pagination_data() {}
    public function find_parent($parent, $all) {}
    public function info() {}
    public function initialize() {}
    public function insert_new_entry() {}
    public function month_links() {}
    public function next_entry() {}
    public function parse_related_entries() {}
    public function parse_reverse_related_entries() {}
    public function parse_weblog_entries() {}
    public function process_subcategories($parent_id) {}
    public function related_entries() {}
    public function save_cache($sql, $identifier = '') {}
    public function track_views() {}
    public function trackback_rdf($TB) {}
    public function weblog_name() {}

}


/* End of file      : testee_mock_prefs.php */
/* File location    : system/modules/testee/classes/mocks/testee_mock_prefs.php */
