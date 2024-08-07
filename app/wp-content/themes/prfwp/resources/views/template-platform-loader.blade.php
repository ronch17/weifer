{{--
  Template Name: Platform Loader
--}}
@php
  $brand_id_option = get_field('BRAND_ID', 'option');
  $brand_id = $brand_id_option ? $brand_id_option : BRAND_ID;
  $default_lang_option = get_field('DEFAULT_LANG', 'option');
  $default_lang = $default_lang_option ? $default_lang_option : DEFAULT_LANG;
  $selected_platform_option = get_field('SELECTED_PLATFORM', 'option');
  $selected_platform = isset( $_GET['guestPlatformType']) ? $_GET['guestPlatformType'] : $selected_platform_option;
  $document_domain = get_field('DOCUMENT_DOMAIN', 'option');

  $platform_theme_page = get_field('theme');
  $platform_theme = isset($_GET['forex'])
      ? 'forex'
      : (isset($_GET['crypto'])
        ? 'crypto'
        : (isset($_GET['tradeo'])
          ? 'tradeo'
          : (isset($_GET['dark'])
            ? 'dark'
            : (isset($_GET['light'])
              ? 'light'
              : (isset($_GET['blue'])
                ? 'blue'
                : $platform_theme_page)))));

  $cfd_platform_version_option = get_field('CFD_PLATFORM_VERSION', 'option');
  $cfd_platform_version = $cfd_platform_version_option === 'latest' ? 'latest' : $cfd_platform_version_option.'/'.$cfd_platform_version_option;
  $cfd_platform_url_option = get_field('CFD_PLATFORM_URL', 'option');
  $cfd_platform_url = $cfd_platform_url_option . '/' . $cfd_platform_version .'/platformLoader.js';
  $cfd_platform_token = get_field('CFD_PLATFORM_TOKEN', 'option');
  $cfd_platform_theme_option = get_field('CFD_PLATFORM_THEME', 'option');
  $cfd_platform_theme = $platform_theme ? $platform_theme : $cfd_platform_theme_option;

  $bundle_platform_version_option = get_field('BUNDLE_PLATFORM_VERSION', 'option');
  $bundle_platform_version = $bundle_platform_version_option === 'latest' ? 'latest' : $bundle_platform_version_option.'/'.$bundle_platform_version_option;
  $bundle_platform_url_option = get_field('BUNDLE_PLATFORM_URL', 'option');
  $bundle_platform_url = $bundle_platform_url_option . '/' . $bundle_platform_version .'/platformLoader.js';
  $bundle_platform_token = get_field('BUNDLE_PLATFORM_TOKEN', 'option');
  $bundle_platform_theme_option = get_field('BUNDLE_PLATFORM_THEME', 'option');
  $bundle_platform_theme = $platform_theme ? $platform_theme : $bundle_platform_theme_option;

  $mt4_platform_url = get_field('MT4_PLATFORM_URL', 'option');
  $mt4_platform_options = get_field('MT4_PLATFORM_OPTIONS', 'option');
@endphp
  <!doctype html>
<html @php(language_attributes())>
@include('partials.head')
<body @php(body_class())>
@include('proftit-widgets.svg.cfd-sprite')
@php(do_action('get_header'))
<prf-widget-manager
  ng-app="prf"
  options="{
    defaultLang:'{{App::langSlug()}}',
    translation: {
      locations: [
        '/wp-content/uploads/locale-partials/'
      ],
      suffix: '.json'
    },
    'brandId': {{$brand_id}}
    }">
  @include('proftit-widgets.cfd-top-bar', ['is_platform' => true, 'top_bar_theme' => $platform_theme])
  <prf-platform-loader-widget
    selected-platform="'{{$selected_platform}}'"
    platform-options="
        {
          CFD: {
            pluginUrl: '{{$cfd_platform_url}}',
            brandToken: '{{$cfd_platform_token}}',
            documentDomain: '{{$document_domain}}',
            theme: '{{$cfd_platform_theme}}'
          },
          BUNDLE: {
            pluginUrl: '{{$bundle_platform_url}}',
            brandToken: '{{$bundle_platform_token}}',
            documentDomain: '{{$document_domain}}',
            theme: '{{$bundle_platform_theme}}'
            },
          MT4: {
            pluginUrl: '{{$mt4_platform_url}}',
            pluginOptions: {
                {{$mt4_platform_options}}
      }
  }
}">
  </prf-platform-loader-widget>
  <prf-site-location-tracking-widget
    page-name="'{{App::title() . ':' . $selected_platform}}'"
  ></prf-site-location-tracking-widget>
</prf-widget-manager>
@include('proftit-widgets.cfd-popup')
@php(do_action('get_footer'))
@php(wp_footer())
<?php
if ( function_exists( 'pll_current_language' ) && pll_current_language( 'slug' ) && pll_current_language( 'slug' ) != DEFAULT_LANG ) { ?>
<script>
  /* global Application */
  document.addEventListener('prf.platformLoader.load', function (e) {
    var checkExist = setInterval(function () {
      if (window.Application) {
        clearInterval(checkExist);
        Application.Libs.i18nResourceLoader.call('setLang', '<?php echo pll_current_language( 'slug' )?>');
      }
    }, 500);
  });
</script>
<?php } ?>

<?php
$custom_script_option = get_field( 'custom_script_option', 'option' );
$custom_script = get_field( 'custom_script', 'option' ) ? get_field( 'custom_script', 'option' ) : '';
if ( $custom_script_option && $custom_script ) {
?>
{!! $custom_script !!}
<?php } ?>
</body>
</html>
