@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if ($user->followings->count())
          @foreach ($user->followings as $following_user_id)
            <div class="card">
              <div class="card-header p-3">
                <div class="d-flex" style="width: 30%;">
                  <a href="{{ route('user.show', $user) }}" class="mb-0 text-reset">{{ $following_user_id->following_user->name }}</p>
                </div>
                <div class="d-flex justify-content-end flex-grow-1 d-inline">
                  @if (Auth::id() === $following_user_id->user_id)
                    <form method="POST" action="{{ route('following.destroy', $following_user_id) }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <input type="submit" value="フォロー中です" class="btn btn-primary">
                    </form>
                  @else
                  <form method="POST" action=" {{ route('following.store', $following_user) }} ">
                    {{ csrf_field() }}
                    <input type="submit" value="フォローする" class="btn btn-secondary">
                  </form>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="card">
            <div class="card-header p-3">
              <div class="d-flex" style="width: 30%;">
                フォロー中のユーザーがいません
              </div>
            <div class="d-flex justify-content-end flex-grow-1 d-inline">
          </div>
        @endif
      </div>
    </div>
@endsection