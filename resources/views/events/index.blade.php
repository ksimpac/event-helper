@extends('layouts.app')

@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    <h1>{{ $param }}活動</h1>
  </div>
  @include('events.card')
</div>
@endsection