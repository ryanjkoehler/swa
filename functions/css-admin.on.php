<?php  


if ( is_admin() ) { 
    wp_register_style(
        'epi-admin-css',
        // get_bloginfo( 'stylesheet_directory' ) . '/css/site.css',
		// dirname( __FILE__ ) . '/css-admin.css',
		get_bloginfo( 'template_url' ) . '/functions/css-admin.css',
        false,
        0.1
    );
    wp_enqueue_style( 'epi-admin-css' );
}