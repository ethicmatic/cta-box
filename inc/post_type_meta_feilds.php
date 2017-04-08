<?php
function add_cta_box_metaboxes() {
	add_meta_box('cta_box_description', 'Box Description', 'cta_box_description_callback', 'CTA Box', 'normal', 'default');
	add_meta_box('cta_box_button_text', 'CTA Button Text', 'cta_box_button_text_callback', 'CTA Box', 'normal', 'default');
	add_meta_box('cta_box_button_id', 'CTA Button ID', 'cta_box_button_id_callback', 'CTA Box', 'normal', 'default');
	add_meta_box('cta_box_button_link', 'CTA Button Link', 'cta_box_button_link_callback', 'CTA Box', 'normal', 'default');
	add_meta_box('cta_box_show_shortcode', 'CTA Box Shortcode To Display', 'cta_box_show_shortcode_callback', 'CTA Box', 'side', 'high');
}
add_action( 'add_meta_boxes', 'add_cta_box_metaboxes' );


function cta_box_button_id_callback() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="ctaboxmeta_noncename" id="ctaboxmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$cta_box_button_id = get_post_meta($post->ID, 'cta_box_button_id', true);
	
	// Echo out the field
	echo '<input type="text" name="cta_box_button_id" value="' . $cta_box_button_id  . '" class="widefat" /><p class="description">Please enter the button ID wiithout any spaces!</p>';
	
}
function cta_box_button_text_callback() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="ctaboxmeta_noncename" id="ctaboxmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$cta_box_button_text = get_post_meta($post->ID, 'cta_box_button_text', true);
	
	// Echo out the field
	echo '<input type="text" name="cta_box_button_text" value="' . $cta_box_button_text  . '" class="widefat" />';
	
}
function cta_box_show_shortcode_callback() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="ctaboxmeta_noncename" id="ctaboxmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$postId  = $post->ID;
	$shortcode = '[wppw_cta_box id =' . $postId.']';
	// Echo out the field
	echo '<input type="text" value="' . $shortcode  . '" class="widefat"/>';
	
}
function cta_box_button_link_callback() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="ctaboxmeta_noncename" id="ctaboxmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$cta_box_button_link = get_post_meta($post->ID, 'cta_box_button_link', true);
	
	// Echo out the field
	echo '<input type="text" name="cta_box_button_link" value="' . $cta_box_button_link  . '" class="widefat"  />';
	
}
function cta_box_description_callback() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="ctaboxmeta_noncename" id="ctaboxmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$cta_box_description = get_post_meta($post->ID, 'cta_box_description', true);
	
	// Echo out the field
	echo '<textarea name="cta_box_description" value="" class="widefat"  rows="6">'. $cta_box_description  . '
</textarea>';

}
// Save the Metabox Data

function wpt_save_ctabox_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
		if (isset($_POST["cta_box_description"]) && !empty($_POST["cta_box_description"])) {
	if ( !wp_verify_nonce( $_POST['ctaboxmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	$ctabox_meta['cta_box_description'] = $_POST['cta_box_description'];
	$ctabox_meta['cta_box_button_id'] = $_POST['cta_box_button_id'];
	$ctabox_meta['cta_box_button_link'] = $_POST['cta_box_button_link'];
	$ctabox_meta['cta_box_button_text'] = $_POST['cta_box_button_text'];
	
	// Add values of $downloads_meta as custom fields
	
	foreach ($ctabox_meta as $key => $value) { // Cycle through the $downloads_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}
}

add_action('save_post', 'wpt_save_ctabox_meta', 1, 2); // save the custom fields