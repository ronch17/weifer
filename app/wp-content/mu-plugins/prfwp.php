<?php

namespace prfwp;

define( 'PRFWP_PATH', plugin_dir_path( __FILE__ ) );
define( 'PRFWP_URL', plugins_url( '', __FILE__ ) );

define( 'BRAND_NAME', 'weifer' );

require_once( PRFWP_PATH . 'vendor/autoload.php' );

require_once( PRFWP_PATH . 'includes/cf7.php' );
require_once( PRFWP_PATH . 'includes/acf.php' );

/*
 * Register Custom Post types
 */
require_once( PRFWP_PATH . 'includes/flush.php' );
require_once( PRFWP_PATH . 'includes/post-types/faq.php' );
//require_once(PRFWP_PATH . 'includes/post-types/glossary.php');
//require_once(PRFWP_PATH . 'includes/post-types/assets.php');

/*
 * Include Plugins
 */
//require_once(PRFWP_PATH . 'includes/plugins/aq_resizer.php');
//require_once(PRFWP_PATH . 'includes/filters.php');
