<?php
/*
Plugin Name: WooCommerce Slider Gallery
Plugin URI: https://github.com/TaeKasidit/woocommerce-slider-gallery
Description: Add a thumbnail slider (via FlexSlider) to product pages.
Version: 0.0.0
Author: TaeKasidit
Author URI: https://github.com/TaeKasidit/
License: GPLv3 - http://www.gnu.org/licenses/gpl.html
*/

//* If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) exit;

require_once( plugin_dir_path( __FILE__ ) . 'class-woocommerce-slider-gallery-display.php' );

function woocommerce_slider_gallery_start() {

  $post_notice = new WooCommerce_Slider_Gallery_Display();

  $post_notice->initialize();

}

woocommerce_slider_gallery_start();
