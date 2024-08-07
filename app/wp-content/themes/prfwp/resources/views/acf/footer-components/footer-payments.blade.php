@set($component, 'acfm-'. App::layout())
@acfmodule()
@set($colourful, Page::colourful())
@set($fields, get_fields('options'))
@container
<ul class="{{$component}}__list acfm-{{$colourful}}">
  @fields('footer_payments')
  @set($icon, get_sub_field('footer_payment'))
  <li class="{{$component}}__icon svg-icon-{{$icon}} {{$colourful}}">
    @include('svg.acf.payments.' . $icon)
  </li>
  @endfields
</ul>
@endcontainer
@endacfmodule
