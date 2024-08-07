@set($size, get_sub_field('size') )
@set($sizeClass, $size ? " acfm-text-$size" : '' )
@set($color, get_sub_field('color') )
@set($colorClass, $color ? " acfm-text-color-$color" : '' )
@set($margin_bottom, get_sub_field('margin_bottom'))
@set($marginClass, $margin_bottom ? " acfm-margin-bottom--$margin_bottom" : '' )
@set($contain, get_sub_field('contain') ? " acfm-text-contain" : '' )

<div class="acfm-{{App::layout()}}{{$sizeClass}}{{$colorClass}}{{$marginClass}}{{$contain}}">
  @sub('text')
</div>
