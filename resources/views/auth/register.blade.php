@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="std_id" class="col-md-4 col-form-label text-md-right">學號</label>
                            
                            <div class="col-md-6">
                                <input id="std_id" type="text" class="form-control @error('std_id') is-invalid @enderror" name="std_id" value="{{ old('std_id') }}" required autocomplete="std_id" autofocus>
                                
                                @error('std_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="std_id" class="text-danger">※註冊後將無法修改</label>
                            </div>    
                        </div>
                        
                        <div class="form-group row">
                            <label for="realname" class="col-md-4 col-form-label text-md-right">{{ __('Realname') }}</label>

                            <div class="col-md-6">
                                <input id="realname" type="text" class="form-control @error('realname') is-invalid @enderror" name="realname" value="{{ old('realname') }}" required autocomplete="realname">

                                @error('realname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="realname" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="identify" class="col-md-4 col-form-label text-md-right">{{ __('Identify') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="identify" name="identify">
                                    <option>流管一1</option>
                                    <option>流管二1</option>
                                    <option>流管三1</option>
                                    <option>流管四1</option>
                                    <option>流管三A</option>
                                    <option>流管四A</option>
                                    <option>流管所研一</option>
                                    <option>流管所研二</option>
                                    <option>本系老師</option>
                                    <option>本校老師</option>
                                    <option>外校老師</option>
                                </select>
                                <label for="identify" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>
												
                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                    <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" placeholder="格式：0987654321">

                                    @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" placeholder="請輸入10~30個字元">

                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="account" class="text-danger">※註冊後將無法修改</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
