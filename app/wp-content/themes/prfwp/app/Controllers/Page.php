<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use function Roots\Soil\GoogleAnalytics\options;

class Page extends Controller
{
    public static function layout()
    {
        return preg_replace('(_)', '-', get_row_layout());
    }

    public static function id()
    {
        $id = strtolower(preg_replace('(-| )', '_', get_sub_field('title')));
        if ($id) {
            return "id='{$id}' ";
        }

        return '';
    }

    public static function class()
    {
        $class = strtolower((get_sub_field('class')));
        if ($class) {
            return " {$class} ";
        }

        return '';
    }

    public static function padding()
    {
        $padding = get_sub_field('padding');
        if ($padding) {
            return ' acfm-' . $padding;
        }

        return '';
    }

    public static function bg()
    {
        $bg = get_sub_field('background');
        if ($bg) {
            return ' acfm-bg-' . $bg;
        }

        return '';
    }

    public static function bgImage()
    {
        $bg_image = get_sub_field('bg_image');
        $bg_image_sm = get_sub_field('bg_image_sm');

        if ($bg_image && $bg_image_sm) {
            return '<div class="acfm-bg-image acfm-bg-image--sm" style="background-image:url(' . $bg_image_sm . ')"></div>' .
                '<div class="acfm-bg-image acfm-bg-image--md" style="background-image:url(' . $bg_image . ')"></div>';
        } elseif ($bg_image || $bg_image_sm) {
            $bg_image = $bg_image ?: $bg_image_sm;

            return '<div class="acfm-bg-image" style="background-image:url(' . $bg_image . ')"></div>';
        }

        return '';
    }

    public static function widgetsBgImage()
    {
        $bg_image = get_field('bg_image', 'options');

        if ($bg_image) {
            return '<div class="acfm-bg-image acfm-bg-image__widgets" style="background-image:url(' . $bg_image . ')"></div>';
        }

        return '';
    }

    public static function bgVideo()
    {
        $hp_video = get_sub_field('hp_video');
        $poster =  get_sub_field('bg_image');

        if ($hp_video) {
            return '<div class="acfm-bg-video"><video autoplay loop muted playsinline poster=' . $poster . '>
                    <source src=' . $hp_video['url'] .' type="video/mp4">
                </video></div><div class="acfm-bg-video-bg"></div>';
        }

        return '';
    }

    public static function bgImageAlign()
    {
        $align = get_sub_field('bg_align');
        if ($align) {
            return ' acfm-bg-image--align-' . $align;
        }

        return '';
    }

    public static function zIndex()
    {
        $zindex = get_sub_field('z_index');
        if ($zindex) {
            return ' acfm-z-index--minus';
        }

        return '';
    }

    public static function bgImageSize()
    {
        $size = get_sub_field('bg_size');
        if ($size) {
            return ' acfm-bg-image--size-' . $size;
        }

        return '';
    }

    public static function alignCenter()
    {
        $align_center = get_sub_field('align_center');

        if ($align_center) {
            return ' acfm-text-align-center';
        }

        return '';
    }

    public static function textColor()
    {
        $text_color = get_sub_field('text_color');

        if ($text_color) {
            return ' acfm-text-color-' . $text_color;
        }

        return '';
    }

    public static function colourful()
    {
        $colourful = get_sub_field('colourful');

        return $colourful ? 'colourful' : 'monochrome';
    }

    public static function colourfulClass()
    {
        if (App::layout() !== 'footer-payments') {
            return;
        }

        return ' acfm-' . self::colourful();
    }

    public static function moduleAttr()
    {
        return self::padding() .
            self::zIndex() .
            self::class() .
            self::bg() .
            self::bgImageAlign() .
            self::bgImageSize() .
            self::alignCenter() .
            self::textColor() .
            self::colourfulClass();
    }

    public static function sliderImage()
    {
        $slider_image = get_sub_field('image');
        $slider_image_sm = get_sub_field('image_sm');
        $image_class = get_sub_field('image_class');
        if ($slider_image && $slider_image_sm) {
            return '<div class="acfm-slider__bg--sm ' . $image_class . '" style="background-image:url(' . $slider_image_sm['url'] . ')"></div>' .
                '<div class="acfm-slider__bg--md ' . $image_class . '" style="background-image:url(' . $slider_image['url'] . ')"></div>';
        } elseif ($slider_image || $slider_image_sm) {
            $bg_image = $slider_image ?: $slider_image_sm;

            return '<div class="acfm-slider__bg ' . $image_class . '" style="background-image:url(' . $bg_image['url'] . ')"></div>';
        }

        return '';
    }

    public static function rowOrReverse()
    {
        $reverse_columns = get_sub_field('reverse_columns');

        if ($reverse_columns) {
            return ' acfm-row--reverse-columns';
        }

        return ' acfm-row';
    }

    public static function verticalAlignment()
    {
        $alignment_stretch = get_sub_field('vertical_alignment');

        if ($alignment_stretch) {
            return ' acfm-row--align-stretch';
        }

        return ' acfm-row--align-center';
    }

    public static function justifyContent()
    {
        $rowAlignment = get_sub_field('justify_content');

        if ($rowAlignment) {
            return ' acfm-row--justify-' . $rowAlignment;
        }

        return '';
    }

    public static function columnsCount()
    {
        $columnsCount = count(get_sub_field('columns'));

        if ($columnsCount) {
            return ' acfm-colsCount-' . $columnsCount;
        }

        return '';
    }

    public static function footerTitle($acfTitle = 'title')
    {
        $title = get_sub_field($acfTitle);

        if ($title) {
            return '<h4 class="acfm-footer-main__title">' . $title . '</h4>';
        }

        return '';
    }

    public static function decorEl($decorDirection = '')
    {
        $decor = $decorDirection ?: get_sub_field('decor');

        if ($decor) {
            return '<div class="acfm-decor acfm-decor--' . $decor . '"><div class="acfm-decor__inner"></div></div>';
        }

        return '<div class="acfm-decor"></div>';
    }

    public static function linkTarget()
    {
        $link_target = get_sub_field('target');

        if ($link_target === 'blank') {
            return 'target=_blank';
        }
        if ($link_target === 'self') {
            return 'target=_self';
        }
        if ($link_target === 'download') {
            return 'download';
        }

        return 'target=_blank';
    }

}
