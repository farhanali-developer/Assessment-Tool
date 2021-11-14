<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Assessment_tool
 * @subpackage Assessment_tool/includes
 * @author     Farhan Ali <farhan@logikware.tech>
 */
class Assessment_tool_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$users_table = 'assessment_tool_users';
		$questions_table = 'assessment_tool_questions';
		$tabs_table = 'assessment_tool_tabs';
		$delete_table1 = "DROP TABLE IF EXISTS $users_table";
		$delete_table2 = "DROP TABLE IF EXISTS $questions_table";
		$delete_table3 = "DROP TABLE IF EXISTS $tabs_table";
		$wpdb->query($delete_table1);
		$wpdb->query($delete_table2);
		$wpdb->query($delete_table3);
		delete_option('e34s_time_card_version');
	}

}
