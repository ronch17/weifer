@php
  $style = str_replace(' ', '-', strtolower(get_sub_field('class')));
  $margin = str_replace(' ', '-', strtolower(get_sub_field('margin_bottom')));
  $ripple = ($style === 'primary' || $style === 'outline') ? ' acfm-ripple' : '';
  $class = 'acfm-btn' . ($style ? ' acfm-btn-' . $style : '') . $ripple . ( $margin ? ' acfm-margin-bottom--'. $margin : '' );
@endphp

@set($link, get_sub_field('page_url') ? get_sub_field('page_url') : ( get_sub_field('url') ? get_sub_field('url') : '#') )

@hassub('button_label')
<a class="{{$class}}"
   href="{{$link}}"
  {!! App::hideFor() !!}>
  <span class="acfm-btn__label">@sub('button_label')</span>
</a>
@endsub
