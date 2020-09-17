@extends('layouts.app')

@section('content')
    <div class="container py-0">
        <div class="row justify-content-center">
            <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1 " href="../">最新活動</a>
            <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../系辦">系辦活動</a>
            <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../系會">系會活動</a>
            <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill mr-1" href="../校內">校內活動</a>
            <a class="btn {{ Agent::isMobile() ? 'btn-sm' : 'btn-lg' }} bg-dm-blue text-white fontsize_15px rounded-pill" href="../校外">校外活動</a>
        </div>
    </div>

    @include('events.carousel')

    <div class="container">
    <div class="row justify-content-center">
        <h1>{{ $param }}活動</h1>
    </div>
    @include('events.card')
    </div>
@endsection
