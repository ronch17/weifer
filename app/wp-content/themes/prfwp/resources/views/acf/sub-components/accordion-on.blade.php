@php
  $ariaExpanded = $key == 0 ? 'true' : 'false';
  $headerClass = $key == 0 ? '' : ' collapsed';
  $contentClass = $key == 0 ? ' show' : '';
@endphp
<li class="{{ $component }}__item acfm-accordionOn">
 <div class="acfm-accordionOn__header{{$headerClass}}"
 type="button"
 data-toggle="collapse"
 data-target="#id-{{the_ID()}}"
 aria-expanded="{{$ariaExpanded}}"
 aria-controls="collapseOne">
  <h2 class="acfm-accordionOn__title">@title()</h2>
  <div class="acfm-accordionOn__plus"></div>
 </div>
 <div class="acfm-accordionOn__content collapse{{ $contentClass }}" id="id-{{the_ID()}}" data-parent="#{{ $id }}">
  <div class="acfm-accordionOn__text">@content()</div>
 </div>
 {{ edit_post_link(__('Edit', 'sage')) }}
</li>
