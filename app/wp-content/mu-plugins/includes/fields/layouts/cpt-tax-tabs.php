<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$cpt_tax_tabs
	= new FieldsBuilder( 'cpt_tax_tabs', [ 'title' => 'Custom Post Type Taxonomy Terms Tabs' ] );

$cpt_tax_tabs
	->addMessage( 'Custom Post Types Taxonomy Terms Tabs', 'Chose Custom Post Type and his Taxonomy' )
	->addSelect( 'custom_post_type', [ 'wrapper' => [ 'width' => 40 ] ] )
	->addChoices( get_post_types( [ 'public' => true, '_builtin' => false ] ) )
	->addSelect( 'taxonomy', [ 'wrapper' => [ 'width' => 40 ] ] )
	->addChoices( get_taxonomies( [ 'public' => true, '_builtin' => false ] ) )
	->addTrueFalse( 'accordion', [
		'wrapper' => [ 'width' => 20 ],
	] );

return $cpt_tax_tabs;
