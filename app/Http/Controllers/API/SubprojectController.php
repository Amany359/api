<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subproject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubprojectController extends Controller
{
    // Display a listing of subprojects
    public function index()
    {
        $subprojects = Subproject::with('project')->get();
        return response()->json($subprojects, Response::HTTP_OK);
    }

    // Store a newly created subproject
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'required|exists:projects,id',
        ]);

        $subproject = Subproject::create($validatedData);
        return response()->json([
            'message' => 'Subproject created successfully!',
            'subproject' => $subproject
        ], Response::HTTP_CREATED);
    }

    // Display a specific subproject
    public function show($id)
    {
        $subproject = Subproject::with('project')->find($id);
        
        if (!$subproject) {
            return response()->json(['message' => 'Subproject not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($subproject, Response::HTTP_OK);
    }

    // Update the specified subproject
    public function update(Request $request, $id)
    {
        $subproject = Subproject::find($id);
        
        if (!$subproject) {
            return response()->json(['message' => 'Subproject not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'required|exists:projects,id',
        ]);

        $subproject->update($validatedData);

        return response()->json([
            'message' => 'Subproject updated successfully!',
            'subproject' => $subproject
        ], Response::HTTP_OK);
    }

    // Remove the specified subproject
    public function destroy($id)
    {
        $subproject = Subproject::find($id);
        
        if (!$subproject) {
            return response()->json(['message' => 'Subproject not found'], Response::HTTP_NOT_FOUND);
        }

        $subproject->delete();

        return response()->json(['message' => 'Subproject deleted successfully'], Response::HTTP_OK);
    }
}
