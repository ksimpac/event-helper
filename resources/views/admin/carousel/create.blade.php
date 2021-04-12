@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">幻燈片管理</div>

                <div class="card-body">
                    <form action="{{ route('admin.carousel.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('admin.carousel.form')
                        <button class="btn btn-primary" type="submit">新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
