<?php
add_action( 'init', 'create_stocklist_taxonomies', 0 );
function create_stocklist_taxonomies() {
  register_taxonomy(
      'stocklist_category',
      'stocklist',
      array(
          'labels' => array(
              'name' => 'Stocklist Region',
              'add_new_item' => 'Add Stocklist Region',
              'new_item_name' => 'New Stocklist Region'
          ),
          'show_ui' => true,
          'show_tagcloud' => false,
          'hierarchical' => false
      )
  );
}

add_action( 'init', 'create_testimonial_taxonomies', 0 );
function create_testimonial_taxonomies() {
  register_taxonomy(
      'testimonial_category',
      'testimonial',
      array(
          'labels' => array(
              'name' => 'Testimonial Category',
              'add_new_item' => 'Add Testimonial Category',
              'new_item_name' => 'New Testimonial Category'
          ),
          'show_ui' => true,
          'show_tagcloud' => false,
          'hierarchical' => true
      )
  );
}


// in case the templates pop out
// global $wp_taxonomies;
// $taxonomy = 'year';
// unset( $wp_taxonomies[$taxonomy]);
// flush_rewrite_rules();
