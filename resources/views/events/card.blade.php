@forelse ($events as $event)
      @if($loop->index % 3 == 0)
        <div class="row d-flex justify-content-center align-items-stretch py-3">
          <div class="col-sm-12">
            <div class="card-deck">
      @endif

      <div class="col-sm-4">
        <div class="card @if (Auth::guard('admin')->check() && $event->poster == '系會' && Request::route()->getName() != 'event.index') border-danger @endif">
          <img class="card-img-top" src="{{ asset('/storage/image/index').'/'.$event->imageName }}" alt="Card image cap">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->slogan }}</p>
            <p class="card-text">
              <i class="far fa-clock fa-1x"></i>{{ $event->dateStart }}<br />
              至<br />
              <i class="far fa-clock fa-1x"></i>{{ $event->dateEnd }}<br />
            </p>
            <p class="card-text">
                <i class="far fa-calendar-times fa-2x"></i>{{ $event->enrollDeadline }}
            </p>
          </div>

          <div class="card-footer d-flex">
            @if((Auth::guard('admin')->check() || Auth::guard('manager')->check()) && Request::route()->getName() != 'event.index')
                <a href="{{ route('event.show', ['event' => $event->event_id]) }}" class="btn btn-primary mr-auto p-2">查看</a>
                <a href="{{ route('event.edit', ['event' => $event->event_id]) }}" class="btn btn-warning mr-auto p-2">修改</a>
                <a href="{{ route('event.export', ['event' => $event->event_id]) }}" class="btn btn-info mr-auto p-2">名單</a>
                <form action="{{ route('event.destroy', ['event' => $event->event_id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mr-auto p-2" onclick="return confirm('您確定要刪除此活動?\n此動作將無法還原');">刪除</button>
                </form>
            @endif

            @if (Auth::guard('web')->check() || Request::route()->getName() == 'event.index')
                <a href="{{ route('event.show', ['event' => $event->event_id]) }}" class="btn btn-primary mr-auto p-2">查看詳情</a>
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

	<script>
        var events = <?php echo $events; ?>;
        var doms = Object.values(document.getElementsByClassName("card-body text-center"));

        $.each(doms, function(index, value){
            var node = document.createElement("div");

            events[index].maximum != 0 ? node.setAttribute("class", "d-flex justify-content-end") : node.setAttribute("class", "invisible");
            var percent = events[index].maximum == 0 ? 0 : Number(events[index].count / events[index].maximum).toFixed(2);

            $(node).circleProgress({
                value: percent,
                size: 25,
                fill: {
                    gradient: ["red", "orange"]
                },
                startAngle: 1.5 * Math.PI
            });

            value.appendChild(node);
        });
	</script>
