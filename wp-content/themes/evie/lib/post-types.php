<?php

/*add_post_type_support('page', 'excerpt');*/

// mainpaage banner
add_action('init', 'mainpage_banner_register');
function mainpage_banner_register() {
  $labels = array(
      'name' => _x('Mainpage banner', 'post type general name'),
      'singular_name' => _x('Mainpage banner', 'post type singular name'),
      'add_new' => _x('Add mainpage banner', 'rep'),
      'add_new_item' => __('Add mainpage banner'),
      'edit_item' => __('Edit mainpage banner'),
      'new_item' => __('New mainpage banner'),
      'view_item' => __('View mainpage banner'),
      'search_items' => __('Search mainpage banner'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'menu_position' => 3,
      'supports'      => array( 'title', 'thumbnail'),
  );
  register_post_type( 'mainpage_banner' , $args );
}
?>
