<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        $tasks = Task::with(['project', 'user'])->get();
        return response()->json(['tasks' => $tasks], 200);
    }

    // Create a new task
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "status" => "required|string",
            "project_id" => "required|exists:projects,id",
            "assigned_to" => "required|exists:users,id"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = Task::create($request->all());
        return response()->json(['task' => $task], 201);
    }

    // Show a specific task
    public function show($id)
    {
        $task = Task::with(['project', 'user'])->find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['task' => $task], 200);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            "title" => "sometimes|string|max:255",
            "description" => "sometimes|string",
            "status" => "sometimes|string",
            "project_id" => "sometimes|exists:projects,id",
            "assigned_to" => "sometimes|exists:users,id"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task->update($request->all());
        return response()->json(['task' => $task], 200);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
