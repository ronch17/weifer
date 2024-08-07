@layouts('footer_content', 'option')
    @include('acf.footer-components.' . App::layout())
@endlayouts()

{{--<a id="back-top-btn">@svg(arrow)</a>--}}

<button class="back-to-top" type="button"></button>
