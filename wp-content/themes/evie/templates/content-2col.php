<? woocommerce_breadcrumb(); ?>
<section class="story-section container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>
          <div class="feature-image">
          	<? the_post_thumbnail( 'full', array('class'=>'img-responsive')); ?>
          </div>
          <div class="headline-content col-xs-11">
          	<? the_content(); ?>
          </div>
  		</div>
        <div class="row">
         	<div class="col-sm-12">
            	<div class="col-sm-4">
                	
                </div>
                <div class="col-sm-8">
                	<?
                    	$right_content = get_field("right_content",$post->ID);
						echo $right_content;						
					?>
                </div>
            </div>
        </div>
    </div>
</section>