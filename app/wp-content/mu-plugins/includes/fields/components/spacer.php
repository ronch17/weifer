<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$spacer = new FieldsBuilder( 'spacer' );
$spacer
	->addSelect( 'padding', [ 'allow_null' => 1, 'ui' => 1 ] )->setWidth( 20 )
	->addChoices(
		[ 'large-padding' => 'padding-16' ],
		[ 'normal-padding' => 'padding-12' ],
		[ 'small-padding' => 'padding-8' ],
		[ 'no-padding-top' => 'padding-6' ],
		[ 'smaller-padding' => 'padding-3' ] )
	->setDefaultValue( 'normal-padding' )
	->addSelect( 'hidden', [ 'allow_null' => 1, 'ui' => 1 ] )->setWidth( 20 )
	->addChoices(
		[ 'hide-desktop' => 'Desktop' ],
		[ 'hide-mobile' => 'Mobile' ] )
	->setDefaultValue( 'hide-mobile' );

return $spacer;
