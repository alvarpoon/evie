<section class="home-banner container">
	<div class="row">
        <div class="col-md-8 col-lg-8" id="main-banner-container" >
            <div id="main-banner">
            <?
                $args = array( 'numberposts' => -1, 'post_type' => 'mainpage_banner', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
              $results = get_posts( $args );
              foreach( $results as $result ) :
                $url = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID), 'full');
                $page_url = get_field("page_link",$result->ID);
            ?>
                <div class="main-banner-item">
                    <img src="<?=$url[0]?>" />
                    <div class="main-banner-text-container">
                        <span class="hero-txt">
                            <?=apply_filters('the_content', $result->post_content);?>
                        </span>
                        <a class="btn-find-out-more" href="<?=$page_url?>"><?_e('Find out more');?></a>
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