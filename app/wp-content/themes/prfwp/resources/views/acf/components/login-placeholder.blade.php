@set($component, 'acfm-'. App::layout())

<div class="{{$component}}"
     @hassub('background')
style="background: url(@sub(background)) no-repeat top center / cover"
@endsub
>
<div class="{{$component}}__left {{$component}}__wrapper">
  @hassub('title-left')
  <div class="{{$component}}__title">@sub('title-left')</div>
  @endsub

  @hassub('subtitle-left')
  <div class="{{$component}}__subtitle">@sub('subtitle-left')</div>
  @endsub

  @hassub('button-left')
  <div class="{{$component}}__button">@sub('button-left')</div>
  @endsub
</div>
<div class="{{$component}}__right {{$component}}__wrapper">
  @hassub('title-right')
  <div class="{{$component}}__title">@sub('title-right')</div>
  @endsub

  @hassub('subtitle-right')
  <div class="{{$component}}__subtitle">@sub('subtitle-right')</div>
  @endsub

  @hassub('button-right')
  <div class="{{$component}}__button">@sub('button-right')</div>
  @endsub
</div>
</div>
