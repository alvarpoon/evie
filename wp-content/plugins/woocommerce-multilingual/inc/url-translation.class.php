<?php

class WCML_Url_Translation {

    public $default_product_base;
    public $default_product_category_base;
    public $default_product_tag_base;

    function __construct() {

        $this->default_product_base             = 'product';
        $this->default_product_category_base    = 'product-category';
        $this->default_product_tag_base         = 'product-tag';

        $this->wc_permalinks = get_option( 'woocommerce_permalinks' );

        $this->set_up(); //initialization

        add_filter( 'pre_update_option_woocommerce_permalinks', array( $this, 'register_product_and_taxonomy_bases' ), 10, 2 );

        add_filter( 'pre_update_option_rewrite_rules', array( $this, 'force_bases_in_strings_languages' ), 1, 1 ); // high priority

        add_filter( 'option_rewrite_rules', array( $this, 'translate_bases_in_rewrite_rules' ), 0, 1 ); // high priority

        add_filter( 'term_link', array( $this, 'translate_taxonomy_base' ), 0, 3 ); // high priority

        add_action( 'init', array( $this, 'fix_post_object_rewrite_slug' ), 6 ); // handle the particular case of the default product base: wpmlst-540

    }

    function set_up() {
        global $woocommerce_wpml;

        if ( empty( $woocommerce_wpml->settings['url_translation_set_up'] ) ) {

            $this->clean_up_product_and_taxonomy_bases();

            //set translate product by default
            $this->translate_product_base();

            $this->register_product_and_taxonomy_bases();

            $woocommerce_wpml->settings['url_translation_set_up'] = 1;
            $woocommerce_wpml->update_settings();
        }

    }

    function clean_up_product_and_taxonomy_bases(){
        global $wpdb;

        $base = $this->get_woocommerce_product_base();

        //delete other old product bases
        $wpdb->query( "DELETE FROM {$wpdb->prefix}icl_strings WHERE context = 'WordPress' AND value != '".trim( $base,'/' )."' AND name LIKE 'URL slug:%' " );

        //update name for current base

        $wpdb->update(
            $wpdb->prefix . 'icl_strings',
            array(
                'context'   => 'WordPress',
                'name'      => 'URL slug: product'
            ),
            array(
                'context'   => 'WordPress',
                'name'      => sprintf('Url slug: %s', trim( $base,'/' ))
            )
        );

        $woocommerce_permalinks = maybe_unserialize( get_option('woocommerce_permalinks') );

        foreach ( (array) $woocommerce_permalinks as $base_key => $base ) {

            $base_key = trim($base_key, '/');

            $taxonomy = false;

            switch( $base_key ){
                case 'category_base': $taxonomy = 'product_cat'; break;
                case 'tag_base':      $taxonomy = 'product_tag'; break;
                case 'attribute_base':$taxonomy = 'attribute'; break;
            }

            if( $taxonomy ) {
                $wpdb->query( "DELETE FROM {$wpdb->prefix}icl_strings WHERE context LIKE '".sprintf('URL %s slugs - ', $taxonomy)."%'" );
            }

        }

    }

    function fix_post_object_rewrite_slug(){
        global $wp_post_types, $wp_rewrite;

        if( empty( $this->wc_permalinks['product_base'] ) ){

            $wp_post_types['product']->rewrite['slug'] = 'product';
            $wp_rewrite->extra_permastructs['product']['struct'] = '/product/%product%';

        }

    }

    function url_strings_context() {
        return 'WordPress';
    }

    function url_string_name( $type ) {

        $name = '';

        switch ( $type ) {
            case 'product':
                $name = sprintf( 'URL slug: %s', $type );
                break;
            case 'product_cat':
            case 'product_tag':
            case 'attribute':
                $name = sprintf( 'URL %s tax slug', $type );
                break;
        }

        return $name;
    }

    function translate_product_base() {

        if ( !defined( 'WOOCOMMERCE_VERSION' ) || ( !isset( $GLOBALS['ICL_Pro_Translation'] ) || is_null( $GLOBALS['ICL_Pro_Translation'] ) ) ) {
            return;
        }

        $slug = $this->get_woocommerce_product_base();

        if ( version_compare( WPML_ST_VERSION, '2.2.6', '>' ) ) {

            // Use new API for WPML ST > 2.2.6
            do_action( 'wpml_activate_slug_translation', 'product', $slug, $this->url_strings_context() );

        } else {

            // force_product_slug_translation_on
            global $sitepress;
            $iclsettings = $sitepress->get_settings();
            if ( empty( $iclsettings['posts_slug_translation']['on'] ) || empty( $iclsettings['posts_slug_translation']['types']['product'] ) ) {
                $iclsettings['posts_slug_translation']['on'] = 1;
                $iclsettings['posts_slug_translation']['types']['product'] = 1;
                $sitepress->save_settings( $iclsettings );
            }

            $string = icl_get_string_id( $slug, $this->url_strings_context(), $this->url_string_name( 'product' ) );
            if ( !$string ) {
                do_action( 'wpml_register_single_string', $this->url_strings_context(), $this->url_string_name( 'product' ), $slug );
            }

        }

    }

    function get_woocommerce_product_base() {

        if ( isset( $this->wc_permalinks['product_base'] ) && !empty( $this->wc_permalinks['product_base'] ) ) {
            return trim( $this->wc_permalinks['product_base'], '/' );
        } elseif ( get_option( 'woocommerce_product_slug' ) != false ) {
            return trim( get_option( 'woocommerce_product_slug' ), '/' );
        } else {
            return $this->default_product_base; // the default WooCommerce value. Before permalinks options are saved
        }

    }

    function register_product_and_taxonomy_bases( $value = false, $old_value = false ) {
        global $woocommerce_wpml;

        if( empty( $value ) ){
            $permalink_options = $this->wc_permalinks;
        }else{
            $permalink_options = $value;
        }

        // products
        $product_base = !empty( $permalink_options['product_base'] ) ? trim( $permalink_options['product_base'], '/' ) : $this->default_product_base;
        $name = $this->url_string_name( 'product' );

        $string_language = $woocommerce_wpml->strings->get_string_language( $product_base, $this->url_strings_context(), $name );
        if( is_null($string_language) ){
            $string_language = '';
        }
        do_action( 'wpml_register_single_string', $this->url_strings_context(), $name, $product_base, false, $string_language );

        if( isset($_POST['product_base_language'])){
            $woocommerce_wpml->strings->set_string_language( $product_base, $this->url_strings_context(), $name, $_POST['product_base_language']);
        }

        if ( $product_base == $this->default_product_base ) {
            $this->add_default_slug_translations( $product_base, $name );
        }

        // categories
        $category_base = !empty( $permalink_options['category_base'] ) ? $permalink_options['category_base'] : $this->default_product_category_base;
        $name = $this->url_string_name( 'product_cat' );

        $string_language = $woocommerce_wpml->strings->get_string_language( $category_base, $this->url_strings_context(), $name );
        if( is_null($string_language) ){
            $string_language = '';
        }
        do_action( 'wpml_register_single_string', $this->url_strings_context(), $name, $category_base, false, $string_language );

        if( isset($_POST['category_base_language'])){
            $woocommerce_wpml->strings->set_string_language( $category_base, $this->url_strings_context(), $name, $_POST['category_base_language']);
        }

        if ( $category_base == $this->default_product_category_base ) {
            $this->add_default_slug_translations( $category_base, $name );
        }

        // tags
        $tag_base = !empty( $permalink_options['tag_base'] ) ? $permalink_options['tag_base'] : $this->default_product_tag_base;
        $name = $this->url_string_name( 'product_tag' );

        $string_language = $woocommerce_wpml->strings->get_string_language( $tag_base, $this->url_strings_context(), $name );
        if( is_null($string_language) ){
            $string_language = '';
        }
        do_action( 'wpml_register_single_string', $this->url_strings_context(), $name, $tag_base, false, $string_language );

        if( isset($_POST['tag_base_language'])){
            $woocommerce_wpml->strings->set_string_language( $tag_base, $this->url_strings_context(), $name, $_POST['tag_base_language']);
        }

        if ( $tag_base == $this->default_product_tag_base ) {
            $this->add_default_slug_translations( $tag_base, $name );
        }


        if ( isset( $permalink_options['attribute_base'] ) && $permalink_options['attribute_base'] ) {
            $attr_base = trim( $permalink_options['attribute_base'], '/' );

            $string_language = $woocommerce_wpml->strings->get_string_language( $attr_base, $this->url_strings_context(), $name );
            if( is_null($string_language) ){
                $string_language = '';
            }
            do_action( 'wpml_register_single_string', $this->url_strings_context(), $this->url_string_name( 'attribute' ), $attr_base, false, $string_language );

            if( isset($_POST['attribute_base_language'])){
                $woocommerce_wpml->strings->set_string_language( $attr_base, $this->url_strings_context(),  $this->url_string_name( 'attribute' ), $_POST['attribute_base_language']);
            }
        }

        return $value;
    }

    function add_default_slug_translations( $slug, $name ) {
        global $woocommerce_wpml, $sitepress, $wpdb;

        $string_id = icl_get_string_id( $slug, $this->url_strings_context(), $name );

        if ( WPML_SUPPORT_STRINGS_IN_DIFF_LANG ) {

            $string_language = $woocommerce_wpml->strings->get_string_language( $slug, $this->url_strings_context(), $name );

            // will use a filter in the future wpmlst-529
            $string_object = new WPML_ST_String( $string_id, $wpdb );
            $string_translation_statuses = $string_object->get_translation_statuses();

        } else {

            $string_language = $wpdb->get_var( $wpdb->prepare( "SELECT language FROM {$wpdb->prefix}icl_strings WHERE id=%d", $string_id ) );
            $string_translation_statuses = $wpdb->get_results( $wpdb->prepare( "SELECT language, status FROM {$wpdb->prefix}icl_string_translations WHERE string_id=%d", $string_id ) );
        }

        foreach ( $string_translation_statuses as $s ) {
            $string_translations[$s->language] = $s->status;
        }

        $languages = $sitepress->get_active_languages();

        foreach ( $languages as $language => $language_info ) {

            if ( $language != $string_language ) {

                // check if there's an existing translation
                if ( !isset( $string_translations[$language] ) ) {

                    $slug_translation = $woocommerce_wpml->strings->get_translation_from_woocommerce_mo_file( $slug, $language, false );

                    if ( $slug_translation ) {
                        // add string translation
                        icl_add_string_translation( $string_id, $language, $slug_translation, ICL_STRING_TRANSLATION_COMPLETE );
                    }

                }

            }
        }

    }

    function force_bases_in_strings_languages( $value ) {
        global $sitepress, $woocommerce_wpml;

        if( $value && $sitepress->get_current_language() != 'en' ) {

            remove_filter( 'gettext_with_context', array( $woocommerce_wpml->strings, 'category_base_in_strings_language' ), 99, 3 );
            $taxonomies = array(
                'product_cat' => array(
                    'base'              => 'category_base',
                    'base_translated'   => _x( 'product-category', 'slug', 'woocommerce' ),
                    'default'           => $this->default_product_category_base
                ),
                'product_tag' => array(
                    'base'              => 'tag_base',
                    'base_translated'   => _x( 'product-tag', 'slug', 'woocommerce' ),
                    'default'           => $this->default_product_tag_base
                ),
            );
            add_filter( 'gettext_with_context', array( $woocommerce_wpml->strings, 'category_base_in_strings_language' ), 99, 3 );

            foreach ( $taxonomies as $taxonomy => $taxonomy_details ) {

                if ( empty( $this->wc_permalinks[$taxonomy_details['base']] ) && $value ) {

                    $new_value = array();
                    foreach ( $value as $k => $v ) {
                        $k = preg_replace( "#" . $taxonomy_details['base_translated'] . "/#", $taxonomy_details['default'] . '/', $k );
                        $new_value[$k] = $v;
                    }
                    $value = $new_value;
                    unset( $new_value );

                }

            }

        }

        return $value;

    }

    function translate_bases_in_rewrite_rules( $value ) {
        global $sitepress, $sitepress_settings, $woocommerce_wpml;

        $cache_key = 'wcml_rewrite_filters_translate_taxonomies';

        if ( $val = wp_cache_get( $cache_key ) ) {

            $value = $val;

        } else {

            $taxonomies = array( 'product_cat', 'product_tag' );

            foreach ( $taxonomies as $taxonomy ) {
                $slug_details = $this->get_translated_tax_slug( $taxonomy );

                $string_language = $woocommerce_wpml->strings->get_string_language( $slug_details['slug'], $this->url_strings_context(), $this->url_string_name( $taxonomy ) );
                if ( $sitepress->get_current_language() == $string_language ) {
                    continue;
                }

                if ( $slug_details ) {

                    $slug_match = addslashes( ltrim($slug_details['slug'], '/') );
                    $slug_translation_match = ltrim($slug_details['translated_slug'], '/');

                    $buff_value = array();
                    foreach ( (array)$value as $k => $v ) {

                        if ( $slug_details['slug'] != $slug_details['translated_slug'] && preg_match( '#^[^/]*/?' . $slug_match . '/#', $k ) ) {
                            $k = preg_replace( '#^([^/]*)(/?)' . $slug_match . '/#', '$1$2' . $slug_translation_match . '/', $k );
                        }

                        $buff_value[$k] = $v;
                    }
                    $value = $buff_value;
                    unset( $buff_value );
                }

            }

            // handle attributes
            $wc_taxonomies = wc_get_attribute_taxonomies();
            $wc_taxonomies_wc_format = array();
            foreach ( $wc_taxonomies as $k => $v ) {
                $wc_taxonomies_wc_format[] = 'pa_' . $v->attribute_name;
            }

            foreach ( $wc_taxonomies_wc_format as $taxonomy ) {
                $taxonomy_obj = get_taxonomy( $taxonomy );

                if ( isset( $taxonomy_obj->rewrite['slug'] ) ) {
                    $exp = explode( '/', trim( $taxonomy_obj->rewrite['slug'], '/' ) );
                    $slug = join( '/', array_slice( $exp, 0, count( $exp ) - 1 ) );
                }

                if ( isset( $slug ) ) {
                    $string_language = $woocommerce_wpml->strings->get_string_language($slug, $this->url_strings_context(), $this->url_string_name( 'attribute' ) );

                    if ($sitepress->get_current_language() != $string_language) {

                        $slug_translation = apply_filters('wpml_translate_single_string', $slug, $this->url_strings_context(), $this->url_string_name( 'attribute' ) );
                        if ($slug_translation) {

                            $slug_match = addslashes( ltrim($slug, '/') );
                            $slug_translation_match = ltrim($slug_translation, '/');

                            $buff_value = array();
                            foreach ((array)$value as $k => $v) {
                                if ($slug != $slug_translation && preg_match('#^' . $slug_match . '/(.*)#', $k)) {
                                    $k = preg_replace('#^' . $slug_match . '/(.*)#', $slug_translation_match . '/$1', $k);
                                }
                                $buff_value[$k] = $v;
                            }

                            $value = $buff_value;
                            unset($buff_value);

                        }

                    }
                }

            }

            wp_cache_add( $cache_key, $value );

        }


        //filter shop page rewrite slug
        $cache_key = 'wcml_rewrite_shop_slug';

        if ( $val = wp_cache_get( $cache_key ) ) {

            $value = $val;

        } else {

            $current_shop_id = wc_get_page_id( 'shop' );
            $default_shop_id = apply_filters( 'translate_object_id', $current_shop_id, 'page', true, $sitepress->get_default_language() );

            if ( is_null( get_post( $current_shop_id ) ) || is_null( get_post( $default_shop_id ) ) )
                return $value;

            $current_slug = get_post( $current_shop_id )->post_name;
            $default_slug = get_post( $default_shop_id )->post_name;

            if ( $current_slug != $default_slug ) {
                $buff_value = array();
                foreach ( (array)$value as $k => $v ) {

                    if( preg_match( '#^' . $default_slug . '/\?\$$#', $k ) ||
                        preg_match( '#^' . $default_slug . '/\(?feed#', $k ) ||
                        preg_match( '#^' . $default_slug . '/page#', $k )){

                        $k = preg_replace( '#^' . $default_slug . '/#', $current_slug . '/', $k );
                    }

                    $buff_value[$k] = $v;
                }

                $value = $buff_value;
                unset( $buff_value );
            }

            wp_cache_add( $cache_key, $value );
        }

        return $value;
    }

    function translate_taxonomy_base( $termlink, $term, $taxonomy ) {
        global $wp_rewrite, $wpml_term_translations, $sitepress;
        static $no_recursion_flag;

        // handles product categories, product tags and attributes

        $wc_taxonomies = wc_get_attribute_taxonomies();
        foreach ( $wc_taxonomies as $k => $v ) {
            $wc_taxonomies_wc_format[] = 'pa_' . $v->attribute_name;
        }

        if ( ( $taxonomy == 'product_cat' || $taxonomy == 'product_tag' || ( !empty( $wc_taxonomies_wc_format ) && in_array( $taxonomy, $wc_taxonomies_wc_format ) ) ) && !$no_recursion_flag ) {

            $cache_key = 'termlink#' . $taxonomy . '#' . $term->term_id;
            if ( false && $link = wp_cache_get( $cache_key, 'terms' ) ) {
                $termlink = $link;

            } else {

                $no_recursion_flag = false;

                if ( !is_null( $wpml_term_translations ) ) {
                    $term_language = $term->term_id ? $wpml_term_translations->get_element_lang_code( $term->term_taxonomy_id ) : false;
                } else {
                    $term_language = $term->term_id ? $sitepress->get_language_for_element( $term->term_taxonomy_id, 'tax_' . $taxonomy ) : false;
                }

                if ( $term_language ) {

                    $slug_details = $this->get_translated_tax_slug( $taxonomy, $term_language );

                    $base = $slug_details['slug'];
                    $base_translated = $slug_details['translated_slug'];

                    if ( !empty( $base_translated ) && $base_translated != $base && isset( $wp_rewrite->extra_permastructs[$taxonomy] ) ) {

                        $buff = $wp_rewrite->extra_permastructs[$taxonomy]['struct'];
                        $wp_rewrite->extra_permastructs[$taxonomy]['struct'] = str_replace( $base, $base_translated, $wp_rewrite->extra_permastructs[$taxonomy]['struct'] );
                        $no_recursion_flag = true;
                        $termlink = get_term_link( $term, $taxonomy );

                        $wp_rewrite->extra_permastructs[$taxonomy]['struct'] = $buff;

                    }

                }

                $no_recursion_flag = false;

                wp_cache_add( $cache_key, $termlink, 'terms', 0 );
            }

        }

        return $termlink;
    }

    function get_translated_tax_slug( $taxonomy, $language = false ) {
        global $sitepress, $woocommerce_wpml;

        switch ( $taxonomy ) {
            case 'product_tag':
                $slug = !empty( $this->wc_permalinks['tag_base'] ) ? trim( $this->wc_permalinks['tag_base'], '/' ) : 'product-tag';

                $string_language = $woocommerce_wpml->strings->get_string_language( $slug, $this->url_strings_context(), $this->url_string_name( $taxonomy ) );

                break;

            case 'product_cat':
                $slug = !empty( $this->wc_permalinks['category_base'] ) ? trim( $this->wc_permalinks['category_base'], '/' ) : 'product-category';

                $string_language = $woocommerce_wpml->strings->get_string_language( $slug, $this->url_strings_context(), $this->url_string_name( $taxonomy ) );

                break;

            default:
                $slug = trim( $this->wc_permalinks['attribute_base'], '/' );

                $string_language = $woocommerce_wpml->strings->get_string_language( $slug, $this->url_strings_context(), $this->url_string_name( 'attribute' ) );

                $taxonomy = 'attribute';

                break;
        }

        if ( !$language ) {
            $language = $sitepress->get_current_language();
        }


        if ( $slug && $language != $string_language ) {

            if ( !WPML_SUPPORT_STRINGS_IN_DIFF_LANG ) {
                $slug_translation = apply_filters( 'wpml_translate_single_string', $slug, $this->url_strings_context(), $this->url_string_name( $taxonomy ), $language );
            } else {
                $has_translation = false;
                $slug_translation = apply_filters( 'wpml_translate_single_string', $slug, $this->url_strings_context(), $this->url_string_name( $taxonomy ), $language, $has_translation );
            }


            return array( 'slug' => $slug, 'translated_slug' => $slug_translation );
        }

        return array( 'slug' => $slug, 'translated_slug' => $slug );

    }
}