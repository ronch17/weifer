<?php
/**
 * To activate CPT Single page
 * @author  Bainternet
 * @link http://en.bainternet.info/2011/custom-post-type-getting-404-on-permalinks
 * ---
 */
add_action( 'init',
	function () {

		$ver      = filemtime( __FILE__ ); // Get the file time for this file as the version number
		$defaults = array( 'version' => 0, 'time' => time() );
		$r        = wp_parse_args( get_option( __CLASS__ . '_flush', array() ), $defaults );

		if ( $r['version'] != $ver || $r['time'] + 172800 < time() ) { // Flush if ver changes or if 48hrs has passed.
			flush_rewrite_rules();
			// trace( 'flushed' );
			$args = array( 'version' => $ver, 'time' => time() );
			if ( ! update_option( __CLASS__ . '_flush', $args ) ) {
				add_option( __CLASS__ . '_flush', $args );
			}
		}

	} );