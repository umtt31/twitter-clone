<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(CreateCommentRequest $request, Idea $idea)
    {
        $validated = $request->validated();

        $validated->idea_id = $idea->id;
        $validated->user_id = auth()->user()->id;
        Comment::created($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully!');
    }
}
