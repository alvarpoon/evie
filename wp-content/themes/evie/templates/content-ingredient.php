<? woocommerce_breadcrumb(); ?>
<section class="ingredient-section main-section-container container">
  <div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
    <div class="row">
      <!--<div class="headline-title-container clearfix">
    	<div class="col-xs-2 headline-title-left"></div>
      	<div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
      	<div class="col-xs-2 headline-title-right"></div>
      </div>-->
	  
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
	  <div class="ingredient-item-container">
	  	<?
			$args = array( 'numberposts' => -1, 'post_type' => 'ingredient', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
			$results = get_posts( $args );
			$count = 1;
			foreach( $results as $result ) :
				$url = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID), 'full');
				if($count%3 == 1){
					echo '<div class="ingreditent-row row">';
				}
				echo '<div class="col-sm-4"><img class="img-responsive" src="'.$url[0].'" /><div class="ingredient-content"><h2><span>'.$result->post_title.'</span></h2>'.apply_filters('the_content', $result->post_content).'</div></div>';
				if($count%3 == 0){
					echo '</div>';
				}
				$count++;
			endforeach;	?>
	  </div>
	</div>
  </div>
</section>