<?php 
/* 
Plugin Name: Switch CTA Box
Plugin URI: http://wordpress.org/plugins/switch-cta-box
Description: Switch CTA BOX anywhere you want in wordpress(ex. wordpress pages, posts, widgets)
Version: a1.0
Author: @ash.if
Author URI: http://wppluginwiki.com/
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed this file directly
}
require_once ('inc/post_type.php');

add_filter('widget_text','do_shortcode');

function wppw_adding_cta_box_stylesheet() {
    wp_register_style(
        'newstyle',
        plugins_url( '/inc/cta_style.css', __FILE__ )
    );
    wp_enqueue_style( 'newstyle' );
}
add_action( 'wp_enqueue_scripts', 'wppw_adding_cta_box_stylesheet' );