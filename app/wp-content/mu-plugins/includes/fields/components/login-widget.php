<?php

namespace prfwp;
include PRFWP_PATH . "/includes/fields/partials/config.php";

use StoutLogic\AcfBuilder\FieldsBuilder;

$login_widget = new FieldsBuilder( 'login_widget' );

$login_widget
    ->addMessage( '', 'The Login Widget will be displayed at the current position' );

return $login_widget;
