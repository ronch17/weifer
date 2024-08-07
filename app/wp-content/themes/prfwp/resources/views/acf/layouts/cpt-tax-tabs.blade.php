@php
  use App\Controllers\CategoriesTabs;

  global $post;

  $customPostTypeSlug = get_sub_field('custom_post_type');
  $taxonomySlug = get_sub_field('taxonomy');
  $terms = (new CategoriesTabs())->buildTaxonomyTermsArr($customPostTypeSlug, $taxonomySlug);

 $component = 'acfm-' . App::layout();
@endphp
@acfmodule
<div class="{{ $component }}__container container">
  @if(count($terms) > 1)
    <div class="{{ $component }}__nav-wrapper">
      <a class="{{ $component }}__nav-toggle acfm-js-tabsToggle" id="{{ $component }}Toggle" role="button"
         data-toggle="collapse" href="#{{ $component }}Nav" aria-expanded="false"
         aria-controls="{{ $component }}Nav"></a>
      <nav class="{{ $component }}__nav acfm-js-tabsNav nav collapse show" role="tablist" id="{{ $component }}Nav">
        @foreach( $terms as $term )

          <a target="_self" href="#{{$term['id']}}"
             class="{{ $component }}__nav__link acfm-js-tabsLink {{$term['linkClass']}}"
             id="{{$term['id']}}-tab" data-toggle="tab" role="tab" aria-controls="{{$term['id']}}"
             aria-selected="{{$term['ariaSelected']}}">
            @includeIf('svg.acf.faq.' . $term['id'])
            <span>{{ $term['name'] }} <span class="{{ $component }}__nav__badge">{{count($term['posts'])}}</span></span>
          </a>
        @endforeach
      </nav>
    </div>
  @endif

  @foreach( $terms as $term )
    <div id="{{ $term['id'] }}" class="{{ $component }}__term fade{{$term['tabPaneClass']}}">
      @if($term['description'])
        <div class="{{ $component }}__term__description">{!! $term['description'] !!}</div>
      @endif
      <ul class="{{ $component }}__term__list">
        @foreach($term['posts'] as $key=>$post)
          @php  setup_postdata($post); @endphp
          @if(get_sub_field('accordion'))
            @include('acf.sub-components.accordion-on', [$key, $post, $id = $term['id']])
          @else
            @include('acf.sub-components.accordion-off', [$key, $post, $id = $term['id']])
          @endif
          @php  wp_reset_postdata() @endphp
        @endforeach
      </ul>
    </div>
  @endforeach
</div>
@endacfmodule
