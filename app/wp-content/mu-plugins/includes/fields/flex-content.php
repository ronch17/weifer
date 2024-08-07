<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$flex_content = new FieldsBuilder( 'flex_content', [
	'hide_on_screen' => [
		'the_content'
	]
] );

$flex_content
	->setLocation( 'page_template', '==', 'views/template-flex-content.blade.php' );

$flex_content
	->addTab( 'content' )
	->addFlexibleContent( 'flex_content', [ 'label' => '', 'button_label' => 'Add Content to Page' ] )
	->setInstructions( '<b>Click "Add Content to Page" button to see available section layouts options you could add to the page</b>' )
	->addLayout( get_field_partial( 'layouts.strip' ), [ 'max' => 1 ] )
	->addLayout( get_field_partial( 'layouts.hero' ), [ 'max' => 1 ] )
    ->addLayout( get_field_partial( 'layouts.splide_js' ) )
	->addLayout( get_field_partial( 'layouts.section' ) )
	->addLayout( get_field_partial( 'partials.ticker' ) )
	->endFlexibleContent()
	->addTab( 'general' )
	->addFields( get_field_partial( 'partials.general' ) );


return $flex_content;
