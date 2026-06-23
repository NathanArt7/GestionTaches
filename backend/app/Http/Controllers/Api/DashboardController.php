<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;



class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_projects' => Project::count(),

            'total_tasks' => Task::count(),

            'completed_tasks' => Task::where(
                'statut',
                'Terminee'
            )->count(),

            'in_progress_tasks' => Task::where(
                'statut',
                'En_Cours'
            )->count()
        ]);
    }
}
