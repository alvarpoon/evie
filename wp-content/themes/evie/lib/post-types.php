<?php

add_post_type_support('page', 'excerpt');

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

// media
add_action('init', 'media_register');
function media_register() {
  $labels = array(
      'name' => _x('Media coverage', 'post type general name'),
      'singular_name' => _x('Media coverage', 'post type singular name'),
      'add_new' => _x('Add media coverage', 'rep'),
      'add_new_item' => __('Add media coverage'),
      'edit_item' => __('Edit media coverage'),
      'new_item' => __('New media coverage'),
      'view_item' => __('View media coverage'),
      'search_items' => __('Search media coverage'),
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
  register_post_type( 'media' , $args );
}

// stocklist
add_action('init', 'stocklist_register');
function stocklist_register() {
  $labels = array(
      'name' => _x('Stocklist', 'post type general name'),
      'singular_name' => _x('Stocklist', 'post type singular name'),
      'add_new' => _x('Add stocklist', 'rep'),
      'add_new_item' => __('Add stocklist'),
      'edit_item' => __('Edit stocklist'),
      'new_item' => __('New stocklist'),
      'view_item' => __('View stocklist'),
      'search_items' => __('Search stocklist'),
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
      'supports'      => array( 'title', 'editor'),
  );
  register_post_type( 'stocklist' , $args );
}

// ingredient
add_action('init', 'ingredient_register');
function ingredient_register() {
  $labels = array(
      'name' => _x('Ingredient', 'post type general name'),
      'singular_name' => _x('Ingredient', 'post type singular name'),
      'add_new' => _x('Add ingredient', 'rep'),
      'add_new_item' => __('Add ingredient'),
      'edit_item' => __('Edit ingredient'),
      'new_item' => __('New ingredient'),
      'view_item' => __('View ingredient'),
      'search_items' => __('Search ingredient'),
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
      'supports'      => array( 'title', 'editor','thumbnail'),
  );
  register_post_type( 'ingredient' , $args );
}

// testimonial
add_action('init', 'testimonial_register');
function testimonial_register() {
  $labels = array(
      'name' => _x('Testimonial', 'post type general name'),
      'singular_name' => _x('Testimonial', 'post type singular name'),
      'add_new' => _x('Add testimonial', 'rep'),
      'add_new_item' => __('Add testimonial'),
      'edit_item' => __('Edit testimonial'),
      'new_item' => __('New testimonial'),
      'view_item' => __('View testimonial'),
      'search_items' => __('Search testimonial'),
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
      'supports'      => array( 'title', 'editor','thumbnail'),
  );
  register_post_type( 'testimonial' , $args );
}
?>
