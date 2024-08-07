<?php

namespace App\Directives;

use App;
use App\Controllers\Page;

return [

	/*
	|--------------------------------------------------------------------------
	| PROFTIT Directives
	|--------------------------------------------------------------------------
	|
	| PROFTIT CUSTOM Directives.
	|
	*/

	/** Create @acfmodule() Blade directive */
	'acfmodule'    => function ( $tag ) {
		empty( $tag ) ? $tag = 'section' : $tag = $tag;
		if ( App::layout() ) {
			return "<{$tag} " . "<?= Page::id(); ?>" . 'class="acfm-' . App::layout() . "<?= Page::moduleAttr(); ?>" . '"' . "<?= App::hideFor() ?>" . '>';
		}

		return '';
	},

	/** Create @endacfmodule() Blade directive */
	'endacfmodule' => function ( $tag ) {
		empty( $tag ) ? $tag = 'section' : $tag = $tag;
		if ( App::layout() ) {
			return "</{$tag}>";
		}

		return '';
	},

	/** Create @container() Blade directive */
	'container'    => function ( $classPrefix ) {
		$containerClass = $classPrefix ? $classPrefix : 'acfm-' . App::layout();

		return "<?= get_sub_field( 'has_container' ) ? '<div class=\"{$containerClass}__container container\">' : ''  ?>";

	},

	/** Create @endcontainer() Blade directive */
	'endcontainer' => function () {
		return "<?= get_sub_field( 'has_container' ) ? '</div>' : '' ?>";
	},

	/** Create @svg() Blade directive */
	'svg'          => function ( $id ) {
		return "<svg class=\"svg-{$id}\"><use xlink:href=\"#{$id}\"/></svg>";
	},
];
