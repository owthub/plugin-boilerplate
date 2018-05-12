<?php

/**
 * Fired during plugin activation
 *
 * @link       http://onlinewebtutorhub.blogspot.in
 * @since      1.0.0
 *
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/includes
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Owt_Boiler_Activator {

    private $table;

    public function __construct($table_object) {
        $this->table = $table_object;
    }

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public function activate() {

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        global $wpdb;
        if (count($wpdb->get_var("Show tables like '" . $this->table->owtboliertable() . "'")) == 0) {
            // need to write table generating code...
            $sqlQuery = 'CREATE TABLE `' . $this->table->owtboliertable() . '` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) DEFAULT NULL,
                            `thumbnail` varchar(255) DEFAULT NULL,
                            `playlist_for` text DEFAULT NULL,
                            PRIMARY KEY (`id`)
                           ) ENGINE=InnoDB DEFAULT CHARSET=latin1';
            dbDelta($sqlQuery);
        }

        $this->boiler_create_page();
    }

    public function boiler_create_page() {

        global $wpdb;
        $is_slug_exists = $wpdb->get_row(
                $wpdb->prepare(
                        "SELECT * from " . $wpdb->prefix . "posts WHERE post_name = %s", "test-page"
                ), ARRAY_A
        );

        if (empty($is_slug_exists)) {
            $page = array();
            $page['post_title'] = "Test Page 1";
            $page['post_content'] = "Learning Platform for Wordpress Customization for Themes, Plugin and Widgets";
            $page['post_status'] = "publish";
            $page['post_name'] = "test-page";
            $page['post_type'] = "page";

            $post_id = wp_insert_post($page); // inserting data into wp_posts
            add_option("boiler_page", $post_id); // inserting data into wp_options table
        } else {
            
        }

        // generate the dynamic page
    }

}
