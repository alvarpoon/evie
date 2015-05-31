<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/*
remove the WooCommerce page headers:
https://roots.io/using-woocommerce-with-sage/
*/
add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

/*
declaring that theme supports Woocommerce
*/
add_theme_support('woocommerce');