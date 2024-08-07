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
	] )->setWidth( 15 )
	->setDefaultValue( '1' )
	->addSelect( 'padding', [ 'allow_null' => 1 ] )->setWidth( 15 )
	->addChoices( 'normal-padding', 'large-padding', 'small-padding', 'no-padding-top', 'no-padding-bottom', 'no-padding' )
	->setDefaultValue( 'normal-padding' )
	->addRadio( 'background', [ 'allow_null' => 1 ] )->setSelector( '.radio_colors' )->setWidth( 15 )
	->addChoices( $global_config->bg_color_pallet )
	->addRadio( 'text_color', [ 'allow_null' => 1 ] )->setSelector( '.radio_colors' )->setWidth( 15 )
	->addChoices( $global_config->text_color_pallet )
	->addImage( 'bg_image', [
		'label'         => 'Background Image',
		'preview_size'  => 'medium',
		'return_format' => 'url'
	] )->setWidth( 25 )
	->addImage( 'bg_image_sm', [
		'label'         => 'Small Background Image',
		'preview_size'  => 'medium',
		'return_format' => 'url'
	] )->setWidth( 25 )
	->addSelect( 'bg_align', [ 'allow_null' => 1 ] )->setWidth( 25 )
	->addChoices( 'right', 'left', 'bottom', 'top' )
	->addSelect( 'bg_size', [ 'allow_null' => 1 ] )->setWidth( 25 )
	->addChoices( 'cover', 'contain' );

return $settings;
