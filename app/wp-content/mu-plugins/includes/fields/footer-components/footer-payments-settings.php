<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include( PRFWP_PATH . "/includes/fields/partials/config.php" );

$settings = new FieldsBuilder( 'settings' );
$settings
	->addTab( 'settings', [ 'placement' => 'left' ] )
	->addTrueFalse( 'has_container', [
		'ui'          => 1,
		'ui_on_text'  => 'Container',
		'ui_off_text' => 'No Container',
	] )->setWidth( 20 )
	->setDefaultValue( '1' )
	->addTrueFalse( 'colourful', [
		'ui'          => 1,
		'ui_on_text'  => 'Colourful',
		'ui_off_text' => 'Monochrome',
	] )->setWidth( 20 )
	->setDefaultValue( '0' )
	->addRadio( 'background', [ 'allow_null' => 1 ] )->setSelector( '.radio_colors' )->setWidth( 20 )
	->addChoices( $global_config->bg_color_pallet )
	->addRadio( 'text_color', [ 'allow_null' => 1 ] )->setSelector( '.radio_colors' )
	->addChoices( $global_config->text_color_pallet )->setWidth( 20 );

return $settings;
