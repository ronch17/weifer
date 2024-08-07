@set($component, 'acfm-'. App::layout())
@set($component, get_sub_field('style') ? 'acfm-inline-' . App::layout() : 'acfm-' . App::layout())

<?php
$default_key = '5bfe9399760e9545853738';
if ( defined( 'CRM_ENV') && CRM_ENV === 'development' ):
    $form_key = $default_key;
  else:
      $form_key = get_field( 'form_key', 'option' );
endif;
?>

<div class="{{$component}}">

  <div class="{{$component}}__form-wrapper">

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

    <div class="{{$component}}__form">
      <prf-content-restrict>
        <prf-on-authorized>
          <!-- This part will be displayed for authorized countries. It may contain any arbitrary content -->
          <prf-sign-up-widget
            form-key="{{$form_key}}">
          </prf-sign-up-widget>
        </prf-on-authorized>
        <prf-on-blocked>
          <!-- This part is optional. it can be displayed for restricted countries -->
          <h1>{{_e('Sorry,', 'sage')}}</h1>
          <p>{{_e('We currently do not support registrations from your country.', 'sage')}}</p>
        </prf-on-blocked>
      </prf-content-restrict>
    </div>

  </div>
</div>
