@if(Auth::user()->type == "系會")
  <a class="dropdown-item" href="/events/create">新增活動</a>
  <a class="dropdown-item" href="/admin">活動管理</a>
  
@endif

@if(Auth::user()->type == "系辦")
  <a class="dropdown-item" href="/events/create">新增活動</a>
  <a class="dropdown-item" href="/admin">活動管理</a>
  <a class="dropdown-item" href="/admin/register">註冊管理員帳號</a>
@endif

@if(Auth::user()->type == "user")
  <a class="dropdown-item" href="/users/{{ Auth::user()->user_id }}/edit">個人資料管理</a>
  <a class="dropdown-item" href="/users/{{ Auth::user()->user_id }}">活動/收藏</a>
@endif

<a class="dropdown-item" href="/changePassword">更改密碼</a>