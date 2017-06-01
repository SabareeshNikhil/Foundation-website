<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce;

$product_id = $product->id;
$in_cart = '';

//check if product is already in the cart
if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
									
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		
		$_product = $values['data'];
											
		if ( $_product->id == $product_id ) {
			
			$in_cart = '<a href="'.site_url('cart').'">Already in cart <i class="fa fa-shopping-cart"></i></a>';
			
		} 
		
	}//foreach								
		
} 

?>

<div style="margin-bottom:10px;" class="pm-column-header product">
    <h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
    <div class="pm-column-header-block"></div>
</div>




<p class="pm-already-in-cart"><?php echo $in_cart; ?></p>