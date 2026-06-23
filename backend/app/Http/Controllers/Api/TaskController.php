<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::with('project')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priorite' => 'required',
        'statut' => 'required',
        'date_limite' => 'nullable|date',
        'project_id' => 'required|exists:projects,id'
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::with('project')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
        'message' => 'Tâche supprimée'
        ]);
    }
}
