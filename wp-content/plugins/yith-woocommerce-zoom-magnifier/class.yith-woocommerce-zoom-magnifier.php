<?php
/**
 * Main class
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Zoom Magnifier
 * @version 1.1.2
 */

if ( ! defined( 'YITH_WCMG' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WCMG' ) ) {
	/**
	 * WooCommerce Magnifier
	 *
	 * @since 1.0.0
	 */
	class YITH_WooCommerce_Zoom_Magnifier {
		/**
		 * Plugin version
		 *
		 * @var string
		 * @since 1.0.0
		 */
		public $version = '1.1.5';

		/**
		 * Plugin object
		 *
		 * @var string
		 * @since 1.0.0
		 */
		public $obj = null;

		/**
		 * Constructor
		 *
		 * @return mixed|YITH_WCMG_Admin|YITH_WCMG_Frontend
		 * @since 1.0.0
		 */
		public function __construct() {
			/** Stop the plugin on mobile devices */
			if ( ( 'yes' != get_option( 'yith_wcmg_enable_mobile' ) ) && wp_is_mobile() ) {
				return;
			}

			// actions
			add_action( 'init', array( $this, 'init' ) );

			if ( is_admin() ) {
				$this->obj = new YITH_WCMG_Admin( $this->version );
			} else {
				$this->obj = new YITH_WCMG_Frontend( $this->version );
			}

			return $this->obj;
		}


		/**
		 * Init method:
		 *  - default options
		 *
		 * @access public
		 * @since 1.0.0
		 */
		public function init() {
			$this->_image_sizes();
		}


		/**
		 * Add image sizes
		 *
		 * Init images
		 *
		 * @access protected
		 * @return void
		 * @since 1.0.0
		 */
		protected function _image_sizes() {
			$size   = get_option( 'woocommerce_magnifier_image' );
			$width  = $size['width'];
			$height = $size['height'];
			$crop   = isset( $size['crop'] ) ? true : false;

			add_image_size( 'shop_magnifier', $width, $height, $crop );
		}
	}
}