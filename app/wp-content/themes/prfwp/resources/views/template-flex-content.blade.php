{{--
  Template Name: Flex Content using ACF
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('acf.flex-content')
  @endwhile
@endsection
