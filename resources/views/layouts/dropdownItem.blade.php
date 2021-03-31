@if(Auth::guard('manager')->check())
<a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
<a class="dropdown-item" href="{{ route('manager.index') }}">活動管理</a>
<a class="dropdown-item" href="{{ route('manager.resetPassword.index') }}">更改密碼</a>
@endif

@if(Auth::guard('admin')->check())
<a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
<a class="dropdown-item" href="{{ route('admin.index') }}">活動管理</a>
<a class="dropdown-item" href="{{ route('admin.register') }}">註冊帳號</a>
<a class="dropdown-item" href="{{ route('admin.resetPassword.index') }}">重設密碼</a>
@endif

@if(Auth::user()->type == "user")
<a class="dropdown-item" href="{{ route('user.show', ['STU_ID' => Auth::user()->STU_ID]) }}">活動/收藏</a>
@endif
