<section class="home-banner container">
	<div class="row">
        <div class="col-md-12 col-lg-12" id="main-banner-container" >
            <div id="main-banner">
            <?
                $args = array( 'numberposts' => -1, 'post_type' => 'mainpage_banner', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
              $results = get_posts( $args );
              foreach( $results as $result ) :
                $url = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID), 'full');
                $page_url = get_field("page_link",$result->ID);
            ?>
                <div class="main-banner-item">
                    <img class="img-responsive" src="<?=$url[0]?>" />
                    <div class="main-banner-text-container">
                        <span class="hero-txt">
                            <?=apply_filters('the_content', $result->post_content);?>
                        </span>
                        <!--<a class="btn-find-out-more" href="<?=$page_url?>"><?_e('Find out more');?></a>-->
                    </div>
                </div>
            <? endforeach;?>
            </div>
            <div>
                <div class="custom-banner-control-right">
                    <div class="custom-banner-next"></div>
                </div>
                <div class="custom-banner-control-left">
                    <div class="custom-banner-prev"></div>
                </div>
            </div>
        </div>
	</div>
</section>
<section class="promotion-banner container">
	<div class="row">
    	<div class="col-sm-6 col-md-6">
        	<? 
				$banner_img_left = get_field("left_banner",$post->ID);
				$banner_link_left = get_field("left_banner_link", $post->ID);
			?>
            <div class="well well-feature" href="<?=$banner_link_left?>" style="background-image:url(<?=$banner_img_left['url']?>);">
            	<div class="hidden-lg hidden-md hidden-sm">
                	<img src="<?=$banner_img_left['url']?>" class="img-responsive" />
                </div>
                <a href="<?=$banner_link_left?>"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
        	<? 
				$banner_img_right = get_field("right_banner",$post->ID);
				$banner_link_right = get_field("right_banner_link", $post->ID);
			?>
            <div class="well well-feature" href="<?=$banner_link_right?>" style="background-image:url(<?=$banner_img_right['url']?>);">
            	<div class="hidden-lg hidden-md hidden-sm">
                	<img src="<?=$banner_img_right['url']?>" class="img-responsive" />
                </div>
                <a href="<?=$banner_link_right?>"></a>
            </div>
        </div>
    </div>
</section>
<section class="best-seller container">
	<div class="best-seller-title-container clearfix">
    	<div class="col-xs-2 best-seller-title-left"></div>
        <div class="col-xs-8 best-seller-title-center">bestsellers</div>
        <div class="col-xs-2 best-seller-title-right"></div>
    </div>
	<div class="row">
    	<?
        	$best_sellers = get_field("best_seller", $post->ID);
			foreach( $best_sellers as $best_seller ){
				$best_seller_content = get_post($best_seller);
		?>
        	<!--<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            	<? echo do_shortcode('[product id="'.$best_seller->ID.'"]'); ?>
                
            </div>-->
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 best-seller-item">
                <a href="<?=get_permalink($best_seller)?>"><?=get_the_post_thumbnail( $best_seller->ID, 'full' );?></a>
                <div class="product-item-brief-wrapper">
                    <div class="product-item-brief-content">
                        <div class="product-series"><?=get_field("series",$best_seller);?></div>
                        <a href="<?=get_permalink($best_seller)?>"><?=$best_seller_content->post_title?></a>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</section>