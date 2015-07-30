<?php

class WooCommerce_Slider_Gallery_Display {

  	public function display_slider( $content ) {

        global $woocommerce, $post;

        if (is_singular( array( 'product' ) )) {

            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
            remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

            add_action( 'woocommerce_product_thumbnails', 'wc_dynamic_gallery_show', 30);
            function wc_dynamic_gallery_show() {

              echo '<div id="slider" class="flexslider">';
              echo '<ul class="slides">';

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
                   }

              echo '</ul>';
              echo '</div>';

              echo '<div id="carousel" class="flexslider">';
              echo '<ul class="slides">';

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
                   }

              echo '</ul>';
              echo '</div>';

          }

        }

    }

}
