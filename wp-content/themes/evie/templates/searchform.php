<form role="search" method="get" class="search-form form-inline" action="<?=icl_get_home_url(); ?>">
  <label class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search') ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
      <input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/>
    </span>
  </div>
</form>
