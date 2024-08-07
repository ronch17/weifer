<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$payments = new FieldsBuilder( 'payments' );

$payments
	->addTab( 'payments', [ 'placement' => 'top' ] )
	->addRepeater( 'payments' )
	->addSelect( 'payment' )
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
        'Binance',
        'GiroPay',
        'BankTransfer',
        'Sofort',
        'Traustly'
	)
	->endRepeater()
	->addFields( get_field_partial( 'footer-components.footer-payments-settings' ) );


return $payments;
