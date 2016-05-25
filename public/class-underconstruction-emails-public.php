<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://sousatg.github.io
 * @since      1.0.0
 *
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/public
 * @author     Tiago Sousa <tiagosousafl@gmail.com>
 */
class Underconstruction_Emails_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Underconstruction_Emails_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Underconstruction_Emails_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/underconstruction-emails-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Underconstruction_Emails_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Underconstruction_Emails_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/underconstruction-emails-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function check_access(){
		$jg_uc_is_active = get_option('jg_uc_is_active', '0');

		if ($jg_uc_is_active && !is_user_logged_in()) {
			//include "front-end.php";
			$this->display_front_end_page();
			die();
		}		
	}
	
	public function display_front_end_page(){
		include 'partials/underconstruction-emails-front-end.php';
	}
}
