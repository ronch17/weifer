

@acfmodule(div)
@set($component, 'acfm-'. App::layout())

<ul class="tabs" id="tabs">
@fields('buttons')
@include('acf.sub-components.tabs-btns')
@endfields
</ul>

@fields('images')



<img
     id="@sub('image_ID')"
     src="@sub('image', 'url')"
     alt="@sub('image', 'alt')"
     class="tab-content"
     @hassub('image_sm') class="{{$component}}--md" @endsub
width="@sub('new_width')"
height="auto">
@endfields

@endacfmodule(div)
