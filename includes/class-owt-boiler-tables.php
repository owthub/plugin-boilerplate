<?php

/**
 * file contains definition of tables section
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
class Owt_Boiler_Tables {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	 public function owtboliertable(){
            global $wpdb;
            return $wpdb->prefix."owt_playlists"; // wp_owt_boiler_table
        }
        
}
