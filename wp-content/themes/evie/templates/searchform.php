<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>
