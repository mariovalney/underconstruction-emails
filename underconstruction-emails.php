<?php
/*
Plugin Name: Under Construction E-mails
Description: Mostre uma página de "Em construção" para os usuários que não estão logados no seu site e aproveite para captar e-mails!
Version: BETA
Author: JANGAL
Author URI: http://www.jangal.com.br
Text Domain: underconstruction-emails
*/

// Registra o conteúdo
add_action('init', 'jg_underconstruction_registry_registries');
function jg_underconstruction_registry_registries() {
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

// Registra a Dashboard
add_action('admin_menu', 'jg_underconstruction_register_menu_page');
function jg_underconstruction_register_menu_page(){
    add_menu_page('UC Registros', 'UC Registros', 'manage_options', 'underconstruction', 'jg_underconstruction_render_dashboard', 'dashicons-email', 72);
}

// Renderiza a Dashboard
function jg_underconstruction_render_dashboard() {
    include 'dashboard.php';
}

// Impede o acesso
add_action('get_header', 'jg_underconstruction_check_access');
function jg_underconstruction_check_access($name) {
    $jg_uc_is_active = get_option('jg_uc_is_active', '0');

    if ($jg_uc_is_active && !is_user_logged_in()) {
        include "front-end.php";
        die();
    }
}

// Imprime URLs para os aruivos
function jg_uc_get_asset($filename) {
    return plugins_url($filename, __FILE__);
}

// Ajax para salvar os registros

add_action('wp_ajax_save_registry', 'wp_ajax_save_registry_callback');
add_action('wp_ajax_nopriv_save_registry', 'wp_ajax_save_registry_callback');

function wp_ajax_save_registry_callback() {
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