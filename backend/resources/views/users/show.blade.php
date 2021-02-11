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
          <a href="" class="card__edit-link">
            フォローする
          </a>
        @endif
      </div>
      <h5>3follow</h5>
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