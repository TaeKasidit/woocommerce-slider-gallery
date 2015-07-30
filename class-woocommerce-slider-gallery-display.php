<?php

class WooCommerce_Slider_Gallery_Display {

  	public function display_slider( $content ) { ?>

    <ul> <?php
     $args = array(
       'post_type' => 'attachment',
       'numberposts' => -1,
       'post_status' => null,
       'post_parent' => $post->ID
      );

      $attachments = get_posts( $args );
         if ( $attachments ) {
            foreach ( $attachments as $attachment ) {
               echo '<li>';
               echo wp_get_attachment_image( $attachment->ID, 'full' );
               echo '</li>';
              }
         } ?>
    </ul> <?php












































add_action( 'wp', 'setup_dynamic_gallery', 20);
    function setup_dynamic_gallery() {
        global $woocommerce, $post;
        $current_db_version = get_option( 'woocommerce_db_version', null );
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        if (is_singular( array( 'product' ) )) {
            $global_wc_dgallery_activate = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'activate' );
            $actived_d_gallery = get_post_meta($post->ID, '_actived_d_gallery',true);

            if ($actived_d_gallery == '' && $global_wc_dgallery_activate != 'no') {
                $actived_d_gallery = 1;
            }

            if($actived_d_gallery == 1){
                remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
                remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

                add_action( 'woocommerce_before_single_product_summary', 'wc_dynamic_gallery_show', 30);

                wp_enqueue_style( 'ad-gallery-style', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.css' );
                wp_enqueue_script( 'ad-gallery-script', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.js', array(), false, true );

                $popup_gallery = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'popup_gallery' );
                //wp_enqueue_script('jquery');
                if ($popup_gallery == 'fb') {
                    wp_enqueue_style( 'woocommerce_fancybox_styles', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox.css' );
                    wp_enqueue_script( 'fancybox', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox'.$suffix.'.js', array(), false, true );
                } elseif ($popup_gallery == 'colorbox') {
                    wp_enqueue_style( 'a3_colorbox_style', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/colorbox.css' );
                    wp_enqueue_script( 'colorbox_script', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/jquery.colorbox'.$suffix.'.js', array(), false, true );
                }

                if ( in_array( 'woocommerce-professor-cloud/woocommerce-professor-cloud.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && get_option('woocommerce_cloud_enableCloud') == 'true' ) :
                    remove_action( 'woocommerce_before_single_product_summary', 'wc_dynamic_gallery_show', 30);
                endif;
            }
        }
    }


  }
}
