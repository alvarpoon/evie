<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="clearfix">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		 
		do_action( 'woocommerce_before_single_product_summary' );
	?>

        <div class="summary entry-summary">
                    
            <div class="product-title">
                <h1><?=$post->post_title?></h1>
                <?=$post->post_excerpt?>
            </div>
            <div class="product-content">
                <?=$post->post_content?>
            </div>
            <div class="product-spec">
                <?=get_field("spec",$post->ID);?>
            </div>
    
        </div><!-- .summary -->
    </div>
	<div class="product-other-detail-container">
    	<div class="clearfix">
        	<div class="double-border-top-left col-xs-1"></div>
            <div class="double-border-top-mid col-xs-10"></div>
            <div class="double-border-top-right col-xs-1"></div>
        </div>
        <div class="clearfix">
            <div class="product-other-detail-item col-xs-12 col-sm-6 col-md-6">
                <h2>ingredients</h2>
                <?=get_field("how_to_use",$post->ID)?>
            </div>
            <div class="product-other-detail-item col-xs-12 col-sm-6 col-md-6">
                <h2>how to use</h2>
                <?=get_field("ingredients",$post->ID)?>
            </div>
        </div>
        <div class="clearfix">
        	<div class="double-border-btm-left col-xs-1"></div>
            <div class="double-border-btm-mid col-xs-10"></div>
            <div class="double-border-btm-right col-xs-1"></div>
        </div>
    </div>
    
    
	<?php
		
		/*if (!function_exists('woocommerceframework_upsell_display')) {
			function woocommerceframework_upsell_display() {
				woocommerce_upsell_display(3,3); // 3 products, 3 columns
			}
		}
		
		add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerceframework_upsell_display', 15 );
		do_action('woocommerce_after_single_product_summary_custom');*/
		
		global $product;

		$upsells = $product->get_upsells();
		
		if(count($upsells) > 0){
			echo '<section class="upsells-container">';
	    	echo '<h2>you may also like</h2>';
			echo '<div class="row">';
			foreach($upsells as $upsell){
				$upsell_content = get_post($upsell);
				?>
            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                	<a href="<?=get_permalink($upsell)?>"><?=get_the_post_thumbnail( $upsell, 'full' );?></a>
                    <div class="product-item-brief-wrapper">
                        <div class="product-item-brief-content">
                            <div class="product-series"><?=get_field("series",$upsell);?></div>
                            <a href="<?=get_permalink($upsell)?>"><?=$upsell_content->post_title?></a>
                        </div>
                    </div>
                </div>
			<? }
			echo '</div>';
			echo '</section>';
		}
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
