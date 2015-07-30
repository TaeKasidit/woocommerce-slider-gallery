<?php

class WooCommerce_Slider_Gallery_Display {

    public function initialize() {

        add_filter( 'the_content', array( $this, 'display_slider' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    public function display_slider() {

        global $woocommerce, $post;

        if ( is_product ) {

            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
            remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

            add_action( 'woocommerce_product_thumbnails', 'wc_slider_gallery_show', 30);
            function wc_slider_gallery_show() {

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

    public function enqueue_scripts() {

        wp_enqueue_script( 'jquery-easing', plugins_url( 'woocommerce-slider-gallery/js/jquery.easing.js' ), array( 'jquery' ), '1.3' );

        wp_enqueue_script( 'jquery-flexslider', plugins_url( 'woocommerce-slider-gallery/js/jquery.flexslider.js' ), array( 'jquery' ), '2.5.0' );

        wp_enqueue_script( 'jquery-mousewheel', plugins_url( 'woocommerce-slider-gallery/js/jquery.mousewheel.js' ), array( 'jquery' ), '3.0.6' );

        wp_enqueue_script( 'modernizr', plugins_url( 'woocommerce-slider-gallery/js/modernizr.js' ), array( 'jquery' ), '2.0.6' );

        wp_enqueue_script( 'woocommerce-slider-gallery', plugins_url( 'woocommerce-slider-gallery/js/woocommerce-slider-gallery.js' ), array( 'jquery' ), '0.0.1' );


    }

}

// TODO: Since this isn't working as a plugin. Try loading it from the functions file first. Once it's working, then convert it to a plugin.
