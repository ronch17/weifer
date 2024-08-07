<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller {
    public static function siteName() {
        return get_bloginfo( 'name' );
    }

    public static function homeURL() {
        if ( ! function_exists( 'pll_current_language' ) || pll_current_language( 'slug' ) == DEFAULT_LANG ) {
            return '/';
        }

        return '/' . pll_current_language( 'slug' ) . '/';
    }

    public static function langSlug() {
        if ( ! function_exists( 'pll_current_language' ) || ! pll_current_language( 'slug' ) ) {
            return DEFAULT_LANG;
        }

        return pll_current_language( 'slug' );
    }

    public static function getTargetURLbyLang( $current_lang, $url ) {
        if ( ! $current_lang || $current_lang == pll_default_language() ) {
            return home_url( $url );
        }

        $default_lang_post    = get_page_by_path( $url, OBJECT, 'page' );
        $default_lang_post_id = $default_lang_post->ID;
        $current_lang_post    = get_post( pll_get_post( $default_lang_post_id, $current_lang ) );
        $current_lang_slug    = $current_lang_post->post_name;

        return home_url( $current_lang . '/' . $current_lang_slug );
    }

    public static function url( $url ) {
        if ( ! function_exists( 'pll_current_language' ) ) {
            return home_url( $url );
        }

        return self::getTargetURLbyLang( pll_current_language(), $url );
    }

    public static function title() {
        if ( is_home() ) {
            if ( $home = get_option( 'page_for_posts', true ) ) {
                return get_the_title( $home );
            }

            return __( 'Latest Posts', 'sage' );
        }
        if ( is_archive() ) {
            return get_the_archive_title();
        }
        if ( is_search() ) {
            return sprintf( __( 'Search Results for %s', 'sage' ), get_search_query() );
        }
        if ( is_404() ) {
            return __( 'Not Found', 'sage' );
        }

        return get_the_title();
    }

    public static function hasSlider() {
        global $rows;

        $rows[2] = isset( $rows[2] ) ? $rows[2] : null;

        return $has_slider = $rows[2]['components'][0]['acf_fc_layout'] === 'slider';
    }

    public static function thumbnailClass() {
        $thumbnail = get_the_post_thumbnail_url();
        $slider    = self::hasSlider();

        if ( $thumbnail || $slider ) {
            return ' page-has-thumbnail';
        }

        return '';
    }

    public static function layout() {
        return preg_replace( "(_)", '-', get_row_layout() );
    }

    public static function widget()
    {
        $widget = get_field('widget');
        if (empty($widget)) {
            return null;
        }

        if ($widget === 'prf-forgot-password-widget' || $widget === 'prf-reset-password-widget') {
            return "<${widget}></${widget}>";
        } elseif ($widget === 'prf-trading-accounts-summary-widget') {
            return "<${widget} type=\"forex\" ng-if=\"prf.tradingAccount\"></${widget}>";
        } elseif ($widget === 'prf-deposit-widget') {
            return "<${widget} ng-if=\"prf.tradingAccount\"></${widget}>";
        } elseif ($widget === 'prf-refer-a-friend-widget') {
            return "<${widget} ng-if=\"prf.tradingAccount\"></${widget}>";
        } else {
            return "<${widget} ng-if=\"prf.tradingAccount\"></${widget}>";
        }
    }

    public
    static function widgetType()
    {
        $widget = get_field('widget');
        if (empty($widget)) {
            return null;
        }

        if ($widget === 'prf-forgot-password-widget' || $widget === 'prf-reset-password-widget') {
            return 'guest';
        } elseif ($widget === 'prf-trading-accounts-summary-widget') {
            return 'tradingAccount';
        } elseif ($widget === 'prf-trading-account-widget') {
            return 'transactions';
        } elseif ($widget === 'prf-deposit-widget') {
            return 'deposit';
        } elseif ($widget === 'prf-refer-a-friend-widget') {
            return 'refer-a-friend';
        }
        return 'default';
    }

    public static function hideFor( $hideFor = '' ) {
        if ( empty( $hideFor ) ) {
            $hideFor = get_sub_field( 'hide_for' );
        }
        if ( $hideFor === 'Customer' ) {
            return 'ng-cloak ng-if="!prf.customer"';
        }
        if ( $hideFor === 'Guest' ) {
            return 'ng-cloak ng-if="prf.customer"';
        }

        return null;
    }

    public static function mobileAlign() {
        $mobile_align = get_field( 'mobile_align' );

        if ( $mobile_align ) {
            return ' acfm-mobile-align';
        }

        return '';
    }

    public static function UserSelect() {
        $user_select = get_field( 'user_select', 'options' );

        if ( $user_select ) {
            return ' user-select-none';
        }

        return '';
    }

    public static function bodyClasses() {
        return self::thumbnailClass() . self::mobileAlign() . self::userSelect();
    }
}
