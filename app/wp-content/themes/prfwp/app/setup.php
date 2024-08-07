<?php

namespace App;

use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    $widgets_url =
        defined('CRM_ENV') && CRM_ENV === 'development' ? WIDGETS_URL
            : (get_field('WIDGETS_URL', 'option') ? get_field('WIDGETS_URL', 'option') : WIDGETS_URL);

    $document_domain = get_field( 'DOCUMENT_DOMAIN', 'option' ) ? get_field( 'DOCUMENT_DOMAIN', 'option' ) : DOCUMENT_DOMAIN;

    if (function_exists('wpcf7_enqueue_scripts')) {
        wp_deregister_script('contact-form-7');
    }

    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');

    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');

    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', null, null, true);
    wp_enqueue_script('lottie', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js', null, null, true);
    wp_enqueue_script('angular-js', "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js", ['jquery'], null, true);
    wp_enqueue_script('prf_widgets_script', $widgets_url . '/latest/prf.widgets.js', ['prf_widgets_config'], null, true);
    if ( defined( 'CRM_ENV' ) && CRM_ENV === 'development' ) {
        wp_enqueue_script( 'prf_widgets_config', $widgets_url . '/crm.widgets.config.js', [ 'angular-js' ], null, true );
    } else {
        wp_enqueue_script( 'prf_widgets_config', get_bloginfo( 'template_directory' ) . '/assets/scripts/widget-config.js', [ 'angular-js' ], null, true );
        wp_localize_script('prf_widgets_config', 'domain', [ 'url' => $document_domain]);
    }

    if (function_exists('wpcf7_enqueue_scripts')) {
        wp_enqueue_script('contact-form-7', asset_path('scripts/contact-form-7.js'), ['prf_widgets_script'], null, true);
        $wpcf7 = array(
            'apiSettings' => array(
                'root' => esc_url_raw(rest_url('contact-form-7/v1')),
                'namespace' => 'contact-form-7/v1',
            ),
        );
        wp_localize_script('contact-form-7', 'wpcf7', $wpcf7);
    }

    if (!is_page_template('views/template-platform-loader.blade.php')) {
        if (is_rtl()) {
            wp_enqueue_style('Cairo-font', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap', false, null);
            wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
        } else {
            wp_enqueue_style('sage/g-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false, null);
            wp_enqueue_style('sage/rtl/main.css', str_replace('.rtl', '', asset_path('styles/main.css')), false, null);
        }

        wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['prf_widgets_script'], null, true);
        wp_localize_script('sage/main.js', 'main', array(
                'home_url' => home_url(),
                'rtl' => is_rtl(),
                'PLATFORM_BRAND_GUST_TOKEN' => CFD_PLATFORM_TOKEN,
                'navSVGArrow' => '<svg class="svg-arrow"><use xlink:href="#arrow"/></svg>',
                //'navSVGArrow'         => '<i class="acfm-arrow">></i>',
                'navScreenReaderText' => [
                    'expand' => __('Expand child menu', 'sage'),
                    'collapse' => __('Collapse child menu', 'sage')
                ]
            )
        );
    }

    if (is_page_template('views/template-cpt-tax-tabs.blade.php')) {
        wp_enqueue_script('sage/cpt-tax-tabs.js', asset_path('scripts/cpt-tax-tabs.js'), ['sage/main.js'], null, true);

        if (is_rtl()) {
            wp_enqueue_style('sage/rtl/cpt-tax-tabs.css', asset_path('styles/cpt-tax-tabs.css'), false, null);
        } else {
            wp_enqueue_style('sage/cpt-tax-tabs.css', str_replace('.rtl', '', asset_path('styles/cpt-tax-tabs.css')), false, null);
        }
    }

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_page_template('views/template-platform-loader.blade.php')) {
        wp_dequeue_style('prf_widgets_style');


        wp_enqueue_style('prf_widgets_style_custom', $widgets_url . '/latest/cfd-platform-top-bar.css', null, null);
        wp_enqueue_script('sage/cfd-popup.js', asset_path('scripts/cfd-popup.js'), null, true);
        wp_enqueue_style('sage/cfd-popup.css', asset_path('styles/cfd-popup.css'), false, null);
    }
}, 100);

add_filter('wp_default_scripts', function (&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.2.1');
    }
});

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {

    load_theme_textdomain('sage', get_template_directory() . '/lang');

    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    //add_theme_support('soil-disable-rest-api');
    add_theme_support('soil-disable-asset-versioning');
    add_theme_support('soil-disable-trackbacks');
    //add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
    //add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-js-to-footer');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'customer_widgets' => __('Customer Widgets', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];
    register_sidebar([
            'name' => __('Primary', 'sage'),
            'id' => 'sidebar-primary'
        ] + $config);
    register_sidebar([
            'name' => __('Footer', 'sage'),
            'id' => 'sidebar-footer'
        ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();

        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
