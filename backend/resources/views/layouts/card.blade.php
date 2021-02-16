<div class="card border-right-0 border-left-0 border-top-0" style="width: 100%;">
    <div class="card-body">
        <div class="d-flex">
            <a href="{{route('user.show', $post->user->id)}}" class="card-title m-0" style="text-decoration: none; font-size: 2rem; color: black;">
                {{ $post->user->name }}
            </a>
            @if ($post->isPostOwner(Auth::user()))
                <a href="{{ route('post.edit', $post)}}" class="card__edit-link">
                    <i class="fas fa-edit"></i>
                </a>
            @endif
        </div>
        <a href="{{ route('post.show', $post) }}" class="card-text d-block"  style="color: black; text-decoration: none">
            {!! nl2br(e($post->text)) !!}
        </a>
        <div>
            <a href="{{ route('post.show', $post) }}" class="card__icon" style="color: black; text-decoration: none">
                <i class="far fa-comment">  {{ $post->comments->count() }}</i>
            </a>
            @if ($post->findLikeId(Auth::user()))
                <a href="{{ route('like.destroy', $post->findLikeId(Auth::user()))}}" id={{ $post->id }} class="card__icon like-icon" style="color: #ff1493;">
                    <i class="far fa-heart">  {{ $post->likes->count() }}</i>
                </a>
                <form id="like-{{ $post->id }}" method="POST" action="{{ route('like.destroy', $post->findLikeId(Auth::user())) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            @else
                <a href="{{ route('like.store', $post) }}" id={{ $post->id }}  class="card__icon like-icon text-reset">
                    <i class="far fa-heart">  {{ $post->likes->count() }}</i>
                </a>
                <form id="like-{{ $post->id }}" method="POST" action="{{ route('like.store', $post) }}">
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
    </div>
</div>