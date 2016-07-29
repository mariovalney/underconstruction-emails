<?php

    $path = dirname(__FILE__);
    $path = explode( 'wp-content', $path );
    $file = $path[0] . 'wp-blog-header.php';

    define( 'WP_USE_THEMES', false );
    require( $file );

    $filename = 'registros-' . date( 'Y-m-d' ) . '.csv';

    header( 'Content-Type: application/csv' );
    header( 'Content-Disposition: attachment; filename="'. $filename .'";' );

    $args = array(
        'posts_per_page'   => -1,
        'meta_key'         => '_jg_uc_registry_email',
        'post_type'        => 'jg_uc_registries',
        'post_status'      => 'publish',
    );

    $registries = get_posts($args);

    // open the "output" stream
    $stream = fopen( 'php://output', 'w' );

    fputcsv( $stream, array( 'E-mail', 'Data de Cadastro' ) );

    foreach ( $registries as $registry ) {
        $email = get_post_meta( $registry->ID, '_jg_uc_registry_email', true );
        $date = mysql2date( 'd/m/Y', $registry->post_date );
        
        fputcsv( $stream, array( $email, $date ) );
    }
?>