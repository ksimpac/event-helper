@extends('layouts.app')

@section('content')
<div class="container mb-auto">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"><span>{{ $event->title }}</span></div>

          <div class="card-body">
            <p class="card-text">活動標語：<span>{{ $event->slogan }}</span></p>
            <p class="card-text">活動時間：<span>{{ $event->dateStart }} 至 {{ $event->dateEnd }}</span></p>
            <p class="card-text">活動地點：<span>{{ $event->location }}</span></p>

            <p class="card-text">活動對象：
              @foreach($limits as $limit)
                <span>{{ $limit->identify }}@if(!$loop->last) 、 @endif</span>
              @endforeach
            </p>

            <p class="card-text">人數：
              <span>
                  {{ $parts }} /
                  <span>
                    @if( $event->maximum == 0)
                      無限制
                    @else
                      {{ $event->maximum }}
                    @endif
                  </span>
              </span>
            </p>

            <p class="card-text">報名截止時間：<span>{{ $event->enrollDeadline }}</span></p>

            <p class="card-text">標籤：
              @forelse($tags as $tag)
                <span>{{ $tag->name }}@if(!$loop->last) 、 @endif</span>
              @empty
                <span>無</span>
              @endforelse
            </p>
            <p class="card-text">詳細資訊：<span>@if($event->moreInfo == null) 無 @else {!! html_entity_decode($event->moreInfo) !!} @endif</span></p>
          </div>
        </div>
      </div>
    </div>

    <div class="row ml-1 mt-2">
      <form action="{{ route('user.signup', ['event' => $event->event_id, 'user' => Auth::id() == null ? -1 : Auth::id()]) }}" method="post">
        @csrf
        <button class="btn btn-primary mr-2" @if(now() > $event->enrollDeadline || Auth::check() && (Auth::user()->type == "系辦" || Auth::user()->type == "系會")) disabled @endif>
          @if(!$isSignUp)
            報名
          @else
            取消報名
          @endif
        </button>
      </form>
      <form action="{{ route('user.favorite', ['event' => $event->event_id, 'user' => Auth::id() == null ? -1 : Auth::id()]) }}" method="post">
        @csrf
        <button class="btn btn-primary" @if(Auth::check() && (Auth::user()->type == "系辦" || Auth::user()->type == "系會")) disabled @endif>
          @if(!$isAddInFavorite)
            收藏
          @else
            取消收藏
          @endif
        </button>
      </form>
      <a class="btn btn-primary ml-2" target="_blank"
        href="https://calendar.google.com/calendar/event?action=TEMPLATE&text={{ $event->title }}&dates={{ $event->dateStartStr }}/{{ $event->dateEndStr }}&location={{ $event->location }}&trp=false">新增至Google行事曆</a>
    </div>
    @if(Session::has('errorMsg'))
      <div class="row ml-1 mt-2">
          <span class="alert alert-danger"> {{ Session::get('errorMsg') }}</span>
      </div>
    @endif
</div>
@endsection
