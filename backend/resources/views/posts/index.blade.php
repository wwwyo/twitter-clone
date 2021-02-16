
@extends('layouts.app')

@section('content')
    @foreach($posts as $post)
      @include('layouts.card', ['post' => $post])
    @endforeach
@endsection

