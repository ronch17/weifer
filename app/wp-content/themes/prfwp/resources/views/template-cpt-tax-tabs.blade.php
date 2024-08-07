

{{--
  Template Name: Tabs of CPT by Taxonomy Terms
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @
  @endwhileendphp
    @include('acf.flex-content')
@endsection
