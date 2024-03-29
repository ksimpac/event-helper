@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}帳號</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.register.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 text-md-right control-label">帳號類型</label>

                            <div class="col-md-6">

                                <div class="custom-control custom-radio custom-control-inline ml-3">
                                    <input type="radio" id="type1" name="type" class="custom-control-input" value="0"
                                        {{ old('type') == '0' ? 'checked="checked"': '' }}>
                                    <label class="custom-control-label" for="type1">系辦</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline ml-3">
                                    <input type="radio" id="type2" name="type" class="custom-control-input" value="1"
                                        {{ old('type') == '1' ? 'checked="checked"': '' }}>
                                    <label class="custom-control-label" for="type2">系會</label>
                                </div>

                                <label for="type" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="off" placeholder="請輸入8~30個字元">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="std_id" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="請輸入8~30個字元">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit">
                                    {{ __('Register') }}
                                </button>
                                @if(Session::has('successMsg'))
                                <span class="alert alert-success"> {{ Session::get('successMsg') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rule" class="col-md-4 col-form-label text-md-right">帳號密碼設定原則</label>
                            <div class="col-md-6">
                                <ul class="list-group" id="rule">
                                    <li class="list-group-item border-0">1.必須包含一個大寫字母</li>
                                    <li class="list-group-item border-0">2.必須包含一個小寫字母</li>
                                    <li class="list-group-item border-0">3.長度為8~30字元</li>
                                    <li class="list-group-item border-0">4.不可使用空白</li>
                                    <li class="list-group-item border-0">必須符合以上四個條件</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
