<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$general = new FieldsBuilder( 'general' );

$general
	->addTrueFalse( 'mobile_align', [
		'label'       => 'Align on Mobile',
		'ui'          => 1,
		'ui_on_text'  => 'Center',
		'ui_off_text' => 'Initial',
	] )->setDefaultValue( '1' );

return $general;
