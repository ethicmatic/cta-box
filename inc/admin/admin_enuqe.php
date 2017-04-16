<?php
function wppw_adding_admin_cta_box_stylesheet() {
    wp_register_style(
        'newstyleadmin',
        plugins_url( 'css/cta_admin_style.css', __FILE__ )
    );
    wp_enqueue_style( 'newstyleadmin' );
}
add_action( 'admin_enqueue_scripts', 'wppw_adding_admin_cta_box_stylesheet' );
require_once ('admin_modify.php');

add_action( 'admin_print_scripts-post-new.php', 'ctabox_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'ctabox_admin_script', 11 );

function ctabox_admin_script() {
    global $post_type;
    if( 'ctabox' == $post_type )
    wp_enqueue_script( 'portfolio-admin-script',  plugins_url( 'js/cta_boxadmin.js', __FILE__ ) );
}