@php
  function bool($var) {
    if ($var && ($var === 1 || $var == true) ) { return 'true'; }
    return 'false';
  }

  $cfd_platform_theme_option = get_field( 'CFD_PLATFORM_THEME', 'option' );
  $cfd_platform_disable_theme_switcher_option = get_field( 'DISABLE_THEME_SWITCHER', 'option' );
  $cfd_platform_theme        = $cfd_platform_theme_option ? $cfd_platform_theme_option : CFD_PLATFORM_THEME;
@endphp
<prf-cfd-platform-top-bar
  customer="prf.customer"
  trading-account="prf.tradingAccount"
  theme="'{{$cfd_platform_theme}}'"
  home-url="'{{App::homeURL()}}'"
  deposit-url="'{{App::url('/deposit/')}}'"
  account-url="'{{App::url('/account-summary/')}}'"
  sign-up-url="'{{App::url('/open-account')}}'"
  forgot-password-url="'{{App::url('/forgot-password')}}'"
  default-account-cancel-redirect-url="'{{App::url('/account-summary/')}}'"
  default-account-created-redirect-url="''"
  is-platform-page="{{bool($is_platform)}}"
  disable-theme-switcher="{{bool($cfd_platform_disable_theme_switcher_option)}}"
>
  <logo-element>
    <svg ng-cloak style="width: 7em;">
      @include('svg.symbols.logo')
    </svg>
  </logo-element>
</prf-cfd-platform-top-bar>
