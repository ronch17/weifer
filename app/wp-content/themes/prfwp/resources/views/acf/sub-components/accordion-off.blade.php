<li class="{{$component}}__item acfm-accordionOff">
    <h2 class="acfm-accordionOff__title">
        <span class="acfm-accordionOff__icon">
            {{--@svg(faq)--}}
        </span>
        @title()
    </h2>
    <div class="acfm-accordionOff__text">@content()</div>
    {{ edit_post_link(__('Edit', 'sage')) }}
</li>


