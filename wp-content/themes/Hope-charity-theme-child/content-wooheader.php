<?php
//The header template page/search/404

global $woocommerce;
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="pm-subpage-header-info">
            
            	<?php if(is_product()) { ?>
                	<h2 class="pm_page_title"><?php the_title(); ?></h2> 
                <?php } else { ?>
                	<h2 class="pm_page_title"><?php woocommerce_page_title(); ?></h2> 
                <?php } ?>
                
                
                <?php				
					$args = array(
							'delimiter' => '<li> / </li>',
							'wrap_before' => '<ul class="woocommerce-breadcrumb" itemprop="breadcrumb">',
							'wrap_after' => '</ul>',
							'before' => '<li>',
							'after' => '</li>',
					);
				?>
				<?php woocommerce_breadcrumb( $args ); ?>

                 
            </div>
        </div>
    </div>
</div>
