<?php
/*
Plugin Name: Under Construction E-mails
Description: Mostre uma página de "Em construção" para os usuários que não estão logados no seu site e aproveite para captar e-mails!
Version: BETA
Author: JANGAL
Author URI: http://www.jangal.com.br
Text Domain: underconstruction-emails
*/

class UnderconstructionEmail{
	
	public function __construct(){
		
		
		add_action('init', array($this, 'registry_registries'));
		
		// Admin Actions
		add_action('admin_menu', array($this, 'register_menu_page'));
		
		// Impede o acesso
		add_action('get_header', array($this, 'check_access'));
		
		// Ajax para salvar os registros
		add_action('wp_ajax_save_registry', array($this, 'wp_ajax_save_registry_callback'));
		add_action('wp_ajax_nopriv_save_registry', array($this, 'wp_ajax_save_registry_callback'));
	}
	
	// Registra o conteúdo
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
	
	
	public function register_menu_page(){
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
		include 'dashboard.php';
	}
	
	public function check_access($name){
		$jg_uc_is_active = get_option('jg_uc_is_active', '0');

		if ($jg_uc_is_active && !is_user_logged_in()) {
			//include "front-end.php";
			$this->display_front_end_page ();
			die();
		}
	}
	
	public function display_front_end_page(){
		include "front-end.php";

	}

	// Imprime URLs para os aruivos	
	public function get_asset($filename){
		return plugins_url($filename, __FILE__);		
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

$plugin = new UnderconstructionEmail();