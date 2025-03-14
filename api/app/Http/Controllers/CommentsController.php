<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Task $task)
{
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    $comment = $task->comments()->create([
        'comment' => $request->comment,
        'user_id' => auth()->id(),
    ]);

    return response()->json($comment, 201);
}

}
