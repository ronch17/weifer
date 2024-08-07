<?php
/*
 * Glossary custom post type
 */

add_action('init', function () {
    register_extended_post_type(
        'glossary',
        [
            'menu_icon' => 'dashicons-screenoptions',

            # Show all posts on the post type archive:
            'has_archive' => false,

            # Add some custom columns to the admin screen:
            'admin_cols' => [
                'glossary_category' => [
                    'taxonomy' => 'glossary_category'
                ]
            ]
        ],
        [
            'singular' => __('Glossary', 'prfwp'),
            'plural' => __('Glossary', 'prfwp'),
            'slug' => 'glossary'
        ]
    );

    register_extended_taxonomy(
        'glossary_category',
        'glossary',
        [
            # Use radio buttons in the meta box for this taxonomy on the post editing screen:
            //'meta_box'   => 'radio',

            # Add a custom column to the admin screen:
            'admin_cols' => [
                'updated' => [
                    'title' => 'Updated',
                    'meta_key' => 'updated_date',
                    'date_format' => 'd/m/Y'
                ]
            ]
        ],
        [
            # Override the base names used for labels:
            'singular' => __('Glossary category', 'prfwp'),
            'plural' => __('Glossary categories', 'prfwp')
        ]
    );
});

/*
 * Glossary custom post type sorting: alphabetical order
 */
add_action('pre_get_posts', function ($query) {
    if (
        'glossary' === $query->get('post_type') ||
        is_post_type_archive('glossary')
    ) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
});
