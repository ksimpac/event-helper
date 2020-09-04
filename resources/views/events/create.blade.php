@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">建立活動</div>

                <div class="card-body">
                    <form action="/events" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('events.form')
                        <button class="btn btn-primary" type="submit">送出</button>
                    </form>
                    @include('events.plugin')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
