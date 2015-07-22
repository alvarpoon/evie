
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
              <?php echo roots_title(); ?>
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
            <?php if (!have_posts()) : ?>
              <div class="alert alert-warning">
                <?php _e('Sorry, no results were found.', 'roots'); ?>
              </div>
              <?php get_search_form(); ?>
            <?php endif; ?>

            <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('templates/content', get_post_format()); ?>
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
    </div>
</section>