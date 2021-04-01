@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">重設密碼</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.resetPassword.update') }}">
                        @csrf
                        @method('PATCH')

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
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    required autocomplete="off">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">新密碼</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password"
                                    class="form-control @error('new-password') is-invalid @enderror" name="new-password"
                                    required autocomplete="off">

                                @error('new-password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm"
                                class="col-md-4 col-form-label text-md-right">確認新密碼</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control"
                                    name="new-password-confirm" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    重設密碼
                                </button>
                                @if(Session::has('successMsg'))
                                <span class="alert alert-success"> {{ Session::get('successMsg') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rule" class="col-md-4 col-form-label text-md-right">密碼設定原則</label>
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
