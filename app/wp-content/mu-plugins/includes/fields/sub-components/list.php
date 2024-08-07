<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$list = new FieldsBuilder( 'list' );

$list
	->addRepeater( 'list', [ 'min' => 1 ] )
	->addTextarea( 'title', [ 'rows' => '1' ] )->setWidth( 33 )
	->addTextarea( 'text', [ 'rows' => '1' ] )->setWidth( 33 )
	->addImage( 'image', [ 'preview_size' => 'medium', 'return_format' => 'url' ] )->setWidth( 33 )
	->endRepeater();

return $list;
