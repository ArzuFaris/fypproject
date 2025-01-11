<?php

namespace App\Http\Controllers;

use App\Models\ProjectMember;
use App\Models\Grant_Project;
use App\Models\Academician;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*$members = ProjectMember::with(['academician', 'project'])
            ->when($request->project_id, function ($query, $projectId) {
                return $query->where('project_id', $projectId);
            })
            ->get();

        return response()->json($members);*/

        $query = ProjectMember::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('project_member_id', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $projectmembers = $query->with(['grantProject', 'academician'])->get();
        return view('project-members.index', compact('projectmembers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:grant_projects,project_id',
            'academician_id' => 'required|exists:academicians,academician_id',
            'member_role' => 'required|string'
        ]);

        // Check if member already exists in project
        $existingMember = ProjectMember::where('project_id', $validated['project_id'])
            ->where('academician_id', $validated['academician_id'])
            ->first();

        if ($existingMember) {
            return response()->json([
                'message' => 'Academician is already a member of this project'
            ], 422);
        }

        // Create new project member
        $projectMember = ProjectMember::create($validated);

        return response()->json([
            'message' => 'Successfully joined project',
            'data' => $projectMember
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectMember $projectMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectMember $projectMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectMember $projectMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectMember $projectMember)
    {
        //
    }
}
