@php
  $signup_url =  get_sub_field('signup_url');
  $reward_message = get_sub_field('reward_message');
  $widgets_theme = get_field('WIDGETS_THEME', 'option');
@endphp

<prf-theme-provider theme="{!! $widgets_theme !!}">
  <prf-referee-landing
    sign-up-base-url="'{{$signup_url}}'"
    reward-message="'{{$reward_message}}'"
  ></prf-referee-landing>
</prf-theme-provider>
