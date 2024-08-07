<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$svg = new FieldsBuilder( 'svg', [ 'title' => 'SVG Icon' ] );

$svg
	->addSelect( 'svg', [ 'label' => 'SVG Icon', 'allow_null' => 1 ] )
	->setWidth( 25 )
	->addChoices(
		[ 'default' => 'Default Icon',
            'list.customer-phone' => 'Customer Phone Icon',
            'list.withdrawal' => 'Withdrawal Icon',
            'list.instruments' => 'Instruments Icon',
            'list.trade' => 'Trade Icon',
            'list.forex' => 'Forex Icon',
            'list.crypto' => 'Crypto Icon',
            'list.shares' => 'Shares Icon',
            'list.indices' => 'Indices Icon',
            'list.energies' => 'Energies Icon',
            'list.security' => 'Security Icon',
            'list.customisation' => 'Customisation Icon',
            'list.investment' => 'Investment Icon',
            'crypto-assets.crypto' => 'Crypto Assets Icon',
            'crypto-assets.products' => 'Products Icon',
            'crypto-assets.education' => 'Education Icon',
            'crypto-assets.services' => 'Services Icon',
            'contact.clock' => 'Clock Icon',
            'contact.phone' => 'Phone Icon',
            'contact.assistant' => 'Assistant Icon',
            'contact.envelope' => 'Envelope Icon',
            'contact.globe' => 'Globe Icon',
            'contact.help' => 'Help Icon',
            'contact.medal' => 'Medal Icon',
            'contact.settings' => 'Setting Icon',
            'contact.support' => 'Support Icon',
            ]
	);

return $svg;
