<? woocommerce_breadcrumb(); ?>
<section class="two-col-section main-section-container container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>
          <?
          if(has_post_thumbnail($post->ID)){
          ?>
          <div class="feature-image">
            <? the_post_thumbnail( 'full', array('class'=>'img-responsive')); ?>
          </div>
          <?
          }
          if($post->post_content!=""){
          ?>
            <div class="headline-content col-xs-10 col-xs-push-1">
              <?=apply_filters('the_content', $post->post_content);?>
            </div>
          <?
          }
          ?>
  		</div>
        <div class="row">
            <div class="col-sm-12">
            	<? 
				$show_pattern = get_field("show_pattern_on_the_right", $post->ID);
				if($show_pattern) {?>
	                <div class="hidden-xs col-sm-4 col-same-height">                 
                        <div class="col-xs-10 col-pattern"></div>
                    </div>
                    <? }else{ ?>
                    <div class="hidden-xs col-sm-5 col-same-height">
	                    <div class="left-content">
    	                <? 
        	                $left_content = get_field("left_content",$post->ID);
            	            echo $left_content;						
                	    ?>
                    	</div>
                    </div>
                    <? } ?>
                <div class="col-xs-12 col-sm-7 col-same-height right-content">
                    <?
                        $right_content = get_field("right_content",$post->ID);
                        echo $right_content;						
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>