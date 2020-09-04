@extends('layouts.app')

@section('content')
<div class="container">
  @forelse ($events as $event)
      @if($loop->index % 3 == 0)
        <div class="row">
          <div class="col-sm-12">
            <div class="card-deck">
      @endif

      <div class="col-sm-4 d-flex align-items-stretch">
        <div class="card">
          <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$event->imageName }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->title }}</p>
            <p class="card-text">{{ substr($event->dateStart, 0, 16)." ~ ".substr($event->dateEnd, 0, 16) }}</p>
            @if(isset($event->count)) 
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ strval(round($event->count / $event->maximum * 100, 0)) }}%;" aria-valuenow="{{ strval(round($event->count / $event->maximum * 100 , 0)) }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            @endif
          </div>
          <div class="card-footer d-flex">
            <a href="/events/{{ $event->event_id }}" class="btn btn-primary mr-auto p-2">查看</a>
            <a href="/events/{{ $event->event_id }}/edit" class="btn btn-warning mr-auto p-2">修改</a>
            <a href="/events/{{ $event->event_id }}/export" class="btn btn-info mr-auto p-2">名單</a>
            <form action="/events/{{ $event->event_id }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger mr-auto p-2" onclick="return confirm('您確定要刪除此活動?\n此動作將無法還原');">刪除</button>
            </form>

          </div>
        </div>
      </div>

      @if($loop->index % 3 == 2 || ($loop->last && $loop->index % 3 != 2))
            </div>
          </div>
        </div>
      @endif
  @empty
      <h1>目前尚無新增任何活動</h1>
  @endforelse
</div>
@endsection