@acfmodule(div)
@set($component, 'acfm-'. App::layout())

@hassub('image_sm')
<img src="@sub('image_sm', 'url')"
     alt="@sub('image_sm', 'alt')"
     width="@sub('new_width')"
     class="{{$component}}--sm "
     height="auto">
@endsub()

@hassub('image')
<img class="@sub('image_class')"
     src="@sub('image', 'url')"
     alt="@sub('image', 'alt')"
     @hassub('image_sm') class="{{$component}}--md" @endsub
     width="@sub('new_width')"
     height="auto">
@endsub()

@endacfmodule(div)
