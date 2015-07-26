<? woocommerce_breadcrumb(); ?>
<section class="media-coverage-section main-section-container container">
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
      <div class="media-item-container clearfix">
			<?
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            	$args = array( 
					'posts_per_page' => 10,
					'paged' => $paged,
					'numberposts' => -1, 
					'post_type' => 'media', 
					'post_status' => 'publish', 
					'order' => 'DESC', 
					'orderby' => 'date', 
					'suppress_filters' => 0
				);
            	//$results = get_posts( $args );
				$postslist  = new WP_Query( $args );
				$count = 1;
				
				//echo $paged;
				
				if ( $postslist ->have_posts() ) :					
					while ( $postslist ->have_posts() ) : $postslist ->the_post(); 	
						$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
						$media_image = get_field("popup_image",$post->ID);
						if($count%5 == 1){
							echo '<div class="row">';
						}
						
						echo '<div class="media-item"><a class="fancybox-effects-c" href="'.$media_image['url'].'"><img class="img-responsive" src="'.$url[0].'" /></a><div class="media-headline">'.$post->post_title.'</div></div>';
						
						if($count%5 == 0){
							echo '</div>';
						}
						$count++;
					endwhile;
			?>
      </div>
	  <?
			  	echo '<div class="pagination clearfix">';
				echo '<div class="previous">';
				next_posts_link( 'Previous', $postslist ->max_num_pages );
				echo '</div>';
				echo '<div class="next">';
				previous_posts_link( 'Next' ); 
				echo '</div></div>';			
			wp_reset_postdata();
		endif;
	  ?>
    </div>
    <!-- end outer row --> 
  </div>
</section>