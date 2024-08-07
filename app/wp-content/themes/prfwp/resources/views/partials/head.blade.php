@php
  global $post;

  if ( !is_404() ){
    $slug = $post->post_name;
    $post_data = get_post($post->post_parent);
    $parent_slug = $post_data->post_name;
  }

  $meta_description = get_field('meta_description', 'option') ? get_field('meta_description', 'option') : '';
@endphp

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no shrink-to-fit=no, target-densitydpi=device-dpi">
  @if($meta_description)
    <meta name="description" content="{{ $meta_description }}"/>
  @endif
  @if(is_page_template('views/template-cpt-tax-tabs.blade.php') || is_page('glossary'))
    <base href="/{{$slug}}/#">
  @endif
  @php wp_head() @endphp
  {!! get_field('before_head_close', 'option') !!}
</head>
