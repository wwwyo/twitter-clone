<?php

namespace App\Http\Controllers;

use App\Following;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $login_user = Auth::user();
        return view('followings.index', ['user' => $user, 'login_user' => $login_user]);
    }

    public function store(User $user, Request $request)
    {
        $login_user_id = Auth::id();

        $following = new Following();
        $following->user_id = $login_user_id;
        $following->following_user_id = $user->id;
        $following->save();
        return redirect()->back();
    }

    public function destroy(Following $following)
    {
        $following->delete();
        return redirect()->back();
    }
}