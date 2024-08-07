@set($component, 'acfm-'. App::layout())

<div class="{{$component}}">
  <div class="{{$component}}__wrapper">
    <prf-login-widget disable-customer-bar="true" redirect-url={{ App::url('/deposit')}}></prf-login-widget>
  </div>
  <div class="{{$component}}__footer">
    <a href="{{ App::url('/forgot-password')}}"
       class="{{$component}}__footer-btn">
      {{_e('Forgot Password?', 'sage')}}
    </a>
  </div>
</div>
