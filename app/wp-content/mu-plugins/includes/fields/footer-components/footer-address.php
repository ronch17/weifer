<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$footer_address = new FieldsBuilder( 'footer_address' );
$footer_address
	->addTextarea( 'office_title', [ 'rows' => 2, ] )->setWidth( 25 )
	->setDefaultValue( 'Our Offices' )
	->addTextarea( 'phone', [ 'rows' => 2, ] )->setWidth( 25 )
	->addTextarea( 'address', [ 'rows' => 2, 'new_lines' => 'wpautop' ] )->setWidth( 25 )
	->addTextarea( 'email', [ 'rows' => 2, ] )->setWidth( 25 );

return $footer_address;
