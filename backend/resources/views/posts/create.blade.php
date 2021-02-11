@extends('layouts.app')

@section('content')
  <p class="font-weight-bold border-bottom" style="font-size: 2rem;">
    新規投稿
  </p>
  <form method="POST" action="{{ route('post.store') }}">
    {{ csrf_field() }}
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
      <textarea name="text" id="text" cols="100" rows="10" placeholder="投稿内容を記載してください"></textarea>
    </div>
    <input type="submit" class="btn btn-primary"/>
  </form>
@endsection