<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$strip = new FieldsBuilder( 'strip' );

$strip
	->addFields( get_field_partial( 'partials.builder' ) )
	->addFields( get_field_partial( 'partials.settings' ) )
	->removeField( 'bg_image' )
	->removeField( 'bg_image_sm' );


return $strip;
