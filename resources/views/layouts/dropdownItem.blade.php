@if(Auth::user()->type == "系會")
<a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
<a class="dropdown-item" href="{{ route('admin.index') }}">活動管理</a>
<a class="dropdown-item" href="{{ route('auth.index') }}">更改密碼</a>
@endif

@if(Auth::user()->type == "系辦")
<a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
<a class="dropdown-item" href="{{ route('admin.index') }}">活動管理</a>
<a class="dropdown-item" href="{{ route('admin.register') }}">註冊帳號</a>
<a class="dropdown-item" href="{{ route('admin.forgotPassword.index') }}">忘記帳號</a>
<a class="dropdown-item" href="{{ route('admin.resetPassword.index') }}">重設密碼</a>
@endif
{{ Debugbar::info(Auth::user()->STD_ID) }}
@if(Auth::user()->type == "user")
<a class="dropdown-item" href="{{ route('user.show', ['STU_ID' => Auth::user()->STU_ID]) }}">活動/收藏</a>
<a class="dropdown-item" href="{{ route('auth.index') }}">更改密碼</a>
@endif
