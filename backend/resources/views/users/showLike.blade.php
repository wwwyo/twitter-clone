@extends('layouts.app')

@section('content')
    <p class="font-weight-bold border-bottom mb-3" style="font-size: 2rem;">
      ユーザー詳細
    </p>

    <div class="card border-0" style="width: 100%;">
      <div class="card-body pb-0">
        @include('layouts.userShow', ['user' => $user])
        <div class="d-flex justify-content-between">
          <a href="{{ route('user.show', $user) }}" class="user__show-card--link user__show--like-link text-reset" style="width: 49%; text-decoration: none;">
            投稿
          </a>
          <div class="user__show-card--link user__show--post-link" style="width: 49%;">
            いいね
          </div>
        </div>
      </div>
    </div>
    @foreach($user->likes as $like)
        @include('layouts.card', ['post' => $like->post])
    @endforeach
@endsection