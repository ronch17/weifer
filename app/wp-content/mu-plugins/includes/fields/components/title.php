<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$title = new FieldsBuilder( 'title' );
$title
	->addTab( 'Content' )
	->addFields( get_field_partial( 'partials.title-item' ) )
	->addTab( 'Settings' )
	->addFields( get_field_partial( 'partials.title-attr' ) );

return $title;
