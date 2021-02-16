@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($user->followings->count())
                @foreach ($user->followings as $following_user_id)
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="d-flex" style="width: 50%;">
                              <a href="{{ route('user.show', $following_user_id->following_user) }}" class="m-0 text-reset h3">{{ $following_user_id->following_user->name }}</p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1 d-inline">
                                @if (Auth::id() === $following_user_id->user_id)
                                    <form method="POST" action="{{ route('following.destroy', $following_user_id) }}">
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}
                                      <input type="submit" value="フォロー中" class="btn btn-primary">
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
                        <div class="d-flex w-50">
                          フォロー中のユーザーがいません
                        </div>
                    <div class="d-flex justify-content-end flex-grow-1 d-inline">
                </div>
            @endif
        </div>
    </div>
@endsection