<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$signup_widget = new FieldsBuilder( 'signup_widget' );

$signup_widget
	->addTextarea( 'title', [ 'rows' => '2', 'new_lines' => 'br' ] )->setWidth( 30 )
	->addTextarea( 'subtitle', [ 'rows' => '2', 'new_lines' => 'br' ] )->setWidth( 30 )
	->addSelect( 'hide_for', [ 'allow_null' => 1, ] )->setWidth( 20 )
	->addChoices( 'Customer', 'Guest' )->setDefaultValue( 'Customer' )
	->addTrueFalse( 'style', [
		'ui'          => 1,
		'ui_on_text'  => 'Inline',
		'ui_off_text' => 'Standard',
	] )->setWidth( 20 );

return $signup_widget;
