@extends('layouts.app')

@section('content')
    <p class="font-weight-bold border-bottom" style="font-size: 2rem;">
        投稿編集
    </p>
    <form method="POST" action="{{ route('post.update', $post) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        @include('layouts.errors')
        <div class="form-group">
            <textarea class="p-3 h5 w-100" name="text" id="text" rows="10" placeholder="投稿内容を記載してください">{{ old('text',$post->text ) }}</textarea>
        </div>
        <input type="submit" class="btn btn-primary mb-3" style="width: 20%;" value="編集"/>
    </form>
    <form method="post" action="{{ route('post.destroy', $post) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="submit" value="削除" class="btn btn-secondary" style="width: 20%;">
    </form>
@endsection