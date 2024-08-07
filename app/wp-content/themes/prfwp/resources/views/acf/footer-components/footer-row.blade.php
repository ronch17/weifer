@set($component, 'row')

<div
  class="acfm-{{$component}}{{ Page::rowOrReverse() }}{{ Page::verticalAlignment() }}{{ Page::justifyContent() }}{{ Page::columnsCount() }}">
  @fields('columns')
  @group('settings')
  @set($colMDWidth_class, get_sub_field('column_md_width') ? ' acfm-' . get_sub_field('column_md_width') : '')
  @set($colLGWidth_class, get_sub_field('column_lg_width') ? ' acfm-' . get_sub_field('column_lg_width') : '')
  @set($columns, get_sub_field('columns') ? ' acfm-columns-' . get_sub_field('columns') : '')
  @endgroup

  <div class="acfm-{{$component}}__col{{$colMDWidth_class}}{{$colLGWidth_class}}{{$columns}}">
    @layouts('column_components')
    @include('acf.footer-components.' . App::layout())
    @endlayouts()
  </div>
  @endfields
</div>

