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
                            <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" required autocomplete="off">

                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">新密碼</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required autocomplete="off">

                                @error('new-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">確認新密碼</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    重設密碼
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="rule" class="col-md-4 col-form-label text-md-right">密碼設定原則</label>
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
