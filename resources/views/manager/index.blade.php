@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <h1>活動管理</h1>
    </div>

    @include('events.card')
    </div>
@endsection
