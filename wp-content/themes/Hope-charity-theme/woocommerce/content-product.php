<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $woocommerce;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
	
$product_id = $product->id;
$in_cart = '';

//check if product is already in the cart
if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
									
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		
		$_product = $values['data'];
											
		if ( $_product->id == $product_id ) {
			
			$in_cart = 'in_cart';
			
		} 
		
	}//foreach								
		
} 
	
?>

<?php

	$pageLayout = '';

	if( is_shop() ){
		
		$page_id = get_option( 'woocommerce_shop_page_id' );
		$pageLayout = get_post_meta($page_id, 'pageLayout', true);
		
	} else {
		
		global $has_sidebar;
		if($has_sidebar){
			$pageLayout = 'left-sidebar'; //this can be left or right sidebar - we just need activate sidebar mode
		} 
		
	}


	if($pageLayout == 'left-sidebar' || $pageLayout == 'right-sidebar') {
		//displays on Related products
		echo '<div class="span4">';
	} else {
		//displays on Shop page
		echo '<div class="span3">';
	}

?>



    <div <?php post_class( $classes ); ?>>
    
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
        <div class="pm-added-to-cart-icon <?php echo $in_cart; ?>">
            <a href="<?php echo site_url('cart') ?>"><i class="fa fa-shopping-cart"></i></a>
        </div>
    
        	<a href="<?php the_permalink(); ?>">
                <div class="pm-product-img-hover-container">
                    <div class="pm-product-img-hover-icon">
                        <i class="icon-search"></i>
                    </div>
                                        
                    <?php
                        /**
                         * woocommerce_before_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                </div>
            </a>
    
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
            <div class="pm-product-meta-info-container">
                
        
                <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
                
                <div class="pm-product-divider"></div>
                <div class="pm-product-divider"></div>
                
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                
                <div class="pm-product-view-details">
                	<a href="<?php the_permalink(); ?>"><?php _e('View Details', 'localization'); ?></a>
                </div>
                
            </div>
        
    
    </div>

</div><!-- /col -->