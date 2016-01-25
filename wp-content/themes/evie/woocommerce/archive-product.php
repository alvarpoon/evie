<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//get_header( 'shop' ); 
?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>
		<section class="product-category-section container">
		<div class="col-sm-10 main-content-wrapper">
            <div class="headline-title-container clearfix">
				<div class="headline-top clearfix">
					<div class="border-top-left col-xs-1 noPadding"></div>
					<div class="border-top-mid col-xs-10 noPadding"></div>
					<div class="border-top-right col-xs-1 noPadding"></div>
				</div>
				<div class="headline-mid">
					<!--<div class="col-xs-1 headline-title-left"></div>
					<div class="col-xs-10 headline-title-center"><?php woocommerce_page_title(); ?></div>
					<div class="col-xs-1 headline-title-right"></div>-->
					<?php woocommerce_page_title(); ?>
				</div>
				<div class="headline-btm clearfix">
					<div class="border-btm-left col-xs-1 noPadding"></div>
					<div class="border-btm-mid col-xs-10 noPadding"></div>
					<div class="border-btm-right col-xs-1 noPadding"></div>
				</div>
            </div>
    
            <?php if ( have_posts() ) : ?>
                    
                    <?php do_action( 'woocommerce_archive_description' ); ?>
                    
                    <?php woocommerce_product_loop_start(); ?>
        
                        <?php woocommerce_product_subcategories(); ?>
        
                        <?php while ( have_posts() ) : the_post(); ?>
        
                            <?php wc_get_template_part( 'content', 'product' ); ?>
        
                        <?php endwhile; // end of the loop. ?>
        
                    <?php woocommerce_product_loop_end(); ?>
                    
                    
        
                    <?php
                        /**
                         * woocommerce_after_shop_loop hook
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    ?>
        
                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
        
                    <?php wc_get_template( 'loop/no-products-found.php' ); ?>
    
            <?php else: ?>

                <p style="  margin-top: 40px;"><? _e('Coming soon…')?></p>

            <?php endif; ?>
   
        </div>
        </section>
<?php //get_footer( 'shop' ); ?>
