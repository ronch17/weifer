@set($component, ' acfm-list-' . get_sub_field('style'))
@set($customClass, get_sub_field('class'))

<ul
  class="acfm-{{App::layout()}}{{$component}}  {{$customClass}}">
  @fields('list_generator')

  @set($link, get_sub_field('id_link') ? get_sub_field('id_link') : ( get_sub_field('url') ? get_sub_field('url') :
 '#') )

  @hassub('page_url')
  <a href="{{$link}}" class="{{$component}}__link" {{Page::linkTarget()}}>
    @endsub

    <li class="{{$component}}__item">

      @hassub('svg')
      <div class="{{$component}}__icon icon-{{str_replace('.', '-', get_sub_field('svg'))}}">
        @include('svg.acf.' . get_sub_field('svg'))
      </div>
      @endsub

      @hassub('image')
      <div class="{{$component}}__image">
        <img class="acfm-image" src="@sub('image', 'url')" alt="@sub('image', 'alt')">
      </div>
      @endsub

      @hassub('number')
      <div class="{{$component}}__number">
        <h3 class="acfm-number">@sub('number')</h3>
      </div>
      @endsub

      <div class="li-br">
      @hassub('title')
      <div class="{{$component}}__title">
        @sub('title')
      </div>
      @endsub

      @hassub('text')
      <div class="{{$component}}__text">
        @sub('text')
      </div>
      @endsub
      </div>

      @hassub('svg2')
      <div class="{{$component}}__icon2 icon-{{str_replace('.', '-', get_sub_field('svg2'))}}">
        @include('svg.acf.' . get_sub_field('svg2'))
      </div>
      @endsub


    </li>

    @hassub('page_url')
  </a>
  @endsub






  @endfields
</ul>
