<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_content = new FieldsBuilder( 'footer_content' );

$footer_content
	->addFlexibleContent( 'footer_content' )
	->addLayout( get_field_partial( 'footer-components.footer-main' ) )
	->addLayout( get_field_partial( 'footer-components.footer-payments' ) )
	->endFlexibleContent();


return $footer_content;
