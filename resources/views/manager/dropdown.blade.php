<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        <span class="caret">系學會</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        <a class="dropdown-item" href="{{ route('event.create') }}">新增活動</a>
        <a class="dropdown-item" href="{{ route('manager.index') }}">活動管理</a>
        <a class="dropdown-item" href="{{ route('manager.resetPassword.index') }}">更改密碼</a>

        <a class="dropdown-item" href="{{ route('manager.logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
