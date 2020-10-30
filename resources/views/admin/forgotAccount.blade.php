@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">忘記帳號</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.forgotPassword.getInfo') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="std_id" class="col-md-4 col-form-label text-md-right">學號</label>

                            <div class="col-md-6">
                                <input id="std_id" type="text" class="form-control @error('std_id') is-invalid @enderror" name="std_id" required autocomplete="off" value="{{ old('std_id') }}">

                                @error('std_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="realname" class="col-md-4 col-form-label text-md-right">真實姓名</label>

                            <div class="col-md-6">
                                <input id="realname" type="text" class="form-control @error('realname') is-invalid @enderror" name="realname" required autocomplete="off" value="{{ old('realname') }}">

                                @error('realname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" required autocomplete="off" value="{{ old('telephone') }}">
                            </div>

                            @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    查詢使用者
                                </button>
                                @if(Session::has('successMsg'))
                                    <div class="alert alert-success">
                                        <label>帳號:</label><span>{{ Session::get('account') }}</span><br />
                                        <label>信箱:</label><span>{{ Session::get('email') }}</span><br />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
