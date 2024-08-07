<?php

use StoutLogic\AcfBuilder\FieldsBuilder;
include PRFWP_PATH . "/includes/fields/partials/config.php";

$menu = new FieldsBuilder( 'menu' );
$menu
	->addText( 'title' )->setWidth( 30 )
	->addField( 'menu', 'nav_menu' )->setWidth( 30 );

return $menu;
