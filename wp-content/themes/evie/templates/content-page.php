<section class="main-section-container container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>     
        </div>

        <div class="row">
          <div class="content-container">
            <?=apply_filters('the_content', $post->post_content);?>
          </div>     
        </div>
   	</div>
</section>