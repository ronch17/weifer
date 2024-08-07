<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_logo = new FieldsBuilder( 'footer_logo' );
$footer_logo
	->addMessage('', 'The Logo will be displayed at the current position');

return $footer_logo;
