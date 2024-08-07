<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$footer_menu = new FieldsBuilder( 'footer_menu' );
$footer_menu
	->addText( 'title' )->setWidth( 30 )
	->addField( 'footer_menu', 'nav_menu' )->setWidth( 30 );

return $footer_menu;
