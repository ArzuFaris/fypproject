<?php

namespace App\Http\Controllers;

use App\Models\ProjectMember;
use App\Models\GrantProject;
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
        $projects = GrantProject::all();
        $academicians = Academician::all();
        return view('project-members.create', compact('projects', 'academicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:grant_projects,project_id',
            'academician_id' => 'required|exists:academicians,academician_id',
            'role' => 'required|string'
        ]);
    
        ProjectMember::create($validated);
    
        return redirect()->route('project-members.index')
            ->with('success', 'Project member added successfully');
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

    public function joinForm(Request $request)
{
    $query = GrantProject::query();

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('project_id', 'like', "%{$search}%")
              ->orWhere('project_title', 'like', "%{$search}%");
        });
    }

    $projects = $query->with(['projectLeader', 'members'])->get();
    return view('project-members.join', compact('projects'));
}

    public function joinProject(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:grant_projects,project_id',
            'academician_id' => 'required|exists:academicians,academician_id'
        ]);

        // Check if already a member
        $existingMember = ProjectMember::where([
            'project_id' => $validated['project_id'],
            'academician_id' => $validated['academician_id']
        ])->exists();

        if ($existingMember) {
            return back()->with('error', 'You are already a member of this project.');
        }

        // Create new project member with default role
        ProjectMember::create([
            'project_id' => $validated['project_id'],
            'academician_id' => $validated['academician_id'],
            'role' => 'Project Member'
        ]);

        return back()->with('success', 'Successfully joined the project!');
    }
}
