<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @auth
        <div class="header__icon-group ml-5">
            <a class="header__icon" href="{{ route('post.index') }}">
                <i class="fas fa-home fa-2x"></i>
            </a>
            <a class="header__icon" href="{{ route('user.show', Auth::id()) }}">
                <i class="fas fa-user fa-2x"></i>
            </a>
            <a class="header__icon" href="{{ route('post.create') }}">
                <i class="fas fa-plus-circle fa-2x"></i>
            </a>
        </div>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
            </li>
        @endif
    @endauth
</nav>