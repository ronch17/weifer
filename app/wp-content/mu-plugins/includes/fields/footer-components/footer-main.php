<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_main = new FieldsBuilder( 'footer_main' );

$footer_main
	->addFields( get_field_partial( 'footer-components.footer-builder' ) )
	->addFields( get_field_partial( 'footer-components.footer-settings' ) );

return $footer_main;
