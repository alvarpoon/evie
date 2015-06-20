<? woocommerce_breadcrumb(); ?>
<!--<?php //while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php //get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php //wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php //endwhile; ?>-->

<section class="blog-section main-section-container container">
	<div class="col-xs-12 col-sm-10 col-md-10 main-content-wrapper">
		<div class="row">
			<div class="headline-title-container clearfix">
				<div class="col-xs-2 headline-title-left"></div>
				<div class="col-xs-8 headline-title-center">EVIE BLOG</div>
				<div class="col-xs-2 headline-title-right"></div>
			</div>
			<div class="blog-link-container clearfix">
				<div class="blog-nav col-sm-5">
					<a href="#">CATEGORIES</a>
					<a href="#">ARCHIVES</a>
				</div>
				<div class="social-media-container col-sm-7">area for social media</div>
			</div>		
			<?php //query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

			<!--<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
				<?php _e('Sorry, no results were found.', 'roots'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>-->

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