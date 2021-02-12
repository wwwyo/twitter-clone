@extends('layouts.app')

@section('content')

  <p class="font-weight-bold border-bottom mb-3" style="font-size: 2rem;">
    投稿詳細
  </p>

  <div class="card border-right-0 border-left-0 border-top-0 card__container" style="width: 100%;">
    <div class="card-body">
      <div class="d-flex">
        <a href="{{route('user.show', $post->user->id)}}" class="card-title m-0" style="text-decoration: none; font-size: 2rem; color: black;">
          {{ $post->user->name}}
        </a>
        @if (Auth::id() === $post->user->id)
          <a href="{{ route('post.edit', $post)}}" class="card__edit-link">
            <i class="fas fa-edit"></i>
          </a>
        @endif
      </div>
        
        <p class="card-text">{!! nl2br(e($post->text)) !!}</p>
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
  <div class="comment__container">
    @foreach ($post->comments as $comment)
    <div class="card border-0">
      <div class="card-body">
        <h5 class="card-title">
          {{ $comment->user->name }}
        </h5>
        <p class="card-text">
          {!! nl2br(e($comment->text)) !!}
        </p>
      </div>
    </div>
    @endforeach
  </div>
  
  <form method="POST" action="{{ route('comment.store', $post) }}" class="input-group">
    {{ csrf_field() }}
    <textarea class="form-control" name="text" placeholder="コメントしてください"></textarea>
    <div class="input-group-append">
      <input class="btn btn-outline-secondary" type="submit">
    </div>
  </form>
@endsection