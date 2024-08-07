@php
  $gallery = get_sub_field('gallery_field');

@endphp



@if($gallery)
  <div class="gallery">
    @foreach($gallery as $image)

      <img class="gallery-item" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">

    @endforeach

  </div>
@endif


