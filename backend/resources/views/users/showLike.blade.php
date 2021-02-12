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
      <h5><a href="{{route('following.index', $user) }}" style="text-decoration: none; color: black;">{{ $user->followings->count() }}follow</a></h5>
      <div class="d-flex justify-content-between">
        <a href="{{ route('user.show', $user) }}" class="user__show-card--link user__show--like-link text-reset" style="width: 49%; text-decoration: none;">
          投稿
        </a>
        <div class="user__show-card--link user__show--post-link" style="width: 49%;">
          いいね
        </div>
      </div>
      @foreach($user->likes as $like)
        @php
          $post = $like->post
        @endphp 
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
              @if ($post->likes->where('user_id', Auth::id())->first())
                <a href="{{ route('like.destroy', $post->likes->where('user_id', Auth::id())->first()) }}" class="card__icon" style="color: #ff1493;"
                          onclick="event.preventDefault();
                                    document.getElementById('unlike-{{$post->id}}').submit();"
                >
                  <i class="far fa-heart">  {{ $post->likes->count() }}</i>
                </a>
                <form id="unlike-{{ $post->id }}" method="POST" action="{{ route('like.destroy', $post->likes->where('user_id', Auth::id())->first() ) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>
              @else
                <a href="{{ route('like.store', $post) }}" class="card__icon text-reset"
                            onclick="event.preventDefault();
                                    document.getElementById('like-{{$post->id}}').submit();"
                >
                  <i class="far fa-heart">  {{ $post->likes->count() }}</i>
                </a>
                <form id="like-{{ $post->id }}" method="POST" action="{{ route('like.store', $post) }}">
                  {{ csrf_field() }}
                </form>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection