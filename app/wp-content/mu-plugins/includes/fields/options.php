<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$options = new FieldsBuilder( 'options' );

$options
    ->addTab( 'PROFTIT Integrations' )
    ->addFields( get_field_partial( 'partials.cfd-settings' ) )
    ->addImage('bg_image', [
        'label' => 'Widgets Background Image',
        'preview_size' => 'medium',
        'return_format' => 'url'
    ])->setWidth(20)
    ->addTrueFalse( 'custom_script_option', [
        'label'       => 'Enable Custom Scripts for CFD page',
        'ui'          => 1,
        'ui_on_text'  => 'Enable',
        'ui_off_text' => 'Disable',
    ] )->setWidth(20)
    ->addTextarea( 'custom_script', [ 'label' => '' ] )
    ->setWidth( 60 )
    ->conditional( 'custom_script_option', '==', 1 )
    ->addFields( get_field_partial( 'partials.cfd-popup' ) )
    ->addTab( 'Common' )
    ->addTrueFalse( 'user_select', [
        'label'       => 'User select for content',
        'ui'          => 1,
        'ui_on_text'  => 'Disabled',
        'ui_off_text' => 'Enabled',
    ] )->setWidth( 20 )
    ->addTrueFalse( 'site-theme', [
        'label'       => 'Select theme for site',
        'ui'          => 1,
        'ui_on_text'  => 'Dark',
        'ui_off_text' => 'Light',
    ] )->setWidth( 20 )
    ->addText( 'form_key' )->setWidth( 60 )
    ->addText( 'agreement_title', [ 'label' => 'Agreement Title', ] )->setWidth( 50 )
    ->addTrueFalse( 'agreement_popup', [
        'label'       => 'Enable agreement popup for Deposit page',
        'ui'          => 1,
        'ui_on_text'  => 'Enabled',
        'ui_off_text' => 'Disabled',
    ] )->setWidth( 50 )
    ->addTextarea( 'agreement_text', [ 'label' => 'Agreement Text', 'rows' => '5' ] )->setWidth( 50 )
    ->addGroup( 'agreement_link', [ 'layout' => 'row', 'label' => 0 ] )->setWidth( 50 )
    ->addText( 'agreement_label_url', [ 'label' => 'Agreement label URL', ] )
    ->addText( 'agreement_url', [ 'label' => 'Agreement URL', ] )
    ->endGroup()
    ->addTab( 'footer' )
    ->addFields( get_field_partial( 'layouts.footer-content' ) )
    ->addTab( 'Advertising \ Marketing Code' )
    ->addText( 'meta_description' )
    ->addTextarea( 'before_head_close', [ 'rows' => '10', ] )
    ->addTextarea( 'after_body_start', [ 'rows' => '10', ] )
    ->addTextarea( 'before_body_close', [ 'rows' => '10', ] )
    ->setLocation( 'options_page', '==', 'prfwp' );


return $options;
