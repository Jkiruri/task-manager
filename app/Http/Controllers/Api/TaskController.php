<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    

    /**
     * Store a newly created task in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:tasks|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task = Task::create($validated);

        return response()->json($task, Response::HTTP_CREATED);
    }

    
    
}
