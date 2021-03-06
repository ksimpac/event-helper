@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">更新活動</div>

                    <div class="card-body">
                        <form action="{{ route('event.update', ['event' => $event->event_id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('events.form')
                            <button class="btn btn-primary" type="submit">修改</button>
                            @method('PATCH')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/plugin.js') }}" defer></script>
@endsection
