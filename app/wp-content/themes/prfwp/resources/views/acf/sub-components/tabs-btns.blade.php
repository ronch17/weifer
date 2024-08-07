@php
  $style = str_replace(' ', '-', strtolower(get_sub_field('class')));
  $margin = str_replace(' ', '-', strtolower(get_sub_field('margin_bottom')));
  $ripple = ($style === 'primary' || $style === 'outline') ? ' acfm-ripple' : '';
  $class = 'acfm-tabs-btn ' . ($style ? ' acfm-tabs-btn ' . $style : '') . $ripple . ( $margin ? ' acfm-margin-bottom--'. $margin : '' );
@endphp

@set($link, get_sub_field('page_url') ? get_sub_field('page_url') : ( get_sub_field('url') ? get_sub_field('url') : '#') )

@hassub('button_label')


<li class="main-tab @sub('column_class') @sub('tab_class')" data-tab="@sub('tab_class')"
  {!! App::hideFor() !!}>
  @sub('button_label')
</li>
@endsub
