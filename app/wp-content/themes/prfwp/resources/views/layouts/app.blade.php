<!doctype html>
<html {!! get_language_attributes() !!}>
@include('partials.head')
<body @php body_class(App::bodyClasses()) @endphp>
{!! get_field('after_body_start', 'option') !!}
@include('svg.symbols', ['symbols' => ['logo', 'send', 'arrow', 'x', 'check']])
@php
  $brand_id_option = get_field('BRAND_ID', 'option');
  $brand_id = $brand_id_option ? $brand_id_option : BRAND_ID;
@endphp
<prf-widget-manager ng-app="prfwp"
                    options="{defaultLang: '{{App::langSlug()}}',
                              translation: {
                                locations: [
                                  '/wp-content/uploads/locale-partials/'
                                ],
                                suffix: '.json'
                              },
                              brandId: {{$brand_id}}}"
                    ng-class="{'prfwp-customer' : prf.customer}">
  @php do_action('get_header') @endphp
  @include('partials.header')
  <main class="prfwp-main" role="document">
    @yield('content')
  </main>
  @if (App\display_sidebar())
    <aside class="sidebar">
      @include('partials.sidebar')
    </aside>
  @endif

  @if (is_page( 'deposit' ))
    @include('popups.agreement')
  @endif

  <prf-tracker-widget cookiettl="43200"></prf-tracker-widget>

  <prf-site-location-tracking-widget
    page-name="'{{App::title()}}'"
  ></prf-site-location-tracking-widget>
</prf-widget-manager>

@php do_action('get_footer') @endphp
@include('partials.footer')
@php wp_footer() @endphp
{!! get_field('before_body_close', 'option') !!}
</body>
</html>

