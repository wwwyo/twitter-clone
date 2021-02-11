@extends('layouts.app')

@section('content')

  <p class="font-weight-bold border-bottom mb-3" style="font-size: 2rem;">
    投稿詳細
  </p>

  <div class="card border-right-0 border-left-0 border-top-0" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">{{ $post->user->name }}</h5>
        <p class="card-text">{!! nl2br(e($post->text)) !!}</p>
        <div class="card__icon-menu">
            <a class="card__icon">
                <i class="far fa-comment"></i>
            </a>
            <a class="card__icon">
                <i class="far fa-heart"></i>
            </a>
        </div>
    </div>
  </div>
  <div class="card border-0">
    <div class="card-body">
      <h5 class="card-title">
        コメンテイター
      </h5>
      <p class="card-text">
        コメントコメントコメント
      </p>
    </div>
  </div>
  <div class="card border-0">
    <div class="card-body">
      <h5 class="card-title">
        コメンテイター
      </h5>
      <p class="card-text">
        コメントコメントコメント
      </p>
    </div>
  </div>
    
@endsection