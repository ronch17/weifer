<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$footer_social = new FieldsBuilder( 'footer_social' );
$footer_social
	->addRepeater( 'social_links', [ 'min' => 1 ] )
	->addSelect( 'social_link' )
	->addChoices( [
        'facebook'   => 'Facebook',
        'linkedin'   => 'Linkedin',
        'pinterest'  => 'Pinterest',
        'youtube'    => 'Youtube',
        'twitter'    => 'Twitter',
        'instagram'  => 'Instagram',
        'googlePlus' => 'GooglePlus',
        'telegram' => 'Telegram',
        'blog' => 'Blog',
        'email' => 'Email'
	] )
	->addText( 'url' )
	->endRepeater();

return $footer_social;
