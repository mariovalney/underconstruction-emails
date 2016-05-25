<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://sousatg.github.io
 * @since      1.0.0
 *
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/includes
 * @author     Tiago Sousa <tiagosousafl@gmail.com>
 */
class Underconstruction_Emails_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'underconstruction-emails',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
