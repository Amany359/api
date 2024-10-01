<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    // Fetch all teams
    public function index()
    {
        $teams = Team::with('parent', 'users', 'project')->get();
        return response()->json($teams);
    }

    // Store a new team
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:teams,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the team
        $team = Team::create($request->all());

        return response()->json($team, 201);
    }

    // Show a specific team
    public function show($id)
    {
        $team = Team::with('parent', 'users', 'project')->findOrFail($id);
        return response()->json($team);
    }

    // Update a specific team
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:teams,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $team = Team::findOrFail($id);
        $team->update($request->all());

        return response()->json($team);
    }

    // Delete a specific team
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully']);
    }
}
