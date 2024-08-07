<?php

namespace prfwp;

/**
 * Remove CF7 input's spans wrappers
 */
add_filter( 'wpcf7_form_elements', function ( $content ) {
	$content = preg_replace( '/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content );

	return $content;
} );

/**
 *  [hidden ref]
 */
add_filter( 'wpcf7_form_tag', function ( $tag, $unused ) {

	if ( $tag['name'] != 'ref' ) {
		return $tag;
	}

	if ( isset( $_GET['ref'] ) ) {
		if ( ! empty( $_GET['ref'] ) ) {
			$ref = $_GET['ref'];
			$tag['raw_values'][]   = $ref;
			$tag['values'][]       = $ref;
			$tag['labels'][]       = $ref;
			$tag['pipes']->pipes[] = array( 'before' => $ref, 'after' => $ref );
		}
	}

	return $tag;

}, 10, 2 );


/**
 *  [hidden url-with-query-string]
 */
add_filter( 'wpcf7_form_tag', function ( $tag, $unused ) {

	if ( $tag['name'] != 'url-with-query-string' ) {
		return $tag;
	}

	$urlWithQueryString = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$tag['raw_values'][] = $urlWithQueryString;
	$tag['values'][]     = $urlWithQueryString;
	$tag['labels'][]     = $urlWithQueryString;

	return $tag;

}, 10, 2 );

/*
 *  [hidden page-title]
 */
add_filter( 'wpcf7_form_tag', function ( $tag, $unused ) {

	if ( $tag['name'] != 'page-title' ) {
		return $tag;
	}

	$page_title = is_archive() ? get_the_archive_title() : get_the_title();

	$tag['raw_values'][] = $page_title;
	$tag['values'][]     = $page_title;
	$tag['labels'][]     = $page_title;

	return $tag;

}, 10, 2 );
