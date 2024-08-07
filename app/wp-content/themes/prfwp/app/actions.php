<?php

namespace App;

/**
 * Redirect from single attachment page to parent or homepage.
 *
 * @see https://www.wpexplorer.com/disable-image-page/
 */

add_action( 'template_redirect', function () {
    if ( is_attachment() ) {
        global $post;
        if ( $post && $post->post_parent ) {
            wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
            exit;
        } else {
            wp_redirect( esc_url( home_url( '/' ) ), 301 );
            exit;
        }
    }
} );
