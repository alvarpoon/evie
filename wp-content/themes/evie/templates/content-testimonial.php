<?
	woocommerce_breadcrumb(); 
	if( isset($_GET['product']) ){
		$product = $_GET['product'];
	}else{
		$product = '';
	}
	
	if( isset($_GET['concern']) ){
		$concern = $_GET['concern'];
	}else{
		$concern = '';
	}
	
	
	$product_cat = 29;
	$product_result = get_term_by('id', $product_cat,'testimonial_category');
	
	$concern_cat = 30;
	$concern_result = get_term_by('id', $concern_cat,'testimonial_category');
	
	$product_args = array(
		'type'                     => 'post',
		'orderby'                  => 'slug',
		'order'                    => 'asc',
		'hide_empty'               => 0,
		'hierarchical'             => 0,
		'taxonomy'                 => 'testimonial_category',
		'parent'      		   	   => $product_cat
	);
	$product_categories = get_categories( $product_args );
	
	$concern_args = array(
		'type'                     => 'post',
		'orderby'                  => 'slug',
		'order'                    => 'asc',
		'hide_empty'               => 0,
		'hierarchical'             => 0,
		'taxonomy'                 => 'testimonial_category',
		'parent'      		   	   => $concern_cat
	);
	$concern_categories = get_categories( $concern_args );
		
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$full_uri = 'http://'.$_SERVER['HTTP_HOST'].$uri_parts[0];
?>
<section class="testimonial-section main-section-container container">
	<div class="col-xs-12 col-sm-12 col-md-10 main-content-wrapper">
        <div class="row">
          <div class="headline-title-container clearfix">
            <div class="col-xs-2 headline-title-left"></div>
            <div class="col-xs-8 headline-title-center"><? the_title(); ?></div>
            <div class="col-xs-2 headline-title-right"></div>
          </div>
        </div>
		<div class="under-title-link-container clearfix row">
			<div class="col-xs-6 noPadding checkbox-container">
				<form id="testimonial_form" name="testimonial_form" method="post">
				<ul>
					<li><a href="javascript:;">BY PRODUCTS</a>
						<ul class="sub-menu">
							<?
								if($product == ''){
									echo '<li><label><input type="checkbox" id="product_all" name="product_cat[]" value="" checked=checked />All</label></li>';		
								}else{
									echo '<li><label><input type="checkbox" id="product_all" name="product_cat[]" value="" />All</label></li>';		
								}
							?>
							
							<? 
							foreach($product_categories as $product_category){
								//print_r($product_category);
								if($product == $product_category->slug || $product == ''){
									$checked = 'checked=checked';
								}else{
									$checked = '';
								}?>								
								<li><label class="clearfix"><input type="checkbox" name="product_cat[]" value="<?=$product_category->slug ?>" <?=$checked ?> /><?=$product_category->name?></label></li>
								
							<? } ?>
						</ul>
					</li>
					<li><a href="javascript:;">BY CONCERN</a>
						<ul class="sub-menu">
							<?
								if($concern == ''){
									echo '<li><label><input type="checkbox" id="concern_all" name="concern_cat" value="" checked=checked />All</label></li>';		
								}else{
									echo '<li><label><input type="checkbox" id="concern_all" name="concern_cat" value="" />All</label></li>';		
								}
							?>
							<? 
							foreach($concern_categories as $concern_category){
								if($concern == $concern_category->slug || $concern == ''){
									$checked = 'checked=checked';
								}else{
									$checked = '';
								}?>		
								<li><label class="clearfix"><input type="checkbox" name="concern_cat" value="<?=$concern_category->slug ?>" <?=$checked ?> /><?=$concern_category->name?></label></li>
							<? } ?>
						</ul>
					</li>
				</ul>
				</form>
			</div>
			<div class="col-xs-6 noPadding right-link">
				<ul>
					<li><a href="#">SORT BY</a></li>
				</ul>
			</div>
    	</div>
        <div class="testimonial-container">
        	
            	<?
				
				//$testimonal_categories = get_categories('taxonomy=testimonial_category&type=testimonial'); 
				
				$terms_array = array('combination-oily-skin');
				
				$testimonal_args = array(
					'post_type' => 'testimonial',
					/*'tax_query' => array(
						array(
							'taxonomy' => 'testimonial_category',
							'field' => 'slug',
							'terms' => $terms_array
						)
					)*/
				);
				$loop = new WP_Query( $testimonal_args );
                
				while ( $loop->have_posts() ) : $loop->the_post();
					$rating = get_field("rating", $post->ID);
					$commenter = get_field("commenter_name", $post->ID);
				?>
                	<div class="testimonial-item">
                    	<div class="rating-container">
						<? for ($i = 1; $i <= $rating; $i++) {
							echo '<span class="star"></span>';
						   } ?>
                        </div>
                        <div class="testimonial-header">
	                        <h2 class="entry-title"><? the_title(); ?></h2>
    	                    &mdash; <span class="commenter"><?=$commenter?></span> <span class="date"><?=get_the_date('F j, Y'); ?></span>
                        </div>
                        <div class="entry-content">
                            <? the_content(); ?>
                        </div>
                    </div>
                    
				<?php endwhile;?>
        </div>
   	</div>
</section>