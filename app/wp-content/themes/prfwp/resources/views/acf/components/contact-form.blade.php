@set($component, 'acfm-'. App::layout())

@acfmodule(div)

<div class="{{ $component }}__form-wrapper">

  @hassub('title')
  <div class="{{$component}}__title">
    @sub('title')
  </div>
  @endsub

  @hassub('subtitle')
  <div class="{{$component}}__subtitle">
    @sub('subtitle')
  </div>
  @endsub

  <div class="{{ $component }}__form">
    @shortcode('[contact-form-7 id="'.get_sub_field('contact_form').'"]')
  </div>

</div>
@endacfmodule(div)
