<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$list_generator = new FieldsBuilder( 'list_generator' );

$list_generator
    ->addSelect( 'style', [ 'allow_null' => 1 ] )
    ->addChoices(
        [
            'default' => 'Default Style',
            'inline' => 'Inline Style',
            'card' => 'Card Style',
        ]
    )->setWidth( 50 )
    ->addRepeater( 'list_generator', [
        'min'          => 1,
        'layout'       => 'block',
        'button_label' => 'Add List item'
    ] )
    ->setInstructions( 'Click "Add List Item" to add new Item to the List' )
    ->addText( 'class', [ 'label' => 'Add Custom Class' ] )->setWidth( 10 )
    ->addTextarea( 'number', ['rows' => '1'])
    ->setWidth( 10 )
    ->addFields( get_field_partial( 'sub-components.svg', 15 ) )
    ->addTextarea( 'title', [ 'rows' => '2', 'new_lines' => 'br' ] )
    ->setWidth( 25 )
    ->addTextarea( 'text', [ 'rows' => '2', 'new_lines' => 'br' ] )
    ->setWidth( 25 )
    ->endRepeater();

return $list_generator;
