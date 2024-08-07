<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$button = new FieldsBuilder( 'button' );
$button
	->addText( 'button_label', [] )->setWidth( 16 )
	->addPageLink( 'page_url', [
		'label'          => 'Page URL',
		'post_type'      => [
			'page',
		],
		'allow_archives' => 0,
		'allow_null' => 1,
		'wrapper'        => [ 'width' => 16 ]
	] )
	->addText( 'url', [ 'label' => 'URL', ] )->setWidth( 16 )
	->addSelect( 'class', [ 'allow_null' => 1, ] )->setWidth( 16 )
	->addChoices( 'Primary', 'Secondary', 'Outline', 'More' )
	->setDefaultValue( 'primary' )
	->addSelect( 'margin_bottom', [ 'allow_null' => 1, ] )->setWidth( 16 )
	->addChoices( 'small', 'normal', 'large' )
	->addSelect( 'hide_for', [ 'allow_null' => 1, ] )->setWidth( 16 )
	->addChoices( 'Customer', 'Guest' );

return $button;
