<? woocommerce_breadcrumb(); ?>
<?
	$args = array(
		'orderby' => 'name',
		'parent' => 0
	);
	$categories = get_categories( $args );

	$full_uri = site_url().'/buzz/our-blog/';
?>

<section class="blog-section main-section-container container">
	<div class="col-xs-12 col-sm-10 col-md-10 main-content-wrapper">
		<div class="row">
			<div class="headline-title-container clearfix">
				<div class="col-xs-2 headline-title-left"></div>
				<div class="col-xs-8 headline-title-center">EVIE BLOG</div>
				<div class="col-xs-2 headline-title-right"></div>
			</div>
			<div class="under-title-link-container clearfix row">
    	        <div class="col-xs-12 col-sm-5">
					<ul>
						<li>
							<a href="javascript:;">CATEGORIES</a>
							<ul class="sub-menu">
								<li><a href="<?=$full_uri?>?category=&y=<?=$year?>">All</a></li>
								<?
									foreach ( $categories as $category ) {
										echo '<li><a href="'.$full_uri.'?category='.$category->cat_ID.'&y='.$blog_year.'">'.$category->name.'</a></li>';
									}	
								?>
							</ul>
						</li>
						<li><a href="javascript:;">ARCHIVES</a>
							<ul class="sub-menu">
								<li><a href="<?=$full_uri?>?category=<?=$blog_cat?>&y=">All</a></li>
									<?
									$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts ORDER BY post_date DESC");
									foreach($years as $year) : 
										echo '<li class="year_link"><a href="'.$full_uri.'?category='.$blog_cat.'&y='.$year.'">'.$year.'</a></li>';
									 endforeach; ?>
							</ul>
						</li>
					</ul>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5571773a13e7c073" async="async"></script>
				<div class="social-media-container col-xs-12 col-sm-7 addthis_toolbox addthis_default_style social-link-container">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_sinaweibo"></a>
					<a class="addthis_button_pinterest_share"></a>
				    <a class="addthis_button_twitter"></a>
					<a class="addthis_button_google_plusone_share"></a> 					
					<a class="addthis_button_linkedin"></a>
					<a class="addthis_button_email"></a>
					<div id="qqwb_share__" data-appkey="801387349" data-icon="2" data-counter="0" data-content="<? _e('tencent'); ?>"></div>	
				</div>
			</div>

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
						<!--<?php the_excerpt(__('Continue reading »','example')); ?>
						<div class="read-more">
							<a href="<?php the_permalink(); ?>">READ MORE ></a>
						</div>-->
						<?php the_content(); ?>
                        <div class="read-more">
	                        <a href="/buzz/our-blog/"><i class="fa fa-angle-left"></i> BACK</a>
                        </div>
					</div>

				</div>
			<?php endwhile; ?>
            <div class="pagination clearfix">
            	<div class="previous">
            	<?
	               	$prev_post = get_previous_post();
					if (!empty( $prev_post )){
						previous_post_link('%link', '<i class="fa fa-angle-left"></i> Previous Post');
				 	} else { 
						echo '<i class="fa fa-angle-left"></i> Previous Post';	
					} ?>
                </div>
               <!-- <div class="next">
	    	        <?php next_post_link('%link', 'Next Post <i class="fa fa-angle-right"></i>'); ?>
                </div>-->
                
                <div class="next">
            	<?
	               	$next_post = get_next_post();
					if (!empty( $next_post )){
						next_post_link('%link', 'Next Post <i class="fa fa-angle-right"></i>');
				 	} else { 
						echo 'Next Post <i class="fa fa-angle-right"></i>';	
					} ?>
                </div>
            </div>
            
            
			<!--<?php if ($wp_query->max_num_pages > 1) : ?>
			  <nav class="post-nav">
				<ul class="pager">
				  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
				  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
				</ul>
			  </nav>
			<?php endif; ?>-->
			
			<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
		</div>
	</div>
</section>