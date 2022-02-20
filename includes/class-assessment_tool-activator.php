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
        $settings_table = 'assessment_tool_settings';
        $formdata_table = 'assessment_tool_formdata';
        $charset_collate = $wpdb->get_charset_collate();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $users_query = "CREATE TABLE IF NOT EXISTS $users_table (
          `id` INT NOT NULL AUTO_INCREMENT,
          `full_name` LONGTEXT NOT NULL,
          `phone_number` LONGTEXT,
          `user_email` LONGTEXT NOT NULL,
          `submission_date` DATE,
          `submission_time` TIME,
          `timezone` LONGTEXT,
          `allow_retake` BOOLEAN,
          PRIMARY KEY  (`id`)
        ) $charset_collate;";

        $tabs_query = "CREATE TABLE IF NOT EXISTS $tabs_table (
          `id` INT NOT NULL AUTO_INCREMENT,
          `tab_name` LONGTEXT NOT NULL,
          `chapter_title` LONGTEXT NOT NULL,
          `tab_description` LONGTEXT,
          PRIMARY KEY  (`id`)
        ) $charset_collate;";

        $questions_query = "CREATE TABLE IF NOT EXISTS $questions_table (
          `id` INT NOT NULL AUTO_INCREMENT,
          `question` LONGTEXT NOT NULL,
          `marks` INT NOT NULL,
    	    `tab_id` INT NOT NULL,
          CONSTRAINT FOREIGN KEY (tab_id) REFERENCES $tabs_table(id),
          PRIMARY KEY  (`id`)
        ) $charset_collate;";

        $formdata_query = "CREATE TABLE IF NOT EXISTS $formdata_table (
          `id` INT NOT NULL AUTO_INCREMENT,
          `tab_id` INT NOT NULL,
          `tab_name` LONGTEXT NOT NULL,
          `chapter_title` LONGTEXT NOT NULL,
          `tab_marks` INT NOT NULL,
          `question_id` INT NOT NULL,
          `question_tab_id` INT NOT NULL,
          `question` LONGTEXT NOT NULL,
          `question_marks` INT NOT NULL,
          `question_answer` VARCHAR(255) NOT NULL,
          `user_id` INT NOT NULL,
          CONSTRAINT FOREIGN KEY (user_id) REFERENCES $users_table(id),
          PRIMARY KEY  (`id`)
        ) $charset_collate;"; 

        $settings_query = "CREATE TABLE IF NOT EXISTS $settings_table (
          `id` INT NOT NULL AUTO_INCREMENT,
          `setting_name` LONGTEXT,
          `setting_value` LONGTEXT,
          PRIMARY KEY  (`id`)
        ) $charset_collate; INSERT INTO $settings_table(setting_name, setting_value) VALUES('email',''),('password',''),('subject',''), ('theme','arrows'), ('animation','fade'), ('animation_speed','400'), ('alignment','1'), ('mode','0'), ('welcome_screen_text',''), ('end_screen_text','')";
        
        dbDelta( $users_query );
        dbDelta( $tabs_query );
        dbDelta( $questions_query );
        dbDelta( $formdata_query );
        dbDelta( $settings_query );
	}
}