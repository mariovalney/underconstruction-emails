<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://sousatg.github.io
 * @since             1.0.0
 * @package           Underconstruction_Emails
 *
 * @wordpress-plugin
 * Plugin Name:       Under Construction E-mails
 * Plugin URI:        https://github.com/sousatg/underconstruction-emails
 * Description:       Mostre uma página de "Em construção" para os usuários que não estão logados no seu site e aproveite para captar e-mails!
 * Version:           1.0.0
 * Author:            JANGAL
 * Author URI:        http://www.jangal.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       underconstruction-emails
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-underconstruction-emails-activator.php
 */
function activate_underconstruction_emails() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-underconstruction-emails-activator.php';
	Underconstruction_Emails_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-underconstruction-emails-deactivator.php
 */
function deactivate_underconstruction_emails() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-underconstruction-emails-deactivator.php';
	Underconstruction_Emails_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_underconstruction_emails' );
register_deactivation_hook( __FILE__, 'deactivate_underconstruction_emails' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-underconstruction-emails.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_underconstruction_emails() {

	$plugin = new Underconstruction_Emails();
	$plugin->run();

}
run_underconstruction_emails();
