<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_copyright = new FieldsBuilder( 'footer_copyright' );
$footer_copyright
	->addMessage('', 'The Copyright sign will be displayed at the current position');

return $footer_copyright;
