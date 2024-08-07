<?php
/**
 * Created by PhpStorm.
 * User: asher
 * Date: 3/27/18
 * Time: 1:18 PM
 */

add_action('init', function () {
    register_extended_post_type('faq', [
      'menu_icon'     => 'dashicons-screenoptions',
      'has_archive' => false,

        # Add some custom columns to the admin screen:
      'admin_cols'    => [
        'faq_category' => [
          'taxonomy' => 'faq_category'
        ],
          'show_in_home' => [
          'taxonomy' => 'show_in_home'
        ],
      ],

        # Add a dropdown filter to the admin screen:
      'admin_filters' => [
        'faq_category' => [
          'taxonomy' => 'faq_category'
        ],
          'show_in_home' => [
          'taxonomy' => 'show_in_home'
        ],
      ],

    ], [

        # Override the base names used for labels:
      'singular'    => 'Question',
      'plural'      => 'FAQ',
      'slug'        => 'faq',
    ]);

    register_extended_taxonomy('faq_category', 'faq', [

        # Use radio buttons in the meta box for this taxonomy on the post editing screen:
      'meta_box'   => 'radio',

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
      'singular' => 'Category',
      'plural'   => 'Categories',
    ]);

    register_extended_taxonomy('show_in_home', 'faq', [

        # Use radio buttons in the meta box for this taxonomy on the post editing screen:
        //'meta_box'   => 'radio',

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
        'singular' => 'Show in home',
        'plural'   => 'Show in home',
    ]);
});

/*
 * FAQ custom post type sorting: alphabetical order
 */
/*add_action('pre_get_posts', function ($query) {
    if ('faq' === $query->get('post_type') || is_post_type_archive('faq')) {

        $tax_terms = get_terms('faq', array('orderby' => 'id'));

        $query->set('$tax', '$tax_term->slug');
        $query->set('orderby', 'id');
        $query->set('order', 'ASC');
    }
});*/
