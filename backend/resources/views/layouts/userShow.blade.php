<div class="d-flex">
    <h2 class="card-title">{{ $user->name }}</h5>
    @if (Auth::id() === $user->id)
        <a id="logout" class="card__edit-link" href="{{ route('logout') }}">
            ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @else 
        @if (Auth::user()->findFollowingUser($user))
            <form method="POST" action="{{ route('following.destroy', $user) }}" class="card__edit-link">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" value="フォロー中" class="btn btn-sm btn-primary">
            </form>
        @else 
            <form method="POST" action=" {{ route('following.store', $user) }} " class=" card__edit-link">
                {{ csrf_field() }}
                <input type="submit" value="フォローする" class="btn btn-sm btn-secondary">
            </form>
        @endif
    @endif
</div>
<h5><a href="{{route('following.index', $user) }}" style="text-decoration: none; color: black;">{{ $user->followings->count() }}follow</a></h5>