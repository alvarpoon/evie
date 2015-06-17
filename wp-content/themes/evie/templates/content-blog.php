<? 
	woocommerce_breadcrumb(); 

	if( isset($_GET['category']) ){
		$blog_cat = $_GET['category'];
	}else{
		$blog_cat = '';
	}
	
	if( isset($_GET['y']) ){
		$year = $_GET['y'];
	}else{
		$year = '';
	}	
	
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$full_uri = 'http://'.$_SERVER['HTTP_HOST'].$uri_parts[0];
	
	$args = array(
		'orderby' => 'name',
		'parent' => 0
	);
	$categories = get_categories( $args );
		/*foreach ( $categories as $category ) {
			echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
		}*/
?>
<section class="blog-section main-section-container container">
	<div class="col-xs-12 col-sm-10 col-md-10 main-content-wrapper">
		<div class="row">
			<div class="headline-title-container clearfix">
				<div class="col-xs-2 headline-title-left"></div>
				<div class="col-xs-8 headline-title-center">EVIE BLOG</div>
				<div class="col-xs-2 headline-title-right"></div>
			</div>
			<!--<div class="blog-link-container clearfix">
				<div class="blog-nav col-sm-5">
					<a href="#">CATEGORIES</a>
					<a href="#">ARCHIVES</a>
				</div>
				<div class="social-media-container col-sm-7">area for social media</div>
			</div>	-->
			<div class="under-title-link-container clearfix row">
    	        <div class="col-sm-5">
					<ul>
						<li>
							<a href="javascript:;">CATEGORIES</a>
							<ul class="sub-menu">
								<li><a href="<?=$full_uri?>?category=<?=$blog_cat?>&y=<?=$year?>">All</a></li>
								<?
									foreach ( $categories as $category ) {
										//echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
										echo '<li><a href="'.$full_uri.'?category='.$category->slug.'&y='.$year.'">'.$category->name.'</a></li>';
									}	
								?>
							</ul>
						</li>
						<li><a href="javascript:;">ARCHIVES</a>
							<ul class="sub-menu">
								<li><a href="<?=$full_uri?>">All</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="social-media-container col-sm-7">area for social media</div>
			</div>
			<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
				<?php _e('Sorry, no results were found.', 'roots'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>

			<?php while (have_posts()) : the_post(); ?>
				<div class="blog-post-item">
					<div class="blog-post-title">
						<h2><?php the_title(); ?></h2>
						<p><? the_date(); ?></p>
					</div>
					<a class="img-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full',  array('class' => 'img-responsive')); ?></a>
					<div class="blog-post-detail">
						<?=get_field("image_caption",$post->ID) ?>
					</div>
					<div class="blog-post-excerpt col-xs-10 col-sm-10 col-md-10">
						<?php the_excerpt(__('Continue reading »','example')); ?>
						<div class="read-more">
							<a href="<?php the_permalink(); ?>">READ MORE ></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			
			<?php if ($wp_query->max_num_pages > 1) : ?>
			  <nav class="post-nav">
				<ul class="pager">
				  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
				  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
				</ul>
			  </nav>
			<?php endif; ?>
		</div>
	</div>
</section>