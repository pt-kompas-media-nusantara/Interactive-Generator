<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://kompas.id
 * @since             1.0.1
 * @package           interactive-generator
 *
 * @wordpress-plugin
 * Plugin Name:       Interactive Generator
 * Plugin URI:        http://kompas.id
 * Description:       Plugin for Interactive Generator (Highcharts, Gallery, Timeline, etc)
 * Version:           1.0.1
 * Author:            Deny Ramadna <denyramanda07@gmail.com>
 * Author URI:        http://kompas.id
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       interactive-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'INTERACTIVE_GENERATOR_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-interactive-generator-activator.php
 */
function activate_interactive_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-interactive-generator-activator.php';
	Interactive_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-interactive-generator-deactivator.php
 */
function deactivate_interactive_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-interactive-generator-deactivator.php';
	Interactive_Generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_interactive_generator' );
register_deactivation_hook( __FILE__, 'deactivate_interactive_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-interactive-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_interactive_generator() {

	$plugin = new Interactive_Generator();
	$plugin->run();

}
run_interactive_generator();
