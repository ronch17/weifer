<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;


$gallery = new FieldsBuilder( 'gallery' );
$gallery
    ->addGallery('gallery_field', [
        'label' => 'Gallery Field',
        'instructions' => 'Insert as many png/jpg files',
        'required' => 0,
        'conditional_logic' => [],
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'return_format' => 'array',
        'min' => '',
        'max' => '',
        'insert' => 'append',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
    ]);

return $gallery;


