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
        @if($hideBg)
      </span>
    @endif

  @endunless
  @container


      <div class="splide__track">
        <ul class="splide__list">

          @layouts('components')

          @include ('acf.components.'. App::layout())

          @endlayouts

        </ul>
      </div>

  @endcontainer
@endif
@endacfmodule
