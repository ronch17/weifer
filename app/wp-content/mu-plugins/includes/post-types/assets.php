<?php
/*
 * Assets custom post type
 */

add_action('init', function () {
    register_extended_post_type('assets', [
      'menu_icon'  => 'dashicons-screenoptions',

        # Show all posts on the post type archive:
      'archive'    => [
        'nopaging' => true,
      ],
        # Add some custom columns to the admin screen:
      'admin_cols' => [
        'asset_type' => [
          'taxonomy' => 'asset_type'
        ],
      ],

        # Add a dropdown filter to the admin screen:
      'admin_filters' => [
        'asset_type' => [
          'taxonomy' => 'asset_type'
        ],
      ],

    ], [
      'singular' => __('Symbol', 'prfwp'),
      'plural'   => __('Assets', 'prfwp'),
      'slug'     => 'assets'
    ]);

    register_extended_taxonomy('asset_type', 'assets', [

        # Use radio buttons in the meta box for this taxonomy on the post editing screen:
        'meta_box' => 'radio',

        # Add a custom column to the admin screen:
      'admin_cols' => [
        'updated' => [
          'title'       => 'Updated',
          'meta_key'    => 'updated_date',
          'date_format' => 'd/m/Y'
        ],
      ],

    ], [
        # Override the base names used for labels:
      'singular' => __('Assets Type', 'prfwp'),
      'plural'   => __('Assets Types', 'prfwp'),
    ]);
});

/*
 * Assets custom post type sorting: alphabetical order
 */
add_action('pre_get_posts', function ($query) {
    if ('assets' === $query->get('post_type') || is_post_type_archive('assets')) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
});
