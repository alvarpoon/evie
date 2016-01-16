<? woocommerce_breadcrumb(); 

	if( isset($_GET['location']) ){
		$location = $_GET['location'];
	}else{
		$location = '';
	}
	
	$stocklist_categories = get_categories('taxonomy=stocklist_category&type=stocklist'); 
	
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$full_uri = 'http://'.$_SERVER['HTTP_HOST'].$uri_parts[0];
?>
<section class="stocklist-section main-section-container container">
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
          <div class="under-title-link-container clearfix">
            <ul>
				<li><a href="javascript:;"><?= _e('LOCATIONS'); ?></a>
					<ul class="sub-menu">
						<li><a href="<?=$full_uri?>"><?= _e('All'); ?></a></li>
						<? 
						foreach($stocklist_categories as $stocklist_category){
							if($location == $stocklist_category->slug){
								$current_class = 'active';
							}else{
								$current_class = '';
							}?>
							<li><a class="<?=$current_class?>" href="<?=$full_uri.'?location='.$stocklist_category->slug ?>"><?=$stocklist_category->name?></a></li>
						<? } ?>
					</ul>
				</li>
			</ul>
          </div>
		  
          <?			
			foreach ($stocklist_categories as $stocklist_category){ 
				if($location !== $stocklist_category->slug && $location !== ''){
					continue;
				}
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