@set($component, 'acfm-'. App::layout())

@acfmodule(div)
<div class="{{ $component }}__inner">
  {!! Page::footerTitle() !!}

  <div class="{{ $component }}__form">
    @shortcode('[contact-form-7 id="'.get_sub_field('footer_form').'"]')
  </div>
</div>
@endacfmodule(div)
