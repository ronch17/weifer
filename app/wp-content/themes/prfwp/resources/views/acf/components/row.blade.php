@set($component, 'row')

@set($sliderOn, get_sub_field('SliderCheck') ? "splide__slide" : "list-none" )


<li class="{{$sliderOn}}">

<div
  class="acfm-{{$component}}
  {{ Page::rowOrReverse() }}{{ Page::verticalAlignment() }}{{ Page::justifyContent() }}{{ Page::columnsCount() }}">
  @fields('columns')
  @group('settings')
  @set($colMDWidth_class, get_sub_field('column_md_width') ? ' acfm-' . get_sub_field('column_md_width') : '')
  @set($colLGWidth_class, get_sub_field('column_lg_width') ? ' acfm-' . get_sub_field('column_lg_width') : '')
  @set($columns, get_sub_field('columns') ? ' acfm-columns-' . get_sub_field('columns') : '')
  @set($hideColumn, get_sub_field('hide_on') ? ' acfm-columns-hide-' . strtolower(get_sub_field('hide_on')) : '')
  @set($columnClass, get_sub_field('column_class'))
  @set($columnId, get_sub_field('column_id'))
  @endgroup

  <div id="{{$columnId}}" class="acfm-{{$component}}__col{{$colMDWidth_class}}{{$colLGWidth_class}}{{$columns}}{{$hideColumn}} {{$columnClass}}">
    @layouts('column_components')
    @include('acf.components.' . App::layout())
    @endlayouts()
  </div>
  @endfields
</div>
</li>
