<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    //
    public function index()
    {
        Gate::authorize('admin');
        $comments = Comment::latest()->paginate(10);

        return view('admin.comments.index', ['comments' => $comments]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments')->with('success', 'Comment deleted successfully.');
    }
}
