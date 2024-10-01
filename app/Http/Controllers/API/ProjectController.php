<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Get all projects
    public function index()
    {
        $projects = Project::with('subprojects', 'tasks', 'teams')->get();
        return response()->json($projects);
    }

    // Create a new project
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "parent_id" => "nullable|exists:projects,id",
        ]);

        // Initialize image variable
        $imagePath = null;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $firstFiveCharacters = substr($imageName, 0, 5);
            $name = 'img_1716557304_' . $firstFiveCharacters;
            $imagePath = $name . '.' . $image->extension();
            $image->move(public_path('topicImages'), $imagePath);
        }

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($project, 201);
    }

    // Get a single project by ID
    public function show($id)
    {
        $project = Project::with('subprojects', 'tasks', 'teams')->find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json($project);
    }

    // Update an existing project
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "parent_id" => "nullable|exists:projects,id",
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete('topicImages/' . $project->image); // Delete old image
            }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $firstFiveCharacters = substr($imageName, 0, 5);
            $name = 'img_1716557304_' . $firstFiveCharacters;
            $project->image = $name . '.' . $image->extension();
            $image->move(public_path('topicImages'), $project->image);
        }

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($project);
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        if ($project->image) {
            Storage::disk('public')->delete('topicImages/' . $project->image); // Delete associated image
        }

        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
