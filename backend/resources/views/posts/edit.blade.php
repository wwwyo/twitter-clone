@extends('layouts.app')

@section('content')
  <p class="font-weight-bold border-bottom" style="font-size: 2rem;">
    投稿編集
  </p>
  <form method="POST" action="{{ route('post.update', $post) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $errror)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="form-group">
      <textarea name="text" id="text" cols="100" rows="10" placeholder="投稿内容を記載してください">{{ $post->text }}</textarea>
    </div>
    <input type="submit" class="btn btn-primary mb-3" style="width: 20%;" value="編集"/>
  </form>
  <form method="post" action="{{ route('post.destroy', $post) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" value="削除" class="btn btn-secondary" style="width: 20%;">
  </form>
@endsection