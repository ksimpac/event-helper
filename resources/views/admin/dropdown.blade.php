<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        <span class="caret">系辦</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        <a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
        <a class="dropdown-item" href="{{ route('admin.index') }}">活動管理</a>
        <a class="dropdown-item" href="{{ route('admin.carousel.index') }}">幻燈片管理</a>
        <a class="dropdown-item" href="{{ route('admin.register.index') }}">註冊帳號</a>
        <a class="dropdown-item" href="{{ route('admin.resetPassword.index') }}">重設密碼</a>

        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
