@forelse ($events as $event)
      @if($loop->index % 3 == 0)
        <div class="row d-flex justify-content-center align-items-stretch py-3">
          <div class="col-sm-12">
            <div class="card-deck">
      @endif

      <div class="col-sm-4">
        <div class="card">
          <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$event->imageName }}" alt="Card image cap">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->slogan }}</p>
            <p class="card-text">
              <i class="far fa-clock fa-1x"></i>{{ $event->dateStart }}<br />
              至<br />
              <i class="far fa-clock fa-1x"></i>{{ $event->dateEnd }}<br />
            </p>

            <div class="progress @if(!isset($event->count)) invisible @endif">
              <div class="progress-bar" role="progressbar" @if(isset($event->count)) style="width: {{ strval(round($event->count / $event->maximum * 100, 0)) }}%;" aria-valuenow="{{ strval(round($event->count / $event->maximum * 100 , 0)) }}" @endif aria-valuemin="0" aria-valuemax="100"></div>
            </div>

          </div>
          <div class="card-footer d-flex">
            @if(Request::is('admin'))
                <a href="/events/{{ $event->event_id }}" class="btn btn-primary mr-auto p-2">查看</a>
                <a href="/events/{{ $event->event_id }}/edit" class="btn btn-warning mr-auto p-2">修改</a>
                <a href="/events/{{ $event->event_id }}/export" class="btn btn-info mr-auto p-2">名單</a>
                <form action="/events/{{ $event->event_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mr-auto p-2" onclick="return confirm('您確定要刪除此活動?\n此動作將無法還原');">刪除</button>
                </form>
            @else
                <a href="./events/{{ $event->event_id }}" class="btn btn-primary mr-auto p-2">查看詳情</a>
                <span class="card-text p-2">{{ $event->status }}</span>
            @endif
          </div>
        </div>
      </div>

      @if($loop->index % 3 == 2 || ($loop->last && $loop->index % 3 != 2))
            </div>
          </div>
        </div>
      @endif
  @empty
      @if(Route::current()->uri == '/')
        <h1>目前尚無新活動</h1>
      @else
        <h1>目前尚無新增任何活動</h1>
      @endif
  @endforelse
