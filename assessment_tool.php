<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://farhanali.me
 * @since             1.0.0
 * @package           Assessment_tool
 *
 * @wordpress-plugin
 * Plugin Name:       Assessment Tool
 * Plugin URI:        https://logikware.tech/plugins/assessment_tool
 * Description:       This plugin is for Assessment Tool, developed with specific requirements.
 * Version:           1.0.0
 * Author:            Farhan Ali
 * Author URI:        https://farhanali.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       assessment_tool
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ASSESSMENT_TOOL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-assessment_tool-activator.php
 */
function activate_assessment_tool() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-assessment_tool-activator.php';
	Assessment_tool_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-assessment_tool-deactivator.php
 */
function deactivate_assessment_tool() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-assessment_tool-deactivator.php';
	Assessment_tool_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_assessment_tool' );
register_deactivation_hook( __FILE__, 'deactivate_assessment_tool' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-assessment_tool.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_assessment_tool() {

	$plugin = new Assessment_tool();
	$plugin->run();

}
run_assessment_tool();
