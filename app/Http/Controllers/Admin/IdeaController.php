<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    //
    public function index()
    {
        Gate::authorize('admin');

        $ideas = Idea::latest()->paginate(10);
        return view('admin.ideas.index', compact('ideas'));
    }
}
