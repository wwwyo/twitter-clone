@extends('layouts.app')

@section('content')
  <div class="card border-0" style="width: 100%;">
    <div class="card-body pb-0">
      <div class="d-flex">
        <h2 class="card-title">{{ $user->name }}</h5>
        @if (Auth::id() === $user->id)
          <a class="card__edit-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
              ログアウト
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        @else 
          @if (Auth::user()->followings()->where('following_user_id', $user->id)->first())
            <a href="{{ route('following.destroy', Auth::user()->followings()->where('following_user_id', $user->id)->first()) }}" class="btn btn-sm btn-outline-primary card__edit-link"
              onclick="event.preventDefault();
                        document.getElementById('unfollowing-form').submit();">
              フォロー中
            </a>
            <form id="unfollowing-form" method="POST" class="d-none" action=" {{ route('following.destroy', Auth::user()->followings()->where('following_user_id', $user->id)->first()) }} ">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>
          @else 
            <a href="{{ route('following.store', $user) }}" class="btn btn-sm btn-outline-secondary card__edit-link"
              onclick="event.preventDefault();
                        document.getElementById('following-form').submit();">
              フォローする
            </a>
            <form id="following-form" method="POST" action=" {{ route('following.store', $user) }} ">
              {{ csrf_field() }}
            </form>
          @endif
        @endif
      </div>
      <h5><a href="{{route('following.index', Auth::user())}}" style="text-decoration: none; color: black;">{{ $user->followings->count() }}follow</a></h5>
      <div class="d-flex justify-content-between">
        <div class="user__show-card--link user__show--post-link" style="width: 49%;">
          投稿
        </div>
        <div class="user__show-card--link user__show--like-link" style="width: 49%;">
          いいね
        </div>
      </div>
      @foreach ($user->posts as $post)
        <div class="card border-right-0 border-left-0 border-top-0" style="width: 100%;">
          <div class="card-body">
            <div class="d-flex">
              <h5 class="card-title">{{ $user->name}}</h5>
              @if (Auth::id() === $user->id)
                <a href="{{ route('post.edit', $post)}}" class="card__edit-link">
                  <i class="fas fa-edit"></i>
                </a>
              @endif
            </div>
            <a href="{{ route('post.show', $post) }}" class="card-text d-block"  style="color: black; text-decoration: none">
              {!! nl2br(e($post->text)) !!}
            </a>
            <div class="card__icon-menu">
              <a class="card__icon">
                <i class="far fa-comment">  {{ $post->comments->count() }}</i>
              </a>
              <a class="card__icon">
                <i class="far fa-heart"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection