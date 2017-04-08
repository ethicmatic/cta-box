<?php
function wppw_cta_box_shortcode_out_put( $atts ) {
	$atts = shortcode_atts(
		array(
			'id' => 'no id',
		), $atts, 'wppw_cta_box' );
	ob_start();
	require ('box_display_template.php');
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'wppw_cta_box', 'wppw_cta_box_shortcode_out_put' );