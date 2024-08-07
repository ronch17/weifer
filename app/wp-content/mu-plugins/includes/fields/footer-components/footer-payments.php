<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_payments = new FieldsBuilder( 'footer_payments' );

$footer_payments
	->addTab( 'footer_payments', [ 'placement' => 'top' ] )
	->addRepeater( 'footer_payments' )
	->addSelect( 'footer_payment' )
	->addChoices(
		'Bitcoin',
		'Sepa',
		'CashU',
		'Entropay',
		'Litecoin',
		'Ethereum',
		'Maestro',
		'MasterCard',
		'MasterCardSecureCode',
		'Neteller',
		'PayPal',
		'Skrill',
		'VerifiedByVisa',
		'Visa',
		'VLoad',
		'WebMoney',
		'WestrenUnion',
		'WireTransfer',
        'Coinbase',
        'Binance'
	)
	->endRepeater()
	->addFields( get_field_partial( 'footer-components.footer-payments-settings' ) );


return $footer_payments;
