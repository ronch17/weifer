@php
  $footerSymbols = ['email', 'location', 'phone', 'arrow-right', 'send'];
@endphp
@foreach($footerSymbols as $symbol)
  @include('svg.symbols.footer.' . $symbol)
@endforeach
