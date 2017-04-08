<?php
$cta_box_button_link = get_post_meta($atts['id'], 'cta_box_button_link', true);
$cta_box_description = get_post_meta($atts['id'], 'cta_box_description', true);
$cta_box_button_id = get_post_meta($atts['id'], 'cta_box_button_id', true);
$cta_box_button_text = get_post_meta($atts['id'], 'cta_box_button_text', true);
?>
<div class="cta_wrap container">
<h3 class="boxtittle"><?php echo get_the_title( $atts['id'] ) ?></h3>
<p><?php echo $cta_box_description ?></p>
<a id="<?php echo $cta_box_button_id ?>" class="cta_box_btn" href="<?php echo $cta_box_button_link ?>"><?php echo $cta_box_button_text ?></a>
</div>