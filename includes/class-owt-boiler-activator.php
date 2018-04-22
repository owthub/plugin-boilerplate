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
            if(count($wpdb->get_var("Show tables like '".$this->table->owtboliertable()."'")) == 0){
                // need to write table generating code...
                $sqlQuery = 'CREATE TABLE `'.$this->table->owtboliertable().'` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) DEFAULT NULL,
                            `thumbnail` varchar(255) DEFAULT NULL,
                            `playlist_for` text DEFAULT NULL,
                            PRIMARY KEY (`id`)
                           ) ENGINE=InnoDB DEFAULT CHARSET=latin1';
                dbDelta($sqlQuery);
            }
            
	}
        

}
