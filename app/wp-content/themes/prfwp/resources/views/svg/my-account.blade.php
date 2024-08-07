@php
  $accountSymbols = ['personal', 'summary', 'transactions', 'upload', 'withdrawal', 'questionnaire', 'deposit'];
@endphp
@foreach($accountSymbols as $symbol)
  @include('svg.symbols.my-account.' . $symbol)
@endforeach
