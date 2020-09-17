@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">個人資料管理</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', ['user' => $user->user_id]) }}">
                        @csrf
                        @method('patch')

                        <div class="form-group row">
                            <label for="static_std_id" class="col-md-4 col-form-label text-md-right">學號</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control-plaintext" id="static_std_id" value="{{ $user->std_id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticRealname" class="col-md-4 col-form-label text-md-right">{{ __('Realname') }}</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control-plaintext" id="staticRealname" value="{{ $user->realname }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticIdentify" class="col-md-4 col-form-label text-md-right">{{ __('Identify') }}</label>

                            <div class="col-md-6">
                              <input type="text" readonly class="form-control-plaintext" id="staticIdentify" value="{{ $user->identify }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $user->telephone }}" required autocomplete="telephone" placeholder="格式：0987654321">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    修改
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
