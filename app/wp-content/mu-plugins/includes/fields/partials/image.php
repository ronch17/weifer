<?php

namespace prfwp;
use StoutLogic\AcfBuilder\FieldsBuilder;

$image = new FieldsBuilder( 'image' );
$image
	->addImage( 'image', [ 'label' => 'Background Image', 'preview_size' => 'medium' ] );

return $image;
