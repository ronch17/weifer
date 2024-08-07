@php($socials = get_sub_field('social_links'))

@acfmodule(ul)
@foreach( $socials as $social )
  @set($icon, $social['social_link'])
  @set($mailto, $icon == 'email' ? 'mailto:' : '')
  <li><a href="{{$mailto}}{{$social['url']}}" class="svg-{{$icon}}"
         target="_blank">@include('svg.acf.socials.'.$icon)</a></li>
@endforeach
@endacfmodule(ul)
