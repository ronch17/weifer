<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include( PRFWP_PATH . "/includes/fields/partials/config.php" );

$hero = new FieldsBuilder( 'hero' );

$hero
	->addFields( get_field_partial( 'partials.builder' ) )
	->addFields( get_field_partial( 'partials.settings' ) )
	->removeField( 'padding' );

return $hero;
