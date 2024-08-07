<?php
$component = 'prfw-cfd-popup';
if(have_rows( 'cfd_popup', 'option' ))
while(have_rows( 'cfd_popup', 'option' )) : the_row();
$cfdPopupCache = get_sub_field( 'cfd_popup_cache' ) ? ' ' . $component . '__cache' : '';

if(get_sub_field( 'cfd_popup_title' ) || get_sub_field( 'cfd_popup_text' )) : ?>
<div class="prfw-common {{$component}}{{$cfdPopupCache}}">
  <div class="modal">
    <div class="prfw-modal">
      <div class="{{$component}}__dialog">
        <div class="{{$component}}__content">

          <div class="{{$component}}__content-textarea">
            @hassub('cfd_popup_title')
            <h1 class="{{$component}}__title">
              @sub('cfd_popup_title')
            </h1>
            @endsub

            @hassub('cfd_popup_text')
            <div class="{{$component}}__text">
              @sub('cfd_popup_text')
            </div>
            @endsub
          </div>

          <div class="{{$component}}__btn-wrapper">
            <button class="prfw-btn prfw-btn-primary {{$component}}__button">
              @hassub('cfd_button_text')
              @sub('cfd_button_text')
              @endsub
            </button>
          </div>


        </div>
      </div>
    </div>
    <div class="modal-backdrop"></div>
  </div>
</div>
<?php endif; ?>
<?php endwhile; ?>
