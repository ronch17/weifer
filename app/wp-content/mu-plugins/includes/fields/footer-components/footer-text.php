<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$footer_text = new FieldsBuilder( 'footer_text' );
$footer_text
	->addWysiwyg( 'footer_text' )->setWidth( 85 )
	->addTrueFalse( 'align_center', [
		'label'       => 'Align Text',
		'ui'          => 1,
		'ui_on_text'  => 'Center',
		'ui_off_text' => 'Left',
	] )->setWidth( 15 );

return $footer_text;
