
@extends('layouts.app')

@section('content')
@foreach($posts as $post)
    <div class="card border-right-0 border-left-0 border-top-0" style="width: 100%;">
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
            <a href="{{ route('post.show', $post) }}" class="card-text d-block"  style="color: black; text-decoration: none">
              {!! nl2br(e($post->text)) !!}
            </a>
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
@endforeach

@endsection

