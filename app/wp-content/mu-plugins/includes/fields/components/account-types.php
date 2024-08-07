<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$account_types = new FieldsBuilder( 'account_types' );

$account_types
    ->addRepeater( 'account_types', [
        'min'          => 1,
        'layout'       => 'block',
        'button_label' => 'Add Row',
        'instructions' => 'Hold "Shift" and hover at row in order to display duplication button',
    ] )
    ->addTextarea( 'title', [ 'rows' => 1, 'new_lines' => 'br' ] )->setWidth( 40 )
    ->addTextarea( 'price', [ 'rows' => 1, 'new_lines' => 'br' ] )->setWidth( 20 )
    ->addTrueFalse( 'switcher', [
        'label'       => 'Types Switcher',
        'ui'          => 1,
        'ui_on_text'  => 'second group',
        'ui_off_text' => 'first group'
    ] )->setWidth( 20 )
    ->addTrueFalse( 'popular', [
        'label'       => 'Most Popular',
        'ui'          => 1,
        'ui_on_text'  => 'yes',
        'ui_off_text' => 'no'
    ] )->setWidth( 20 )
    ->addRepeater( 'field', [ 'min' => 1, 'label' => '', 'button_label' => 'Add Field' ] )
    ->addTextarea( 'value', [ 'rows' => 1, 'new_lines' => 'br' ] )->setWidth( 70 )
    ->endRepeater()
    ->endRepeater();

return $account_types;
