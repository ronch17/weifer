<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$svg2 = new FieldsBuilder( 'svg2', [ 'title' => 'SVG Icon' ] );

$svg2
    ->addSelect( 'svg2', [ 'label' => 'SVG 2 Icon', 'allow_null' => 1 ] )
    ->setWidth( 25 )
    ->addChoices(
        [ 'default' => 'Default Icon',
            'list.right-arr' => 'Right Arrow Icon',
        ]
    );

return $svg2;
