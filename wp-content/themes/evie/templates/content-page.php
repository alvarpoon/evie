<section class="main-section-container container">
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
        </div>

        <div class="row">
          <div class="content-container">
            <?=apply_filters('the_content', $post->post_content);?>
          </div>     
        </div>
   	</div>
</section>