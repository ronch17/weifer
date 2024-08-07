<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$upload_svg = new FieldsBuilder( 'upload_svg' );

$upload_svg
    ->addFields( get_field_partial( 'sub-components.svg', 20 ) );

return $upload_svg;
