@set($component, 'acfm-post-single')

<article @php post_class() @endphp>
  <div class="{{$component}}">
    <div class="{{$component}}__container container">
      <header>
        <h1 class="{{$component}}__title entry-title">
          {!! get_the_title() !!}
        </h1>
      </header>
      <div class="{{$component}}__content entry-content">
        @php the_content() @endphp
      </div>
    </div>
  </div>
</article>
