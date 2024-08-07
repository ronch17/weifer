<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$lotties = new FieldsBuilder( 'lotties' );

$lotties
    ->addFields( get_field_partial( 'sub-components.lottie', 15 ) );

return $lotties;
