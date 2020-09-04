@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/register">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 text-md-right control-label">帳號類型</label>
                          
                            <div class="col-md-6">
                                <div class="@error('type') is-invalid @enderror">
                                    <div class="custom-control custom-radio custom-control-inline ml-3">
                                        <input type="radio" id="option1" name="type" class="custom-control-input" value="系辦">
                                        <label class="custom-control-label" for="option1">系辦</label>
                                    </div>
    
                                    <div class="custom-control custom-radio custom-control-inline ml-3">
                                        <input type="radio" id="option2" name="type" class="custom-control-input" value="系會">
                                        <label class="custom-control-label" for="option2">系會</label>
                                    </div>
                                </div>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="type" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="off" placeholder="請輸入10~30個字元">

                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="std_id" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="請輸入10~30個字元">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
                                    <li class="list-group-item border-0">3.長度為10~30字元</li>
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