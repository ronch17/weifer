<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$footer_row = new FieldsBuilder( 'footer_row' );

$footer_row
	->addTrueFalse( 'reverse_columns', [
		'label'       => 'Reverse Columns on Mobile',
		'ui'          => 1,
		'ui_on_text'  => 'Reverse',
		'ui_off_text' => 'Default'
	] )
	->setWidth( 20 )
	->addTrueFalse( 'vertical_alignment', [
		'ui'          => 1,
		'ui_on_text'  => 'Stretch',
		'ui_off_text' => 'Center'
	] )
	->setWidth( 20 )
	->addSelect( 'justify_content', [ 'allow_null' => 0 ] )
	->addChoices(
		[
			'center'  => 'Center',
			'between' => 'Between',
			'right'   => 'Right',
			'left'    => 'Left',
		]
	)->setDefaultValue( 'between' )
	->setWidth( 20 )
	->addRepeater( 'columns', [ 'min' => 1, 'button_label' => 'Add Column' ] )
	->setInstructions( 'Click "Add Column" to add new Column to the footer row' )
	->addFlexibleContent( 'column_components', [ 'button_label' => 'Add Column Component' ] )
	->addLayout( get_field_partial( 'footer-components.footer-title' ) )
	->addLayout( get_field_partial( 'footer-components.footer-text' ) )
	->addLayout( get_field_partial( 'footer-components.footer-menu' ) )
	->addLayout( get_field_partial( 'footer-components.footer-social' ) )
	->addLayout( get_field_partial( 'footer-components.footer-address' ) )
	->addLayout( get_field_partial( 'footer-components.footer-logo' ) )
	->addLayout( get_field_partial( 'footer-components.footer-copyright' ) )
	->addLayout( get_field_partial( 'footer-components.footer-payments' ) )
	->addLayout( get_field_partial( 'footer-components.footer-subscribe' ) )
	->endFlexibleContent()
	->addFields( get_field_partial( 'partials.row-settings' ) )
	->endRepeater();

return $footer_row;
