@php
  $title = get_field('agreement_title', 'option');
  $text = get_field('agreement_text', 'option');
@endphp

@group('agreement_link', 'option')
@php
  $urlLabel = get_sub_field('agreement_label_url');
  $urlLink = get_sub_field('agreement_url');
@endphp
@endgroup

@if(get_field('agreement_popup', 'option'))
  <prfwp-generic-popup
    ng-if="prf.customer"
    title-text="{{$title}}"
    body-text="{{$text}}"
    url-label="{{$urlLabel}}"
    url-link="{{$urlLink}}"
    close-only="true"
    button-text="Confirm"
    cancel-btn="true"
    cancel-text="Cancel"
    checkbox="true"
    padding="true"
    dialog-width="35rem"
    namespace="agreementConfirmation"
  ></prfwp-generic-popup>
@endif
