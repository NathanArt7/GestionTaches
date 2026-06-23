<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'user_id' => 'required|exists:users,id'
        ]);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function show(string $id)
    {
        return Project::with('tasks')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $project->update($request->all());

        return response()->json($project);
    }

    public function destroy(string $id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        if ($project->tasks()->count() > 0) {
            return response()->json([
                'message' => 'Impossible de supprimer ce projet car il contient des tâches.'
            ], 400);
        }

        $project->delete();

        return response()->json([
            'message' => 'Projet supprimé.'
        ]);
    }
}