@set($component, 'acfm-'. App::layout())
@hassub('calendar_widget')
{!! get_sub_field('calendar_widget') !!}
@endsub
<div class="{{$component}}">
  <div id="xswidgetcontainer" class="{{$component}}__item"></div>
</div>
