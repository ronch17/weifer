@set($tableNotice, get_sub_field('ng_assets_notice'))
@set($selectedRules, get_sub_field('selected_rules'))
@set($assetStyle, 'acfm-assets-' . get_sub_field('ng_assets_style'))
@set($assetTicker,get_sub_field('assets_ticker') ? ' acfm-assets-ticker' : '')


<div class="{{$assetStyle}}{{$assetTicker}}">
  <prf-assets-table-manager-component
    selected-rules="[{{$selectedRules}}]"
  >
    <prfwp-table-notice>
      {!! $tableNotice !!}
    </prfwp-table-notice>
  </prf-assets-table-manager-component>
</div>
