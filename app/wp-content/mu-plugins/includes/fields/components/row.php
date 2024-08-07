<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$row = new FieldsBuilder( 'row' );

$row
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
	->setInstructions( 'Click "Add Column" to add new Column to the row' )
	->addFlexibleContent( 'column_components', [
		'button_label' => 'Add Column Component'
	] )
	->addLayout( get_field_partial( 'components.title' ) )
	->addLayout( get_field_partial( 'components.text' ) )
	->addLayout( get_field_partial( 'components.image' ) )
	->addLayout( get_field_partial( 'components.list-generator' ) )
	->addLayout( get_field_partial( 'components.buttons' ) )
	->addLayout( get_field_partial( 'components.ng-assets' ) )
	->addLayout( get_field_partial( 'components.contact-form' ) )
	->addLayout( get_field_partial( 'components.signup-widget' ) )
    ->addLayout( get_field_partial( 'components.spacer' ) )
    ->addLayout( get_field_partial( 'components.referee-landing' ) )
    ->addLayout( get_field_partial( 'components.tabs' ) )
    ->addLayout( get_field_partial( 'components.upload-svg' ) )
    ->addLayout( get_field_partial( 'components.account-types' ) )
    ->addLayout( get_field_partial( 'components.login-widget' ) )
    ->addLayout( get_field_partial( 'components.breadcrumbs' ) )
    ->addLayout( get_field_partial( 'components.trading-widget' ) )
    ->addLayout( get_field_partial( 'components.gallery' ) )
    ->addLayout( get_field_partial( 'components.lotties' ) )
	->endFlexibleContent()
	->addFields( get_field_partial( 'partials.row-settings' ) )
	->endRepeater();

return $row;
