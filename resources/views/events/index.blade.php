@extends('layouts.app')

@section('content')
<div class="container">
  @include('events.carousel')
  
  <div class="row justify-content-center">
    <h1>{{ $param }}活動</h1>
  </div>
  @forelse ($events as $event)
      @if($loop->index % 3 == 0)
        <div class="row d-flex justify-content-center align-items-stretch">
          <div class="col-sm-12">
            <div class="card-deck">
      @endif

      <div class="col-sm-4">
        <div class="card">
          <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$event->imageName }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->title }}</p>
            <p class="card-text">{{ substr($event->dateStart, 0, 16)." ~ ".substr($event->dateEnd, 0, 16) }}</p>
            
            <div class="progress @if(!isset($event->count)) invisible @endif">
              <div class="progress-bar bg-success" role="progressbar" @if(isset($event->count)) style="width: {{ strval(round($event->count / $event->maximum * 100, 0)) }}%;" aria-valuenow="{{ strval(round($event->count / $event->maximum * 100 , 0)) }}" @endif aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
          </div>
          <div class="card-footer d-flex">
            <a href="./events/{{ $event->event_id }}" class="btn btn-primary mr-auto p-2">查看詳情</a>
            <span class="card-text p-2">{{ $event->status }}</span>
          </div>
        </div>
      </div>

      @if($loop->index % 3 == 2 || ($loop->last && $loop->index % 3 != 2))
            </div>
          </div>
        </div>
      @endif
  @empty
      <h1>目前尚無新活動</h1>
  @endforelse
</div>
@endsection