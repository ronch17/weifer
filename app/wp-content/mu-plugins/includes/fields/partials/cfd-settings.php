<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

include PRFWP_PATH . "/includes/fields/partials/config.php";

$cfd_settings = new FieldsBuilder('cfd_settings');

$cfd_settings
    ->addText('WIDGETS_URL')->setDefaultValue(WIDGETS_URL)->setWidth($width->one_of_5_width)
    ->addText('BRAND_ID')->setDefaultValue(BRAND_ID)->setWidth($width->min_width)
    ->addText('DEFAULT_LANG')->setDefaultValue(DEFAULT_LANG)->setWidth($width->min_width)
    ->addText('SELECTED_PLATFORM')->setDefaultValue(SELECTED_PLATFORM)->setWidth($width->one_of_5_width)
    ->addText('DOCUMENT_DOMAIN')->setDefaultValue(DOCUMENT_DOMAIN)->setWidth($width->one_of_5_width)
    ->addTrueFalse('DISABLE_THEME_SWITCHER', ['ui' => 1])->setDefaultValue(false)->setWidth($width->one_of_5_width)
    ->addText('CFD_PLATFORM_URL')->setDefaultValue(CFD_PLATFORM_URL)->setWidth($width->url_width)
    ->addText('CFD_PLATFORM_VERSION')->setDefaultValue(CFD_PLATFORM_VERSION)->setWidth($width->version_width)
    ->addText('CFD_PLATFORM_TOKEN')->setDefaultValue(CFD_PLATFORM_TOKEN)->setWidth($width->url_width)
    ->addText('CFD_PLATFORM_THEME')->setDefaultValue(CFD_PLATFORM_THEME)->setWidth($width->theme_width)
    ->addText('BUNDLE_PLATFORM_URL')->setDefaultValue(BUNDLE_PLATFORM_URL)->setWidth($width->url_width)
    ->addText('BUNDLE_PLATFORM_VERSION')->setDefaultValue(BUNDLE_PLATFORM_VERSION)->setWidth($width->version_width)
    ->addText('BUNDLE_PLATFORM_TOKEN')->setDefaultValue(BUNDLE_PLATFORM_TOKEN)->setWidth($width->url_width)
    ->addText('BUNDLE_PLATFORM_THEME')->setDefaultValue(BUNDLE_PLATFORM_THEME)->setWidth($width->theme_width)
    ->addText('MT4_PLATFORM_URL')->setDefaultValue(MT4_PLATFORM_URL)->setWidth($width->url_width)
    ->addTextarea('MT4_PLATFORM_OPTIONS')
    ->addTextarea('WIDGETS_THEME');
return $cfd_settings;
