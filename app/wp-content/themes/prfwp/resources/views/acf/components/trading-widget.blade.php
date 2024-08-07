@set($component, 'acfm-'. App::layout())
<div class="{{$component}}">
  {!! get_sub_field('trading_widget') !!}
</div>
