<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$footer_subscribe = new FieldsBuilder( 'footer_subscribe' );
$footer_subscribe
	->addText( 'title' )->setWidth( 30 )
	->addPostObject( 'footer_form', [
		'post_type'     => [
			'wpcf7_contact_form',
		],
		'return_format' => 'id',
	] )->setWidth( 30 );

return $footer_subscribe;
