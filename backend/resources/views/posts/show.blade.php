@extends('layouts.app')

@section('content')

    <p class="font-weight-bold border-bottom mb-3" style="font-size: 2rem;">
        投稿詳細
    </p>

    @include('layouts.card', ['post' => $post])

    <div class="comment__container">
        {{-- n+1 --}}
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
    
    @include('layouts.errors')

    <form method="POST" action="{{ route('comment.store', $post) }}" class="input-group">
        {{ csrf_field() }}
        <textarea class="form-control" name="text" placeholder="コメントしてください">{{ old('text') }}</textarea>
        <div class="input-group-append">
            <input class="btn btn-outline-secondary" type="submit">
        </div>
    </form>
@endsection