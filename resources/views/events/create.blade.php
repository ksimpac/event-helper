@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">新增活動</div>

                    <div class="card-body">
                        <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('events.form')
                            <button class="btn btn-primary" type="submit">送出</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/plugin.js') }}" defer></script>
@endsection
