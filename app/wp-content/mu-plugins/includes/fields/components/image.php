<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$image = new FieldsBuilder( 'image' );
$image
	->addImage( 'image', [ 'preview_size' => 'medium', 'label' => 'Image' ] )->setWidth( 40 )
	->setInstructions( 'Will be displayed for both desktop and mobile if second image doesnt specified' )
	->addImage( 'image_sm', [ 'preview_size' => 'medium', 'label' => 'Mobile Image' ] )->setWidth( 40 )
	->addNumber( 'new_width' )->setWidth( 20 )
    ->addText( 'image_class', [ 'label' => 'image class' ] )->setWidth( 20 );

return $image;
