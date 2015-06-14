<? woocommerce_breadcrumb(); ?>
<section class="promotion-section container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>
          <div class="headline-content">
          	<? the_content(); ?>
          </div>
  		</div>
        <div class="row">
          <?
          	$promotion_1_image = get_field("promotion_1_image",$post->ID);
			$promotion_1_heading = get_field("promotion_1_heading",$post->ID);
			$promotion_1_content = get_field("promotion_1_content",$post->ID);
			
			$promotion_2_image = get_field("promotion_2_image",$post->ID);
			$promotion_2_content = get_field("promotion_2_content",$post->ID);
			
			$promotion_3_image = get_field("promotion_3_image",$post->ID);
			$promotion_3_content = get_field("promotion_3_content",$post->ID);
			
		  ?>        	
          <div class="promotion_1_container clearfix">
              <div class="col-sm-6">
              	<div class="promotion_1_headline">
	              	<?=$promotion_1_heading?>
                </div>
                <div class="promotion_1_content">
	                <?=$promotion_1_content?>
                </div>
              </div>
              <div class="col-sm-6 promotion_1_image">
                <img class="img-responsive img-border" src="<?=$promotion_1_image['url']?>" />
              </div>
          </div>
          <div class="more-special-title">MORE SPECIAL OFFERS</div>
          <div class="clearfix">
          	<div class="col-sm-6 promotion_2_container col-same-height">
            	<div class="promotion_content_container">
	            	<img class="img-responsive img-border img-center" src="<?=$promotion_2_image['url']?>" />
	                <?=$promotion_2_content?>
                </div>
            </div>
            <div class="col-sm-6 promotion_3_container col-same-height">
            	<div class="promotion_content_container">
	                <img class="img-responsive img-border img-center" src="<?=$promotion_3_image['url']?>" />
    	            <?=$promotion_3_content?>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>