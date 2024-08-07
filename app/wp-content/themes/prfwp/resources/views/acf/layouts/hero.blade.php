@set($hideBg, get_sub_field('hide_on') ? 'acfm-bg-image-hide-' . strtolower(get_sub_field('hide_on')) : '')

@acfmodule

@if(App::hasSlider())
  @layouts('components')
  @include ('acf.components.'. App::layout())
  @endlayouts
@else
  @unless(App::hasSlider())

    @if($hideBg)
      <span class="{{$hideBg}}">
      @endif
        {!! Page::bgImage() !!}
        {!! Page::bgVideo() !!}
        @if($hideBg)
      </span>
    @endif

  @endunless
  @container
  @layouts('components')
  @include ('acf.components.'. App::layout())
  @endlayouts
  @endcontainer
@endif
@endacfmodule
