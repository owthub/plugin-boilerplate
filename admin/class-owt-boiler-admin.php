<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://onlinewebtutorhub.blogspot.in
 * @since      1.0.0
 *
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/admin
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Owt_Boiler_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    private $tables;

    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        require_once OWT_BOILER_PLAGIN_DIR . 'includes/class-owt-boiler-tables.php';
        $this->tables = new Owt_Boiler_Tables();
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Owt_Boiler_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Owt_Boiler_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style("bootstrap.min.css", plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
        wp_enqueue_style("datatables.min.css", plugin_dir_url(__FILE__) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all');
        wp_enqueue_style("custom.css", plugin_dir_url(__FILE__) . 'css/custom.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Owt_Boiler_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Owt_Boiler_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script("bootstrap.min.js", plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script("datatables.js", plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script("notifyBar.js", plugin_dir_url(__FILE__) . 'js/jquery.notifyBar.js', array('jquery'), $this->version, true);
        wp_enqueue_script("validate.min.js", plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script("custom.js", plugin_dir_url(__FILE__) . 'js/custom.js', array('jquery'), $this->version, true);
        wp_localize_script("custom.js", "boiler_ajax_url", admin_url("admin-ajax.php"));
    }

    public function owt_menus_sections() {

        add_menu_page("OWT Playlists", "OWT Playlists", "manage_options", "owt-menus", array($this, "owt_playlists"), "
dashicons-admin-plugins", 30);

        add_submenu_page("owt-menus", "All Playlists", "All Playlists", "manage_options", "owt-menus", array($this, "owt_playlists"));

        add_submenu_page("owt-menus", "Add Playlist", "Add Playlist", "manage_options", "owt-add-plylist", array($this, "owt_add_playlist"));
    }

    public function owt_playlists() {
        include_once OWT_BOILER_PLAGIN_DIR . '/admin/partials/owt-menu-all-playlist.php';
    }

    public function owt_add_playlist() {
        include_once OWT_BOILER_PLAGIN_DIR . '/admin/partials/owt-menu-add-playlist.php';
    }

    public function owt_ajax_handler_fns() {
        $param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";
        global $wpdb;
        if (!empty($param) && $param == "save_playlist") {
            $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
            $url = isset($_REQUEST['image_url']) ? $_REQUEST['image_url'] : "";
            $levels = isset($_REQUEST['level']) ? $_REQUEST['level'] : "";
            // levels contains array value json_encode, serialize
            $levels = json_encode($levels);
            $wpdb->insert($this->tables->owtboliertable(), array(
                "name" => $name,
                "thumbnail" => $url,
                "playlist_for" => $levels
            ));
            if ($wpdb->insert_id > 0) {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Value has been inserted"
                ));
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Failed to insert"
                ));
            }
            //$this->tables->owtboliertable();
        } elseif (!empty($param) && $param == "delete_record_data") {
            $data_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
            $is_exists = $wpdb->get_row(
                    $wpdb->prepare(
                            "SELECT * from " . $this->tables->owtboliertable() . " WHERE id = %d", $data_id
                    ), ARRAY_A
            );
            if (!empty($is_exists)) {
                $wpdb->delete($this->tables->owtboliertable(), array(
                    "id" => $data_id
                ));
                ob_start(); //start
                include_once OWT_BOILER_PLAGIN_DIR . "/admin/partials/tmpl/plugin-tmpl-playlists.php";
                $template = ob_get_contents();
                ob_end_clean(); //end
                echo json_encode(array("status" => 1, "message" => "Record has deleted", "template" => $template));
            } else {
                echo json_encode(array("status" => 0, "message" => "No record found"));
            }
        }
        wp_die();
    }

}
