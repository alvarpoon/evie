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

//http://www.ordinarycoder.com/wpml-get-permalink-on-current-language/
function get_permalink_current_language( $post_id )
{
	$language = ICL_LANGUAGE_CODE;

    $lang_post_id = icl_object_id( $post_id , 'page', true, $language );

    $url = "";
    if($lang_post_id != 0) {
        $url = get_permalink( $lang_post_id );
    }else {
        // No page found, it's most likely the homepage
        global $sitepress;
        $url = $sitepress->language_url( $language );
    }

    return $url;
}

add_filter('body_class', 'append_language_class');
function append_language_class($classes){
  $classes[] = ICL_LANGUAGE_CODE;  //or however you want to name your class based on the language code
  return $classes;
}


// Display 8 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );


/*remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';*/


//https://community.theme.co/forums/topic/search-results-wpml/#post-118287
add_filter( 'template_include', 'force_template_override', 99 );

function force_template_override( $template ) {

  if( is_search() ) {
    $p = pathinfo($template);
    return $p['dirname'].'/index.php';
  }

  return $template;

}

//https://searchwp.com/docs/hooks/searchwp_basic_auth_creds/
function my_searchwp_basic_auth_creds() {
  
  // NOTE: this needs to be your HTTP BASIC AUTH login
  //
  //                 *** NOT *** your WordPress login
  //
  //
  $credentials = array( 
    'username' => 'evie', // the HTTP BASIC AUTH username
    'password' => 'evie123'  // the HTTP BASIC AUTH password
  );
  
  return $credentials;
}
add_filter( 'searchwp_basic_auth_creds', 'my_searchwp_basic_auth_creds' );