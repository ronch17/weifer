@set($component, 'acfm-'. App::layout())

@acfmodule(div)

{!! Page::footerTitle('office_title') !!}


@hassub('address')
<div class="{{$component}}__address">
{{--  <i class="{{$component}}__icon">@svg(location)</i>--}}
  <div class="{{$component}}__info">
    <h6 class="{{$component}}__title">@sub('address_title')</h6>
    <div class="{{$component}}__text">@sub('address')</div>
  </div>
</div>
@endsub

@hassub('phone')
<div class="{{$component}}__phone">
  @set($phone, get_sub_field('phone'))
{{--  <i class="{{$component}}__icon">@svg(phone)</i>--}}
  <div class="{{$component}}__info">
    <h6 class="{{$component}}__title">@sub('phone_title')</h6>
    <a class="{{$component}}__link" href="tel:{{str_replace([' ', '-', '(', ')'], '', $phone)}}">{{$phone}}</a>
  </div>
</div>
@endsub

@hassub('email')
<div class="{{$component}}__email">
{{--  <i class="{{$component}}__icon">@svg(email)</i>--}}
  <div class="{{$component}}__info">
    <h6 class="{{$component}}__title">@sub('email_title')</h6>
    <a class="{{$component}}__link" href="mailto:@sub('email')">@sub('email')</a>
  </div>
</div>
@endsub

@endacfmodule(div)
