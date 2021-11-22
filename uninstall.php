<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

function uninstall_tables()
{
    global $wpdb;
		$users_table = 'assessment_tool_users';
		$tabs_table = 'assessment_tool_tabs';
		$questions_table = 'assessment_tool_questions';
		$settings_table = 'assessment_tool_settings';
		$delete_table1 = "DROP TABLE IF EXISTS $users_table";
		$delete_table2 = "DROP TABLE IF EXISTS $tabs_table";
		$delete_table3 = "DROP TABLE IF EXISTS $questions_table";
		$delete_table4 = "DROP TABLE IF EXISTS $settings_table";
		$wpdb->query($delete_table1);
		$wpdb->query($delete_table2);
		$wpdb->query($delete_table3);
		$wpdb->query($delete_table4);
		delete_option('e34s_time_card_version');
}

uninstall_tables();