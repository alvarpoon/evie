<? woocommerce_breadcrumb(); ?>
<section class="promotion-section main-section-container container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
			<div class="headline-top clearfix">
				<div class="border-top-left col-xs-1 noPadding"></div>
				<div class="border-top-mid col-xs-10 noPadding"></div>
				<div class="border-top-right col-xs-1 noPadding"></div>
			</div>
			<div class="headline-mid">
				<? the_title(); ?>
			</div>
			<div class="headline-btm clearfix">
				<div class="border-btm-left col-xs-1 noPadding"></div>
				<div class="border-btm-mid col-xs-10 noPadding"></div>
				<div class="border-btm-right col-xs-1 noPadding"></div>
			</div>
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
          <div class="more-special-title"><?= _e('MORE SPECIAL OFFERS'); ?></div>
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