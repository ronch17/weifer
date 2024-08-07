<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$builder = new FieldsBuilder( 'builder' );

$builder
	->addTab( 'builder', [ 'placement' => 'left' ] )
	->addFlexibleContent( 'components', [ 'button_label' => 'Add Component' ] )
	->addLayout( get_field_partial( 'components.spacer' ) )
	->addLayout( get_field_partial( 'components.title' ) )
	->addLayout( get_field_partial( 'components.text' ) )
	->addLayout( get_field_partial( 'components.image' ) )
	->addLayout( get_field_partial( 'components.list-generator' ) )
	->addLayout( get_field_partial( 'components.buttons' ) )
	->addLayout( get_field_partial( 'components.signup-widget' ) )
	->addLayout( get_field_partial( 'components.account-types' ) )
	->addLayout( get_field_partial( 'components.ng-assets' ) )
	->addLayout( get_field_partial( 'components.calendar' ) )
	->addLayout( get_field_partial( 'components.row' ) )
	->addLayout( get_field_partial( 'components.contact-form' ) )
    ->addLayout( get_field_partial( 'components.payments' ) )
    ->addLayout( get_field_partial( 'components.referee-landing' ) )
    ->addLayout( get_field_partial( 'components.upload-svg' ) )
    ->addLayout( get_field_partial( 'components.tabs' ) )
    ->addLayout( get_field_partial( 'components.breadcrumbs' ) )
    ->addLayout( get_field_partial( 'components.login-placeholder' ) )
    ->addLayout( get_field_partial( 'components.trading-widget' ) )
    ->addLayout( get_field_partial( 'components.gallery' ) )
	->endFlexibleContent();

return $builder;
