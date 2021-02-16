@extends('layouts.app')

@section('content')
  <p class="font-weight-bold border-bottom" style="font-size: 2rem;">
    新規投稿
  </p>
  <form method="POST" action="{{ route('post.store') }}">
    {{ csrf_field() }}
    
    @include('layouts.errors')
    <div class="form-group">
      <textarea class="p-3 h5 w-100" name="text" id="text" rows="10" placeholder="投稿内容を記載してください">{{ old('text') }}</textarea>
    </div>
    <input type="submit" class="btn btn-primary" style="width: 20%;"/>
  </form>
@endsection