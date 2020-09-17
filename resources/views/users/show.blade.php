@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>我的活動</h1>
    @forelse ($participants as $participant)
        @if($loop->index % 3 == 0)
          <div class="row">
            <div class="col-sm-12">
              <div class="card-deck">
        @endif

        <div class="col-sm-4">
          <div class="card">
            <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$participant->imageName }}" alt="Card image cap">
            <div class="card-body text-center">
              <h5 class="card-title">{{ $participant->title }}</h5>
              <p class="card-text">{{ $participant->title }}</p>
              <p class="card-text">
                <i class="far fa-clock fa-1x"></i>{{ $participant->dateStart }}<br />
                至<br />
                <i class="far fa-clock fa-1x"></i>{{ $participant->dateEnd }}<br />
              </p>
            </div>
            <div class="card-footer d-flex">
              <a href="/events/{{ $participant->event_id }}" class="btn btn-primary mr-auto p-2">查看詳情</a>
            </div>
          </div>
        </div>

        @if($loop->index % 3 == 2 || ($loop->last && $loop->index % 3 != 2))
              </div>
            </div>
          </div>
        @endif
    @empty
        <h3>目前尚無參與活動</h3>
    @endforelse

    <h1 class="mt-3">我的收藏</h1>
    @forelse ($collections as $collection)
        @if($loop->index % 3 == 0)
          <div class="row">
            <div class="col-sm-12">
              <div class="card-deck">
        @endif

        <div class="col-sm-4">
          <div class="card">
            <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$collection->imageName }}" alt="Card image cap">
            <div class="card-body text-center">
              <h5 class="card-title">{{ $collection->title }}</h5>
              <p class="card-text">{{ $collection->title }}</p>
              <p class="card-text">
                <i class="far fa-clock fa-1x"></i>{{ $collection->dateStart }}<br />
                至<br />
                <i class="far fa-clock fa-1x"></i>{{ $collection->dateEnd }}<br />
              </p>
            </div>
            <div class="card-footer d-flex">
              <a href="/events/{{ $collection->event_id }}" class="btn btn-primary mr-auto p-2">查看詳情</a>
            </div>
          </div>
        </div>

        @if($loop->index % 3 == 2 || ($loop->last && $loop->index % 3 != 2))
              </div>
            </div>
          </div>
        @endif
    @empty
        <h3>目前尚無收藏活動</h3>
    @endforelse
  </div>
@endsection
