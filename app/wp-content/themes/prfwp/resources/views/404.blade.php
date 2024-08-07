@extends('layouts.app')

@section('content')
  @include('partials.hero')
  <div class="container">
    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
      </div>
      {{--            {!! get_search_form(false) !!}--}}
      <a class="acfm-btn acfm-btn-primary" href="{{ home_url(App::homeURL()) }}"
         title="{{ get_bloginfo('name', 'display') }}">
        Back to Homepage
      </a>
    @endif
  </div>
@endsection
