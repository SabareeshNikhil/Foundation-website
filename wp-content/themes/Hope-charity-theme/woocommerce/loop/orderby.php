<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
?>

<!--<ul class="orderby order-dropdown pm-order-by-dropdown" id="pm-order-by-dropdown">

	<li>
      <li><a href="?orderby=menu_order&product_orderby=price">Sort by <strong>Default Order</strong></a></li>
      <ul>      
           
           <li><a href="?orderby=popularity&product_orderby=price">Sort by <strong>Popularity</strong></a></li>
           <li><a href="?orderby=rating&product_orderby=price">Sort by <strong>Rating</strong></a></li>
           <li><a href="?orderby=date&product_orderby=price">Sort by <strong>Latest</strong></a></li>
           <li><a href="?orderby=price&product_orderby=price">Sort by <strong>Lowest Price</strong></a></li>
           <li><a href="?orderby=price-desc&product_orderby=price">Sort by <strong>Highest Price</strong></a></li>
      </ul>
    </li>

</ul>-->

<?php 

	$currentOrderBy = 'default';

	if( isset($_GET['orderby']) ){
		
		$orderby = $_GET['orderby'];
		
		if($orderby == 'menu_order'){
			$currentOrderBy = 'Default Order';
		}
		if($orderby == 'popularity'){
			$currentOrderBy = 'Popularity';
		}
		if($orderby == 'rating'){
			$currentOrderBy = 'Rating';
		}
		if($orderby == 'date'){
			$currentOrderBy = 'Latest';
		}
		if($orderby == 'price'){
			$currentOrderBy = 'Lowest Price';
		}
		if($orderby == 'price-desc'){
			$currentOrderBy = 'Highest Price';
		}
		
	}

?>

<?php 

	if( !isset($_GET['s']) ){
		
		?>
        
        <!-- dropdown -->
        <div class="pm-dropdown pm-shop-filter-menu">
            <div class="pm-dropmenu">
                <p class="pm-menu-title"><?php _e('Sort by', 'localization'); ?> <?php echo $currentOrderBy; ?> </p>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="pm-dropmenu-active">
                <ul>
                   <li><a href="?orderby=menu_order&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Default Order', 'localization'); ?></strong></a></li>
                   <li><a href="?orderby=popularity&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Popularity', 'localization'); ?></strong></a></li>
                   <li><a href="?orderby=rating&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Rating', 'localization'); ?></strong></a></li>
                   <li><a href="?orderby=date&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Latest', 'localization'); ?></strong></a></li>
                   <li><a href="?orderby=price&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Lowest Price', 'localization'); ?></strong></a></li>
                   <li><a href="?orderby=price-desc&product_orderby=price"><?php _e('Sort by', 'localization'); ?> <strong><?php _e('Highest Price', 'localization'); ?></strong></a></li>
                </ul>
            </div>
        </div> 
        <!-- /dropdown -->
        
        <?php
		
	}

?>



<?php return; ?>

<form class="woocommerce-ordering" method="get">

	<select name="orderby" class="orderby">
		<?php
			$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by newness', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
				unset( $catalog_orderby['rating'] );

			foreach ( $catalog_orderby as $id => $name )
				echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
		?>
	</select>
    
    
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' == $key )
				continue;
			
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>
