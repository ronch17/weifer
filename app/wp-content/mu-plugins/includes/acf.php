<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;


/**
 * Initialize ACF Builder
 */
add_action( 'wp_loaded', function () {
    if (! function_exists('collect') || ! function_exists('acf_add_local_field_group') ) {
        return;
    }
	collect( glob( PRFWP_PATH . '/includes/fields/*.php' ) )->map( function ( $field ) {
		return require_once( $field );
	} )->map( function ( $field ) {
		if ( $field instanceof FieldsBuilder ) {
			acf_add_local_field_group( $field->build() );
		}
	} );
} );

/**
 * Simple function to pretty up our field partial includes.
 *
 * @param  mixed $partial
 * @param  integer $width
 *
 * @return mixed
 */
function get_field_partial( $partial, $width = 100) {
	$partial = str_replace( '.', '/', $partial );

	return include( PRFWP_PATH . "/includes/fields/{$partial}.php" );
}

/**
 * Display hero_blockquote_title ON flexible_content/layout_title/name=hero_flexcontent
 */
add_filter( 'acf/fields/flexible_content/layout_title', function ( $title, $field, $layout, $i ) {

	$label = strip_tags( get_sub_field( 'title' ) );

	if ( $label ) {

		$title = '<span>' . $layout['label'] . ':<b> "' . $label . '"</b></span>';
	}

	return $title;

}, 10, 4 );

/**
 * Add ACF options page
 */
add_action('init', function () {
	if ( ! function_exists('acf_add_options_page')) {
		return;
	}
	acf_add_options_page([
		'page_title'  => BRAND_NAME .' Options',
		'menu_title'  => BRAND_NAME . ' Options',
		'menu_slug'   => 'prfwp',
		'capability'  => 'edit_posts',
		'parent_slug' => '',
		'position'    => 2, // Below 'Dashboard' menu item
		'icon_url'    => 'dashicons-admin-generic'
	]);
});

/**
 * Dynamically select Brand Assets List in ACF
 * @see https://www.billerickson.net/dynamic-dropdown-fields-in-acf/
 *
 * @param array $field , the field settings array
 * @param string $group , the assets category i want to get
 * @return array $field
 */
function prfwp_acf_assets_list($field, $group = '')
{

    $field['choices'] = [];
    $assets = prfwp_get_brand_assets($group);
    foreach ($assets as $key => $symbol) {
        $field['choices'][$key] = $symbol;
    }

    //echo '<pre>';
    //print_r($field);
    //var_dump(PLATFORM_TOKEN);
    //echo '</pre>';

    return $field;
}

//add_filter('acf/load_field/name=main_asset', __NAMESPACE__ . '\\prfwp_acf_assets_list');

add_filter('acf/load_field/name=main_asset', function ($field) {return prfwp_acf_assets_list($field);});


/**
 * Get brand assets
 *
 */
function prfwp_get_brand_assets($group = '')
{
    // Create the context for the request
    /*
     * curl -X GET \
     *      https://api.binarytradingcore.com/Assets \
     *      -H 'x-api-token: 07e5a5d6-71db-1410-97c9-032ed51c5bbf'
     *
     * */
    $context = stream_context_create([
      'http' => [
          // http://www.php.net/manual/en/context.http.php
        'method' => 'GET',
        'header' => 'x-api-token: ' . CFD_PLATFORM_TOKEN,
      ]
    ]);

    // Send the request
    $response = file_get_contents('https://api.binarytradingcore.com/Assets', FALSE, $context);

    // Check for errors
    if ($response === FALSE) {
        die('Error');
    }

    // Decode the response
    $responseData = json_decode($response, TRUE);

    // Print the date from the response
    $assets = [];
    foreach ($responseData as $item) {
        if ($group) {
            if ($item['group'] === $group) {
                $assets[$item['id']] = $item['name'];
            }
        } else {
            $assets[$item['id']] = $item['name'];
        }
    }
    return $assets;
}
