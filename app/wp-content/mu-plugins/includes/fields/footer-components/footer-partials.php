<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_partials = new FieldsBuilder( 'footer_partials' );

$footer_partials
	->addLayout( get_field_partial( 'footer-components.footer-text' ) )
	->addLayout( get_field_partial( 'components.menu' ) );

return $footer_partials;
