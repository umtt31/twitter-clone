<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success', 'Followed successfully!');
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success', 'unFollowed successfully!');
    }
}
