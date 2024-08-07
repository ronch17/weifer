<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$lottie = new FieldsBuilder( 'lottie', [ 'title' => 'Lottie animation' ] );

$lottie
    ->addSelect( 'lottie', [ 'label' => 'Lottie Animation', 'allow_null' => 1 ] )
    ->setWidth( 25 )
    ->addChoices(
        [
            'lotties.hero-robot' => 'Hero robot Animation',
            'lotties.forex' => 'Forex Animation',
            'lotties.wallet' => 'Wallet Animation',
            'lotties.indices' => 'Indices Animation',
            'lotties.equities' => 'Equities Animation',
            'lotties.commodities' => 'Commodities Animation',
        ]
    );

return $lottie;
