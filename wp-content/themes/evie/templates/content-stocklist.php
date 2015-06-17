<? woocommerce_breadcrumb(); ?>
<section class="stocklist-section main-section-container container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>
          <div class="stocklist-link-container clearfix">
            <a href="#">LOCATIONS</a>
          </div>	
          
          
          <?          
			$stocklist_categories = get_categories('taxonomy=stocklist_category&type=stocklist'); 
			
			foreach ($stocklist_categories as $stocklist_category){ 
				echo '<div class="stocklist-container">';
				echo '<h2>'. $stocklist_category->name .'</h2>';
            	$args= array(
					'post_type' => 'stocklist',
					'tax_query' => array(
									  array(
										'taxonomy' => 'stocklist_category',
										'field'    => 'slug',
										'terms'    => $stocklist_category->slug,
										'include_children' => false
									  )
									),
					'post_status' 		=> 'publish',
					'orderby'			=> 'menu_order',
					'order' 			=> 'ASC',
					'numberposts' 		=> -1
				);
				$results = get_posts( $args );
				$size = sizeof($results); 
				$count = 0;
				foreach($results as $key=>$result){
					$content = apply_filters( 'the_content', $result->post_content );
					if($count%2 == 0){
						echo '<div class="row stocklist-row">';
					}
					?>
            		<div class="col-sm-6 stocklist-item">
                    	<h4><?=$result->post_title?></h4>
                        <div><?=$content?></div>
                    </div>
				<? 
					$count++;
					if($count%2 == 0){
						echo '</div>';
					}
				} 
				echo '</div>';			
			} ?>          
        </div>
   	</div>
</section>