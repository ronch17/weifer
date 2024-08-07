@set($footerTitle, get_sub_field('title') ? '' : ' acfm-text-bold')
@set($component, 'acfm-'. App::layout())

@php
  $menuID = get_sub_field('footer_menu');
  if(!empty($menuID)){
   $menu = wp_get_nav_menu_items($menuID);
   $menuObject = wp_get_nav_menu_object($menuID );
 }
@endphp
@if(!empty($menuID))
  @php
    $menuTitle = strtolower(str_replace(' ', '-', get_sub_field('title')));
  @endphp

  <nav class="{{$component}}">

    @if($menuTitle)
      <a class="{{$component}}__anchor" href="#footerMenu_{{$menuTitle}}">
        {!! Page::footerTitle() !!}
      </a>
      <ul class="{{$component}}__menu {{$menuTitle}}"
          id="footerMenu_{{$menuTitle}}">
        @foreach($menu as $menu_item)
          @set($target, $menu_item->target)
          <li class="{{$component}}__item">
            <a
              class="{{$component}}__link{{$footerTitle}} {{( $menu_item->object_id == get_queried_object_id() ) ? 'active' : '' }}"
              href="{{ $menu_item->url }}" {{ $target ? "target=${target}" : '' }}>{{ $menu_item->title }}</a>
          </li>
        @endforeach
      </ul>
    @else
      @foreach($menu as $menu_item)
        @set($target, $menu_item->target)
        <a class="{{$component}}__anchor-single"
           href="{{ $menu_item->url }}" {{ $target ? "target=${target}" : '' }}>
          <h4>{{$menu_item->title}}</h4>
        </a>
      @endforeach
    @endif
  </nav>
@endif
