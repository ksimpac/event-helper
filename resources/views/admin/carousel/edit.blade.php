@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">幻燈片管理</div>

                <div class="card-body">
                    <form action="{{ route('admin.carousel.update', ['id' => $carousel->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @include('admin.carousel.form')
                        <button class="btn btn-warning" type="submit">修改</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
