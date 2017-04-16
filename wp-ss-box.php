<?php 
/* 
Plugin Name: Switch CTA Box
Plugin URI: http://wppluginwiki.com/cta-box
Description: Switch CTA BOX anywhere you want in wordpress(ex. wordpress pages, posts, widgets)
Version: 1.0 
Author: Wp Plugin Wiki 
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
        plugins_url( '/css/cta_style.css', __FILE__ )
    );
    wp_enqueue_style( 'newstyle' );
}
add_action( 'wp_enqueue_scripts', 'wppw_adding_cta_box_stylesheet' );
add_filter( 'gettext', 'change_publish_button', 10, 2 );

function change_publish_button( $translation, $text ) {
if ( 'ctabox' == get_post_type())
if ( $text == 'Publish' )
    return 'Save';
else if ( $text == 'Save Draft' )
	return 'Save CTA Box';
return $translation;
}