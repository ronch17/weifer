@set($component, 'acfm-'. App::layout())

<div class="{{$component}}-wrapper">

  <div class="{{$component}}__switcher-wrapper">
    <button class="{{$component}}__switcher switcher-first-group active">{{_e('Just Starting', 'sage')}}</button>
    <button class="{{$component}}__switcher switcher-second-group">{{_e('Next Level', 'sage')}}</button>
  </div>

  <ul class="{{$component}}">
    @fields('account_types')

    @php
      $title =  get_sub_field('title') ? get_sub_field('title') : '';
      $titleMobile = explode(' ',(trim($title)));
      $switchGroup = get_sub_field('switcher') ?  ' second-group' : ' first-group'
    @endphp

    <li title="{{$titleMobile[0]}}"
        class="{{$component}}__item {{strtolower(str_replace(' ', '-', get_sub_field('title')))}}{{$switchGroup}}">
      <div class="{{$component}}__item__container">

        @hassub('title')
        <div class="{{$component}}__title">
          @sub('title')
        </div>
        @endsub

        @hassub('price')
        <div class="{{$component}}__price">
          @sub('price')
        </div>
        @endsub

        <ul class="{{$component}}__fields">
          @fields('field')

          @php
            $active = get_sub_field('active') ? ' active' : ' hidden';
          @endphp

          <li class="{{$component}}__field{{$active}}">
            @hassub('value')
            <h3 class="{{$component}}__value">
              @sub('value')
            </h3>
            @endsub
          </li>
          @endfields

        </ul>

        <div class="{{$component}}__btn-wrapper">
          <a class="{{$component}}__btn" href="{{ home_url('/open-account')}}"
             ng-if="!prf.customer">
            {{_e('Open', 'sage')}} {{$title}}
          </a>
        </div>

      </div>


    </li>
    @endfields
  </ul>
</div>
