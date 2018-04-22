<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://onlinewebtutorhub.blogspot.in
 * @since      1.0.0
 *
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Owt_Boiler
 * @subpackage Owt_Boiler/includes
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Owt_Boiler_Deactivator {

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
    public function deactivate() {
        //drop table code
        global $wpdb;
        $wpdb->query("Drop table IF EXISTS " . $this->table->owtboliertable());
    }

}
