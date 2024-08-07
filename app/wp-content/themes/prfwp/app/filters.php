<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter( 'body_class', function ( array $classes ) {
    /** Add page slug if it doesn't exist */
    if ( is_single() || is_page() && ! is_front_page() ) {
        if ( ! in_array( basename( get_permalink() ), $classes ) ) {
            $classes[] = basename( get_permalink() );
        }
    }

    /** Add class if sidebar is active */
    if ( display_sidebar() ) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map( function ( $class ) {
        return preg_replace( [ '/-blade(-php)?$/', '/^page-template-views/' ], '', $class );
    }, $classes );

    return array_filter( $classes );
} );

/**
 * Add "… Continued" to the excerpt
 */
add_filter( 'excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'sage' ) . '</a>';
} );

/**
 * Template Hierarchy should search for .blade.php files
 */
collect( [
    'index',
    '404',
    'archive',
    'author',
    'category',
    'tag',
    'taxonomy',
    'date',
    'home',
    'frontpage',
    'page',
    'paged',
    'search',
    'single',
    'singular',
    'attachment',
    'embed'
] )->map( function ( $type ) {
    add_filter( "{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates' );
} );

/**
 * Render page using Blade
 */
add_filter( 'template_include', function ( $template ) {
    collect( [ 'get_header', 'wp_head' ] )->each( function ( $tag ) {
        ob_start();
        do_action( $tag );
        $output = ob_get_clean();
        remove_all_actions( $tag );
        add_action( $tag, function () use ( $output ) {
            echo $output;
        } );
    } );
    $data = collect( get_body_class() )->reduce( function ( $data, $class ) use ( $template ) {
        return apply_filters( "sage/template/{$class}/data", $data, $template );
    }, [] );
    if ( $template ) {
        echo template( $template, $data );

        return get_stylesheet_directory() . '/index.php';
    }

    return $template;
}, PHP_INT_MAX );

/**
 * Render comments.blade.php
 */
add_filter( 'comments_template', function ( $comments_template ) {
    $comments_template = str_replace(
        [ get_stylesheet_directory(), get_template_directory() ],
        '',
        $comments_template
    );

    $data = collect( get_body_class() )->reduce( function ( $data, $class ) use ( $comments_template ) {
        return apply_filters( "sage/template/{$class}/data", $data, $comments_template );
    }, [] );

    $theme_template = locate_template( [ "views/{$comments_template}", $comments_template ] );

    if ( $theme_template ) {
        echo template( $theme_template, $data );

        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100 );

/**
 * Disable comments on Media attachments
 */
add_filter( 'comments_open', function ( $open, $post_id ) {
    $post = get_post( $post_id );
    if ( $post->post_type == 'attachment' ) {
        return false;
    }

    return $open;
}, 10, 2 );

/**
 * Add custom <li> classes to existing
 * from wp_nav_menu() function
 */
add_filter( 'nav_menu_css_class', function ( $classes, $item, $args ) {
    if ( isset( $args->add_li_class ) ) {
        $classes[] = $args->add_li_class;
    }

    return $classes;
}, 1, 3 );

/**
 * Convert all newly uploaded WebP images
 * with a quality setting of 80%
 */
add_filter( 'wp_editor_set_quality', function ( $quality, $mime_type ) {
    if ( 'image/webp' === $mime_type ) {
        return 80;
    }

    return $quality;
}, 10, 2 );


/**
 * Change upload directory for .JSON files
 * to /locale-partials to deploy widgets translations
 * from admin panel
 */

add_filter( 'upload_mimes', function ( $mimes ) {
    $mimes['json'] = 'application/json';

    return $mimes;
} );

add_filter( 'wp_handle_upload_prefilter', function ( $file ) {
    add_filter( 'upload_dir', function ( $path ) {
        $extension = substr( strrchr( $_POST['name'], '.' ), 1 );
        if ( ! empty( $path['error'] ) || $extension != 'json' ) {
            return $path;
        } //error or other filetype; do nothing.
        $customdir      = '/locale-partials';
        $path['path']   = str_replace( $path['subdir'], '', $path['path'] ); // remove default subdir (year/month)
        $path['url']    = str_replace( $path['subdir'], '', $path['url'] );
        $path['subdir'] = $customdir;
        $path['path']   .= $customdir;
        $path['url']    .= $customdir;

        return $path;
    }
    );

    return $file;
} );
