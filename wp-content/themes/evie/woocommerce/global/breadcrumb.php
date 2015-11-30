<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {
	echo '<div class="breadcrumb-container"><div class="container">';
	echo $wrap_before;
	
	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			if($key==0){
				echo '<a href="' . esc_url( $crumb[1] ) . '">' . _e('HOME') . '</a>';
			}
			else{
				echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
			}
		} else {
			//echo esc_html( $crumb[0] );
			echo str_replace("<br />", " ", $crumb[0]);

		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			//echo $delimiter;
			echo '<i class="fa fa-angle-right"></i>';
		}

	}
	
	echo $wrap_after;
	echo '</div></div>';
}