@php
  global $post;
  $atoz = Glossary::atoz();
  $range = array_keys($atoz);
  $menuKey = 0;
  $listKey = 0;
@endphp

<div class="glossary-atoz">
  <div class="glossary-atoz__menu-wrapper">
    <ul class="glossary-atoz__menu nav container" role="tablist">
      @foreach ($range as $alpha)
        @php
          $count = count($atoz[$alpha]);
          $ariaSelected = $menuKey == 0 ? 'true' : 'false';
          $contentClass = $menuKey == 0 ? 'active' : '';
        @endphp
        <li class="glossary-atoz__menu__item acfm-js-tabsNav"
            title="{{__('Terms', 'sage')}}:{{$count}}"
            data-alpha="{{$alpha}}">
          <a target="_self" href="#glossary_{{$alpha}}" class="acfm-js-tabsLink {{$contentClass}}"
             id="{{$alpha}}-tab" data-toggle="tab" role="tab" aria-controls="{{$alpha}}" aria-selected="{{$ariaSelected}}"
          >{{strtoupper($alpha)}}</a>
        </li>
        @php($menuKey++)
      @endforeach
    </ul>
  </div>

  <div class="glossary-atoz__list container">
    @foreach ($atoz as $alpha => $items)
      <div class="glossary-atoz__list__item fade {{$listKey == 0 ? ' active show' : ''}}"
           id="glossary_{{$alpha}}" role="tabpanel" aria-labelledby="{{$alpha}}-tab">
        <h4 class="glossary-atoz__title"><span>{{strtoupper($alpha)}}</span></h4>
        <ul class="glossary-atoz__group">
          {!! implode('', $items) !!}
        </ul>
      </div>
      @php($listKey++)
    @endforeach
  </div>
</div>
