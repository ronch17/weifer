<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$contact_form = new FieldsBuilder( 'contact_form' );

$contact_form
	->addTextarea( 'title', [ 'rows' => '2', 'new_lines' => 'br' ] )->setWidth( 50 )
	->addTextarea( 'subtitle', [ 'rows' => '2', 'new_lines' => 'br' ] )->setWidth( 50 )
	->addPostObject( 'contact_form', [
		'post_type'     => [
			'wpcf7_contact_form',
		],
		'return_format' => 'id',
		'wrapper'       => [ 'width' => 50 ]
	] )
	->setWidth( 33 );

return $contact_form;
