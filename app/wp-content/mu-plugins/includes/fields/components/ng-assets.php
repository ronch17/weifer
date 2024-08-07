<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$ng_assets = new FieldsBuilder( 'ng_assets', [
    'hide_on_screen' => [
        'the_content'
    ]
] );

$ng_assets
    ->setLocation( 'page_template', '==', 'views/template-assets-index.blade.php' );

$ng_assets
    ->addText( 'ng_assets_notice' )->setWidth( 80 )
    ->addSelect( 'ng_assets_style', [ 'allow_null' => 1 ] )
    ->addChoices(
        [
            'column' => 'Column Style',
            'table' => 'Table Style'
        ]
    )->setWidth( 20 )
    ->addTrueFalse( 'assets_ticker', [
        'label'       => 'Enable Animation Ticker',
        'ui'          => 1,
        'ui_on_text'  => 'Enable',
        'ui_off_text' => 'Disable',
    ] )->setWidth( 20 )
    ->addText( 'selected_rules' )
    ->setDefaultValue( "'ETH/BTC', 'REP/BTC', 'REP/ETH', 'BTC/USDT', 'ETH/USDT', 'BCH/BTC', 'BTC/GBP', 'EUR/RUB', 'CAD/CHF', 'CHINA A50', 'EUR/UDS', 'CAD/JPY', 'AUD/NZD', 'GBP/USD', 'EUR/CHF', 'GOLD', 'ETH/USDT', 'ZEC/BTC','XMR/EUR'" );

return $ng_assets;
