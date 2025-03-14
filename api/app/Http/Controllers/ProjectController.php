<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Crear el proyecto
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($project, 201); // Proyecto creado
    }

    public function index()
    {
        $projects = Project::with('tasks.comments.user')->get();  

        return response()->json($projects);
    }
}
