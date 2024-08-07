<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_builder = new FieldsBuilder( 'footer_builder' );

$footer_builder
	->addTab( 'builder', [ 'placement' => 'left' ] )
	->addFlexibleContent( 'footer_components' )
	->addLayout( get_field_partial( 'footer-components.footer-row' ) )
	->addLayout( get_field_partial( 'footer-components.footer-title' ) )
	->addLayout( get_field_partial( 'footer-components.footer-text' ) )
	->addLayout( get_field_partial( 'footer-components.footer-payments' ) )
	->addLayout( get_field_partial( 'footer-components.footer-copyright' ) )
	->endFlexibleContent();

return $footer_builder;
