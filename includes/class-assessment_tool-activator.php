<?php

/**
 * Fired during plugin activation
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Assessment_tool
 * @subpackage Assessment_tool/includes
 * @author     Farhan Ali <farhan@logikware.tech>
 */
class Assessment_tool_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        global $wpdb;
        $wpdb->hide_errors();
        $users_table = 'assessment_tool_users';
        $tabs_table = 'assessment_tool_tabs';
        $questions_table = 'assessment_tool_questions';
        $charset_collate = $wpdb->get_charset_collate();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $users_query = "CREATE TABLE IF NOT EXISTS $users_table (
          `user_id` INT NOT NULL AUTO_INCREMENT,
          `full_name` VARCHAR(255) NOT NULL,
          `phone_number` BIGINT,
          `user_email` VARCHAR(255),
          PRIMARY KEY  (`user_id`)
        ) $charset_collate;";

        $tabs_query = "CREATE TABLE IF NOT EXISTS $tabs_table (
          `tab_id` INT NOT NULL AUTO_INCREMENT,
          `tab` VARCHAR(255) NOT NULL,
          PRIMARY KEY  (`tab_id`)
        ) $charset_collate;";

        $questions_query = "CREATE TABLE IF NOT EXISTS $questions_table (
          `question_id` INT NOT NULL AUTO_INCREMENT,
          `question` LONGTEXT NOT NULL,
          `marks` INT NOT NULL,
    	    `tab_id` INT NOT NULL,
          CONSTRAINT FOREIGN KEY (tab_id) REFERENCES $tabs_table(tab_id),
          PRIMARY KEY  (`question_id`)
        ) $charset_collate;";

        
        dbDelta( $users_query );
        dbDelta( $tabs_query );
        dbDelta( $questions_query );
        
	}

}