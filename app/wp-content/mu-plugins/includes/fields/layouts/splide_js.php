<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include( PRFWP_PATH . "/includes/fields/partials/config.php" );

$splide_js = new FieldsBuilder( 'splide_js' );

$splide_js
    ->addFields( get_field_partial( 'partials.builder' ) )
    ->addFields( get_field_partial( 'partials.settings' ) )
    ->removeField( 'padding' )
    ->addTrueFalse( 'SliderCheck', [
        'label'       => 'SliderOn',
        'ui'          => 1,
        'ui_on_text'  => 'Yes',
        'ui_off_text' => 'No'
    ] );

return $splide_js;
