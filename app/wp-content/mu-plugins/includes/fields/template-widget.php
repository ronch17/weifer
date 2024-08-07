<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$template_widget = new FieldsBuilder( 'template_widget', [
	'hide_on_screen' => [
		'the_content'
	]
] );

$template_widget
	->setLocation( 'page_template', '==', 'views/template-widget.blade.php' );

$template_widget
	->addText( 'title' )->setWidth( 40 )
	->addText( 'subtitle' )->setWidth( 40 )
	->addSelect( 'widget' )->setWidth( 20 )->addChoices( [
			'prf-trading-accounts-summary-widget' => 'Account Summary',
			//type="forex"
			'prf-customer-profile-widget'         => 'Personal Info',
			'prf-account-create-widget'           => 'Create New Account',
			'prf-trading-account-widget'          => 'Transactions',
			'prf-deposit-widget'                  => 'Deposit',
			'prf-withdrawal-widget'               => 'Withdrawal',
			//ng-if="prf.tradingAccount"
			'prf-internal-transfer-widget'        => 'Internal Transfer',
			'prf-documents-widget'                => 'Documents (KYC)',
			'prf-questionnaire-widget'            => 'Questionnaire',
			//ng-if="prf.tradingAccount"
			'prf-forgot-password-widget'          => 'Forgot Password',
			'prf-reset-password-widget'           => 'Reset Password',
            'prf-refer-a-friend-widget'           => 'Refer a Friend',
		]
	)
	->addText( 'ccx_deposit_link' )->setWidth( 75 )->conditional( 'widget', '==', 'prf-deposit-widget' )
	->and( 'hide_for_all', '!=', '1' )
	->addTrueFalse( 'hide_on_demo_account', [
		'label'       => 'Hide Ccx Deposit Link on Demo Account',
		'ui'          => 1,
		'ui_on_text'  => 'Hide',
		'ui_off_text' => 'Show'
	] )->setWidth( 25 )->conditional( 'widget', '==', 'prf-deposit-widget' )
	->conditional( 'hide_for_all', '!=', '1' )
	->addTrueFalse( 'hide_for_all', [
		'label'       => 'Hide Deposit Widget',
		'ui'          => 1,
		'ui_on_text'  => 'Hide',
		'ui_off_text' => 'Show'
	] )->conditional( 'widget', '==', 'prf-deposit-widget' )
	->addWysiwyg( 'before_widget' )
	->addWysiwyg( 'after_widget' );

return $template_widget;
