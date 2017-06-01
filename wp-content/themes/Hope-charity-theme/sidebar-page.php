<?php 

$options = '';
$sidebar_choice = '';

if(function_exists('is_shop')){
	
	if( is_shop() ){
		$options = get_post_custom(get_option( 'woocommerce_shop_page_id' ));	
	} else {
		$options = get_post_custom($post->ID);
	}
	
} else {
	$options = get_post_custom($post->ID);
}

if(isset($options['custom_sidebar'][0])){
	$sidebar_choice = $options['custom_sidebar'][0];
}


?>

<div class="span4 pm-sidebar">
	<aside>
    	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar($sidebar_choice) ) : ?>
    	<?php endif; ?>
    </aside>
</div><!-- /sidebar -->