<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    // Get all tasks with pagination and filtering
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:pending,completed',
            'due_date' => 'nullable|date|after:today',
            'search' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $query = Task::query();

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by due_date if provided
        if ($request->has('due_date')) {
            $query->where('due_date', $request->input('due_date'));
        }

        // Search by title if provided
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        // Paginate results
        $tasks = $query->paginate(10);

        return response()->json($tasks);
    }

    // Get a specific task by ID
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $task = Task::findOrFail($id);
            return response()->json($task);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        }
    }

    // Create a new task
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:tasks,title',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed',
            'due_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:tasks,title,' . $id,
            'description' => 'nullable|string',
            'status' => 'in:pending,completed',
            'due_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $task = Task::findOrFail($id);
            $task->update($request->all());
            return response()->json($task);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        }
    }

    // Delete a task by ID
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(null, 204); // 204 No Content
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        }
    }
}
