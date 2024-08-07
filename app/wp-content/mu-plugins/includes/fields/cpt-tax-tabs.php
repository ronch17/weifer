<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$cpt_tax_tabs = new FieldsBuilder( 'cpt_tax_tabs', [
	'hide_on_screen' => [
		'the_content'
	]
] );

$cpt_tax_tabs
	->setLocation( 'page_template', '==', 'views/template-cpt-tax-tabs.blade.php' );

$cpt_tax_tabs
	->addTab( 'content' )
	->addFlexibleContent( 'flex_content', [ 'label' => '', 'button_label' => 'Add Content to Page' ] )
	->setInstructions( '<b>Click "Add Content to Page" button to see available section layouts options you could add to the page</b>' )
	->addLayout( get_field_partial( 'layouts.hero' ), [ 'min' => 1, 'max' => 1 ] )
	->addLayout( get_field_partial( 'layouts.cpt-tax-tabs' ), [ 'min' => 1, 'max' => 1 ] )
	->endFlexibleContent()
	->addTab( 'general' )
	->addFields( get_field_partial( 'partials.general' ) );


return $cpt_tax_tabs;
