<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$title_item = new FieldsBuilder( 'title_item' );

$title_item
	->addTextarea( 'title', [ 'rows' => '2', 'new_lines' => 'br' ] );

return $title_item;
