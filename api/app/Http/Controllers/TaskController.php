<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project', 'comments')->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'priority' => 'required|in:baja,media,alta',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'project_id' => $request->project_id,
            'assigned_user_id' => $request->assigned_user_id,
        ]);

        return response()->json($task, 201);
    }
}
