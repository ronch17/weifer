@extends('svg.symbols-wrapper')

@section('symbols')
  @foreach($symbols as $symbol)
    @include('svg.symbols.' . $symbol)
  @endforeach

  @if(is_page_template('views/template-widget.blade.php'))
    @include('svg.my-account')
  @endif

    @include('svg.footer-icons')
@endsection
