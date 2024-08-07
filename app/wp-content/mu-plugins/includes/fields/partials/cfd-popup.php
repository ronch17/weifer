<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$cfd_popup = new FieldsBuilder( 'cfd_popup' );

$cfd_popup
	->addRepeater( 'cfd_popup', [
		'min'          => 0,
		'label'        => 0,
		'layout'       => 'block',
		'button_label' => 'Add Popup'
	] )
	->addText( 'cfd_popup_title', [ 'label' => 'CFD Popup Title' ] )->setWidth( 40 )
	->addText( 'cfd_button_text', [ 'label' => 'CFD Popup Button' ] )->setWidth( 40 )
	->addTrueFalse( 'cfd_popup_cache', [
		'label'       => 'Store user choice in cache',
		'ui'          => 1,
		'ui_on_text'  => 'Save',
		'ui_off_text' => 'Not save',
	] )->setWidth( 20 )
	->addWysiwyg( 'cfd_popup_text', [
		'label'   => 'CFD Popup Text',
		'wrapper' => [
			'class' => 'prfwp-popup-text',
		],
	] )
	->endRepeater();


return $cfd_popup;
