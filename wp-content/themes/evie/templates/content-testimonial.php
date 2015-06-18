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
		<div class="under-title-link-container clearfix">
            <ul>
				<li><a href="javascript:;">BY PRODUCTS</a>
					<ul class="sub-menu">
						<li><a href="<?=$full_uri?>">All</a></li>
						<? 
						foreach($product_categories as $product_category){
							if($product == $product_category->slug){
								$current_class = 'active';
							}else{
								$current_class = '';
							}?>
							<li><a class="<?=$current_class?>" href="<?=$full_uri.'?product='.$product_category->slug ?>"><?=$product_category->name?></a></li>
						<? } ?>
					</ul>
				</li>
				<li><a href="javascript:;">BY CONCERN</a>
					<ul class="sub-menu">
						<li><a href="<?=$full_uri?>">All</a></li>
						<? 
						foreach($concern_categories as $concern_category){
							if($location == $concern_category->slug){
								$current_class = 'active';
							}else{
								$current_class = '';
							}?>
							<li><a class="<?=$current_class?>" href="<?=$full_uri.'?concern='.$concern_category->slug ?>"><?=$concern_category->name?></a></li>
						<? } ?>
					</ul>
				</li>
			</ul>
          </div>
   	</div>
</section>