@acfmodule(footer)
{!! Page::bgImage() !!}
@container
@layouts('footer_components')
@include('acf.footer-components.' . App::layout())
@endlayouts()
@endcontainer
@endacfmodule(footer)



