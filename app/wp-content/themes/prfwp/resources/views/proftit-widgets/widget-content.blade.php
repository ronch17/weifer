@php
  $widgets_theme = get_field('WIDGETS_THEME', 'option');
@endphp

@if (is_page( 'deposit' ))
  @include('proftit-widgets.svg.symbols')
@endif

<div class="prfwp-contentWidgets__wrapper">
  <div class="prfwp-contentWidgets__sidebar">
    <a class="prfwp-navbar__brand prfwp-brand" href="{{ home_url(App::homeURL()) }}"
       title="{{ get_bloginfo('name', 'display') }}">
      @svg(Logo)
    </a>
    <div ng-cloak ng-if="prf.customer" class="prfwp-contentWidgets__credentials">
      <div class="prfwp-contentWidgets__credentials__user">
        <span class="prfwp-contentWidgets__credentials__user__name">@{{prf.customer.firstName}} @{{prf.customer.lastName}}!</span>
        <span class="prfwp-contentWidgets__credentials__user__id">(@{{prf.tradingAccount.externalAccountId}})</span>
      </div>
      <div class="prfwp-contentWidgets__credentials__balance">
        <div class="prfwp-contentWidgets__credentials__balance__balance">
          {{_e('Balance:', 'sage')}}<prf-account-balance-widget
            ng-cloak ng-if="prf.tradingAccount"></prf-account-balance-widget>
        </div>
        <div class="prfwp-customerTopBar__detail loginprfw__account-switcher prfw-common">
          <prf-account-switcher ng-cloak ng-if="prf.tradingAccount"></prf-account-switcher>
        </div>
      </div>
    </div>

    <div class="prfwp-contentWidgets__navigation" {!! App::hideFor('Guest') !!}>
      @if (has_nav_menu('customer_widgets'))
        {!! wp_nav_menu(['theme_location' => 'customer_widgets',
        'menu_class' => 'prfwp-contentWidgets__menu collapse',
        'menu_id' => 'customerWidgetsNavigation']) !!}
      @endif
    </div>
  </div>


  <div class="prfwp-contentWidgets__container">
    <div class="prfwp-navbar__navigation topNavigation collapse" id="topNavigation">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'prfwp-navbar__menu',
            'container' => false
        ]) !!}
      @endif
      <div class="prfwp-customer__navigation" ng-cloak ng-show="prf.customer">
        @if (has_nav_menu('my_account'))
          {!! wp_nav_menu([
              'theme_location' => 'my_account',
              'menu_class' => 'prfwp-navbar__menu prfwp-customer__menu',
              'container' => false
          ]) !!}
        @endif
      </div>
      <div class="prfwp-loginWidget-wrapper">
        <div class="prfwp-loginWidget" ng-cloak ng-show="!prf.customer">
          <a class="prfwp-loginWidget__loginPopupCtrl acfm-btn-material collapsed"
             data-toggle="collapse"
             data-target=".prfwp-loginWidget__loginPopup"
             aria-controls="loginPopup"
             aria-expanded="false"
             aria-label="Toggle Login Popup">
            {{_e('Login', 'sage')}}
          </a>
          <div id="loginPopup" class="prfwp-loginWidget__loginPopup collapse">
            <div class="prfwp-loginWidget__loginPopup__inner">
              <div class="prfwp-loginWidget__loginPopup__loginContent">
                <div class="prfwp-loginWidget__loginPopup__loginTitle">{{_e('Login to your account or', 'sage')}} <a
                    href="{{ App::url('/open-account')}}">
                    {{_e('Sign Up', 'sage')}}
                  </a></div>
                <prf-login-widget disable-customer-bar="true"></prf-login-widget>
                <div class="prfwp-loginWidget__footer">
                  <a href="{{ App::url('/forgot-password')}}"
                     class="prfwp-loginWidget__forgotPasswordBtn">
                    {{_e('Forgot Password?', 'sage')}}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <prf-content-restrict>
          <prf-on-authorized>
            <a ng-cloak ng-show="!prf.customer" href="{{ App::url('/open-account')}}"
               class="prfwp-loginWidget__signUpBtn-lg acfm-btn-material">
              {{_e('Get started', 'sage')}}
            </a>
          </prf-on-authorized>
        </prf-content-restrict>
        <div class="prfwp-loginWidget-wrapper">
          <a ng-cloak ng-show="prf.customer" class="prfwp-loginWidget__depositBtn"
             href="{{App::url('/deposit')}}">
            {{_e('Deposit', 'sage')}}
          </a>
          <a ng-cloak ng-show="prf.customer" href="{{ home_url(App::homeURL()) }}"
             class="prfwp-loginWidget__logoutBtn acfm-btn-material"
             onclick="prf.loginWidget.logout();">{{_e('Logout', 'sage')}}
          </a>
        </div>
      </div>
    </div>
    {!! Page::widgetsBgImage() !!}

    <div class="prfwp-contentWidgets__header">
      @if (has_nav_menu('customer_widgets'))
        {!! wp_nav_menu(['theme_location' => 'customer_widgets',
        'menu_class' => 'prfwp-contentWidgets__menu__mobile collapse',
        'menu_id' => 'customerWidgetsNavigation']) !!}
      @endif
      <button class="prfwp-contentWidgets__burger prfwp-burger collapsed"
              data-toggle="collapse"
              data-target=".prfwp-contentWidgets__menu__mobile"
              aria-controls="customerWidgetsNavigation"
              aria-expanded="false"
              aria-label="Toggle navigation"
        {!! App::hideFor('Guest') !!}>
        <span class="prfwp-burger__span prfwp-burger__span--first"></span>
        <span class="prfwp-burger__span prfwp-burger__span--middle"></span>
        <span class="prfwp-burger__span prfwp-burger__span--last"></span>
      </button>
      @if ( App::widgetType() != 'guest')
        @if (App::widgetType() != 'refer-a-friend' )
          <h1 class="prfwp-contentWidgets__title" {!! App::hideFor('Guest') !!}>
        <span>
          @if(get_field('title'))
            @field('title')
          @else
            {!!App::title()!!}
          @endif
          @hasfield('subtitle')
          <small>@field('subtitle')</small>
          @endfield
        </span>
            @if (App::widgetType() == 'tradingAccount')
              @hasfield('hide_new_account')
              <a class="prfwp-contentWidgets__addNewAccount"
                 href="{{App::url('/create-new-account')}}" {!! App::hideFor('Guest') !!}>
                <span>{{_e('Add New Live Account', 'sage')}}</span>
              </a>
              @endfield
            @elseif (App::widgetType() == 'transactions')
              <a class="prfwp-contentWidgets__addNewAccount"
                 href="{{home_url('/withdrawal/')}}" {!! App::hideFor('Guest') !!}>
                {{_e('Add Withdrawal Request', 'sage')}}
              </a>
            @endif
          </h1>
        @endif
        <h3 class="prfwp-contentWidgets__guestNotice" {!! App::hideFor('Customer') !!}>
          {{sprintf(
            _x(
              'Please login to see %1$s page!',
              'Not login users will see this in customers widgets pages. %1$s represent current page title',
              'sage'
              ),
              App::title()
            )}}
        </h3>
      @else
        <h1 class="prfwp-contentWidgets__title">
          @hasfield('title')
          @field('title')
          @endfield
          @hasfield('subtitle')
          <small>@field('subtitle')</small>
          @endfield
        </h1>
      @endif

    </div>
    <div class="prfwp-contentWidgets__main">
      @if ( App::widgetType() != 'guest')
        <div {!! App::hideFor('Guest') !!}>
          @endif
          @hasfield('before_widget')
          <div class="prfwp-contentWidgets__beforeWidget">
            @field('before_widget')
          </div>
          @endfield
          <div class="prfwp-contentWidgets__widget {{get_field('hide_for_all') ? 'ng-hide' : ''}}">
            <prf-theme-provider theme="{!! $widgets_theme !!}">
              {!! App::widget() !!}
            </prf-theme-provider>
            @if (App::widgetType() == 'deposit' )
              @hasfield('ccx_deposit_link')
              <div
                class="prfwp-contentWidgets__ccx" {{get_field('hide_on_demo_account') ? 'ng-hide="prf.tradingAccount.isDemo"' : ''}}>
                <a type="button" target="_blank" class="prfw-btn-primary prfwp-contentWidgets__ccx-btn"
                   href="@field('ccx_deposit_link')">
                  @include('proftit-widgets.svg.ccx')
                  <span>Crypto Exchange</span></a>
              </div>
              @endfield
            @endif
          </div>
          @hasfield('after_widget')
          <div class="prfwp-contentWidgets__afterWidget">
            @field('after_widget')
          </div>
          @endfield
          @if ( App::widgetType() != 'guest')
        </div>
      @endif
    </div>
  </div>
</div>
