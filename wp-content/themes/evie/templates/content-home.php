<section class="home-banner container">
	<div class="row">
        <div class="col-md-12 col-lg-12 noPadding hidden-xs visible-sm visible-md visible-lg main-banner-container">
            <div id="main-banner">
            <?
                $args = array( 'numberposts' => -1, 'post_type' => 'mainpage_banner', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
              $results = get_posts( $args );
              foreach( $results as $result ) :
                $url = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID), 'full');
                $page_url = get_field("link",$result->ID);
            ?>
                <div class="main-banner-item">
                    <?=($page_url==""?"":'<a href="'.$page_url.'">');?><img class="img-responsive" src="<?=$url[0]?>" /><?=($page_url==""?"":'</a>');?>
                    <div class="main-banner-text-container">
                        <span class="hero-txt">
                            <?=apply_filters('the_content', $result->post_content);?>
                        </span>
                    </div>
                </div>
            <? endforeach;?>
            </div>
			<div class="custom-banner-next desktop-banner-next"></div>
			<div class="custom-banner-prev desktop-banner-prev"></div>
        </div>
        
        <div class="col-md-12 col-lg-12 noPadding visible-xs hidden-sm hidden-md hidden-lg main-banner-container">
            <div id="main-mobile-banner">
            <?
                $args = array( 'numberposts' => -1, 'post_type' => 'mainpage_banner', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
              $results = get_posts( $args );
              foreach( $results as $result ) :
				$url = get_field("mobile_banner",$result->ID);
                $page_url = get_field("link",$result->ID);
            ?>
                <div class="main-banner-item">
                    <?=($page_url==""?"":'<a href="'.$page_url.'">');?><img class="img-responsive" src="<?=$url?>" /><?=($page_url==""?"":'</a>');?>
                    <div class="main-banner-text-container">
                        <span class="hero-txt">
                            <?=apply_filters('the_content', $result->post_content);?>
                        </span>
                    </div>
                </div>
            <? endforeach;?>
            </div>
			<div class="custom-banner-next mobile-banner-next"></div>
			<div class="custom-banner-prev mobile-banner-prev"></div>
        </div>
	</div>
</section>
<div class="container">
    <div class="col-sm-10 col-sm-push-1">
        <section class="promotion-banner">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <? 
                        $banner_img_left = get_field("left_banner",$post->ID);
                        $banner_link_left = get_field("left_banner_link", $post->ID);
                    ?>
                    <div class="well well-feature" href="<?=$banner_link_left?>" style="background-image:url(<?=$banner_img_left['url']?>);">
                        <div class="hidden-lg hidden-md hidden-sm">
                            <a href="<?=$banner_link_left?>"><img src="<?=$banner_img_left['url']?>" class="img-responsive" /></a>
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
                            <a href="<?=$banner_link_right?>"><img src="<?=$banner_img_right['url']?>" class="img-responsive" /></a>
                        </div>
                        <a href="<?=$banner_link_right?>"></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="best-seller">
            <!--<div class="headline-title-container clearfix">
                <div class="col-xs-2 headline-title-left"></div>
                <div class="col-xs-8 headline-title-center">bestsellers</div>
                <div class="col-xs-2 headline-title-right"></div>
            </div>-->
			<div class="headline-title-container clearfix">
			<div class="headline-top clearfix">
				<div class="border-top-left col-xs-1 noPadding"></div>
				<div class="border-top-mid col-xs-10 noPadding"></div>
				<div class="border-top-right col-xs-1 noPadding"></div>
			</div>
			<div class="headline-mid"><?= _e('bestsellers'); ?></div>
			<div class="headline-btm clearfix">
				<div class="border-btm-left col-xs-1 noPadding"></div>
				<div class="border-btm-mid col-xs-10 noPadding"></div>
				<div class="border-btm-right col-xs-1 noPadding"></div>
			</div>
		</div>
            <div class="row">
                <?
                    $best_sellers = get_field("best_seller", icl_object_id($post->ID, 'page', false,ICL_LANGUAGE_CODE));
                    foreach( $best_sellers as $best_seller ){
                        $best_seller_content = get_post($best_seller);
                ?>
                    <!--<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <? echo do_shortcode('[product id="'.$best_seller->ID.'"]'); ?>
                        
                    </div>-->
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 best-seller-item">
                        <a href="<?=get_permalink($best_seller)?>"><?=get_the_post_thumbnail( $best_seller->ID, 'medium' );?></a>
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
    </div>
</div>