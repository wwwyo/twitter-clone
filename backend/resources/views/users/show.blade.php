@extends('layouts.app')

@section('content')
    <p class="font-weight-bold border-bottom mb-3" style="font-size: 2rem;">
      ユーザー詳細
    </p>

    <div class="card border-0" style="width: 100%;">
        <div class="card-body pb-0">

            @include('layouts.userShow', ['user' => $user])

            <div class="d-flex justify-content-between">
                <div class="user__show-card--link user__show--post-link" style="width: 49%;">
                  投稿
                </div>
                <a href="{{ route('user.showLike', $user) }}" class="user__show-card--link user__show--like-link text-reset" style="width: 49%; text-decoration: none;">
                  いいね
                </a>
            </div>
        </div>
    </div>

    @foreach ($user->posts as $post)
        @include('layouts.card', ['post' => $post])
    @endforeach

@endsection