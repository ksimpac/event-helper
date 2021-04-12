@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">幻燈片管理</div>

                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">圖片</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carousels as $carousel)
                            <tr>
                                <th scope="row" class="align-middle">{{ ++$loop->index }}</th>
                                <td class="w-50">
                                    <img src="{{ asset(Storage::url($carousel->path)) }}"
                                        class="img-fluid img-thumbnail">
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.carousel.edit', ['id' => $carousel->id]) }}"
                                        class="btn btn-warning">修改</a>
                                    <form action="{{ route('admin.carousel.destroy', ['id' => $carousel->id]) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('您確定要刪除此圖片?\n此動作將無法還原');">刪除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">新增圖片</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
