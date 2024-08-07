<style>

  .page-loader {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left:0;
    background: #ffffff;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>

<div id="page-loader" class="page-loader">
  <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
  @svg(Logo)
</div>


<header class="prfwp-header">
  <nav class="prfwp-navbar">
    <div class="prfwp-navbar__container container">
      <a class="prfwp-navbar__brand prfwp-brand" href="{{ home_url(App::homeURL()) }}"
         title="{{ get_bloginfo('name', 'display') }}">
        @svg(Logo)
      </a>
      <button class="prfwp-navbar__burger prfwp-burger collapsed"
              data-toggle="collapse"
              data-target=".topNavigation"
              aria-controls="topNavigation"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="prfwp-burger__span prfwp-burger__span--first"></span>
        <span class="prfwp-burger__span prfwp-burger__span--middle"></span>
        <span class="prfwp-burger__span prfwp-burger__span--last"></span>
      </button>
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
              @svg(arrow)
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
                {{_e('Get Started', 'sage')}}
                @svg(arrow)
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
        @include('proftit-widgets.customer-top-bar')
      </div>
    </div>
  </nav>
</header>
