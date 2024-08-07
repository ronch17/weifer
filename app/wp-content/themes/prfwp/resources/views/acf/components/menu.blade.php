@php
  $menuID = get_sub_field('menu');
  if(!empty($menuID)){
   $menu = wp_get_nav_menu_items($menuID);
 }
@endphp

@if(!empty($menuID))
  <nav class="acfm-menu">
    <h4 class="acfm-menu__title">@sub('title')</h4>
    <ul class="acfm-menu__menu">
      @foreach($menu as $menu_item)
        @set($target, $menu_item->target)
        <li class="acfm-menu__item">
          <a class="acfm-menu__link {{( $menu_item->object_id == get_queried_object_id() ) ? 'active' : '' }}"
             href="{{ $menu_item->url }}" {{ $target ? "target=${target}" : '' }}>{{ $menu_item->title }}</a>
        </li>
      @endforeach
    </ul>
  </nav>
@endif
