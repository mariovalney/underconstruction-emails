<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sousatg.github.io
 * @since      1.0.0
 *
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Underconstruction_Emails
 * @subpackage Underconstruction_Emails/admin
 * @author     Tiago Sousa <tiagosousafl@gmail.com>
 */
class Underconstruction_Emails_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/underconstruction-emails-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/underconstruction-emails-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function add_admin_page(){
		add_menu_page(
			__('UC Registros'), 
			__('UC Registros'), 
			'manage_options', 
			'underconstruction', 
			array($this, 'render_dashboard'), 
			'dashicons-email', 
			72);		
	}
	
	public function render_dashboard(){
		include 'partials/underconstruction-emails-dashboard-display.php';
	}
	
	public function registry_registries(){
		$labels = array(
			'name'               => __('Registros', 'underconstruction-emails'),
			'singular_name'      => __('Registro', 'underconstruction-emails')
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __('E-mails cadastrados na página de "Em construção".', 'underconstruction-emails'),
			'public'             => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => false
		);

		register_post_type('jg_uc_registries', $args);		
	}
	
	public function wp_ajax_save_registry_callback() {
		$response = array('status' => 'error', 'msg' => 'Ops... dados incorretos. Por favor, tente novamente.');
		
		if (isset($_POST['email'])) {

			$args = array(
				'posts_per_page'   => -1,
				'meta_key'         => '_jg_uc_registry_email',
				'meta_value'       => $_POST['email'],
				'post_type'        => 'jg_uc_registries',
				'post_status'      => 'publish'
			);

			$registries = get_posts($args);
			
			if ( count($registries) > 0 ) {

				$response = array('status' => 'error', 'msg' => 'Esse e-mail já está cadastrado.');

			} else {

				$args = array(
					'post_title'    => $_POST['email'],
					'post_content'  => $_POST['email'],
					'post_status'   => 'publish',
					'post_type'     => 'jg_uc_registries'
				);

				// Save
				$registry = wp_insert_post($args);

				if ($registry) {
					$registry = update_post_meta($registry, '_jg_uc_registry_email', $_POST['email']);

					if ($registry) {
						$response = array('status' => 'ok', 'msg' => 'E-mail salvo! Agora é só aguardar a novidade.');
					} else {
						$response = array('status' => 'error', 'msg' => 'Não conseguimos salvar seu e-mail. Por favor, tente novamente.');
					}

				} else {
					$response = array('status' => 'error', 'msg' => 'Não conseguimos salvar seu e-mail. Por favor, tente novamente.');
				}

			}

		}
		
		wp_send_json($response);
	}
}