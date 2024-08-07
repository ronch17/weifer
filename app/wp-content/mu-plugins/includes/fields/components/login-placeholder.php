<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$login_placeholder = new FieldsBuilder( 'login_placeholder' );

$login_placeholder
    ->addImage( 'background', [
        'label'         => 'Background Image',
        'preview_size'  => 'thumbnail',
        'return_format' => 'url'
    ] )
    ->addTextarea( 'title-left', [
        'rows'      => 1,
        'new_lines' => 'br',
        'label'     => 'Left Title'
    ] )->setWidth( 33 )
    ->addTextarea( 'subtitle-left', [
        'rows'      => 1,
        'new_lines' => 'br',
        'label'     => 'Left Subtitle'
    ] )->setWidth( 33 )
    ->addTextarea( 'button-left', [
        'rows'  => 1,
        'label' => 'Left Button'
    ] )->setWidth( 33 )
    ->addTextarea( 'title-right', [
        'rows'      => 1,
        'new_lines' => 'br',
        'label'     => 'Right Title'
    ] )->setWidth( 33 )
    ->addTextarea( 'subtitle-right', [
        'rows'      => 1,
        'new_lines' => 'br',
        'label'     => 'Right Subtitle'
    ] )->setWidth( 33 )
    ->addTextarea( 'button-right', [
        'rows'      => 1,
        'new_lines' => 'br',
        'label'     => 'Right Button'
    ] )->setWidth( 33 );

return $login_placeholder;
