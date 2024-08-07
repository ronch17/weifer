<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$breadcrumbs = new FieldsBuilder( 'breadcrumbs' );
$breadcrumbs
    ->addTrueFalse( 'enable', [
        'label'       => 'Enable?',
        'ui'          => 1,
        'ui_on_text'  => 'Yes',
        'ui_off_text' => 'No'
    ] );

return $breadcrumbs;