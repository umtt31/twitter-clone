<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class IdeaLikeController extends Controller
{
    //
    public function like(Idea $idea)
    {
        $liker = auth()->user();
        $liker->likes()->attach($idea->id);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Liked successfully!');
    }
    public function unlike(Idea $idea)
    {
        $liker = auth()->user();
        $liker->likes()->detach($idea->id);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Liked successfully!');
    }
}
