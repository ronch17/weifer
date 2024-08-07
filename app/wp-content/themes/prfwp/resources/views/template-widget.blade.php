{{--
  Template Name: Widget Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @include('proftit-widgets.widget-content')
  @endwhile
@endsection
