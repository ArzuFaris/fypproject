<?php

namespace App\Http\Controllers;

use App\Models\GrantProject;
use App\Models\Academician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectMember;

class GrantProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GrantProject::query();

        $this->authorize('viewAny', GrantProject::class);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('project_id', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%")
                ->orWhere('grant_provider', 'like', "%{$search}%")
                ->orWhere('grant_amount', 'like', "%{$search}%");
        });
        }
        
        $grantprojects = $query->get();
        return view('grant-projects.index', compact('grantprojects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', GrantProject::class);
        
        $academicians = Academician::all();
        return view('grant-projects.create', compact('academicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', GrantProject::class);
        
        $validated = $request->validate([
            'academician_id' => 'required',
            'project_id' => 'required|string|unique:grant_projects',
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric|min:0',
            'grant_provider' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $project = GrantProject::create($validated);
        //$project->members()->attach($request->members);

        return redirect()->route('grant-projects.index')
            ->with('success', 'Grant project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GrantProject $grantProject)
    {
        $this->authorize('view', $grantProject);
        
        //$grantProject->load('projectLeader', 'members', 'milestones');
        return view('grant-projects.show', compact('grantProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrantProject $grantProject)
    {
        $this->authorize('update', $grantProject);
        
        $academicians = Academician::all();
        return view('grant-projects.edit', compact('grantProject', 'academicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrantProject $grantProject)
    {
        $this->authorize('update', $grantProject);
        
        $validated = $request->validate([
            'academician_id' => 'required',
            'project_id' => 'required|string|unique:grant_projects',
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric|min:0',
            'grant_provider' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $grantProject->update($validated);
        //$project->members()->sync($request->members);

        return redirect()->route('grant-projects.index')
            ->with('success', 'Grant project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrantProject $grantProject)
    {
        $this->authorize('delete', $grantProject);
        
        $grantProject->delete();
        return redirect()->route('grant-projects.index')
            ->with('success', 'Grant project deleted successfully');
    }

    /* Add method for project leaders to view their projects
    public function myProjects()
    {
        $this->authorize('viewOwn', GrantProject::class);
        
        $projects = GrantProject::where('academician_id', auth()->user()->academician->academician_id)
                              ->get();
        return view('grant-projects.my-projects', compact('projects'));
    }*/

    public function joinProject(GrantProject $project)
{
    $user = Auth::user();
    
    if (!$user->academician) {
        return back()->with('error', 'Academician profile not found.');
    }

    // Check if already a member
    if ($project->members->contains('academician_id', $user->academician->academician_id)) {
        return back()->with('error', 'You are already a member of this project.');
    }

    // Add as member
    ProjectMember::create([
        'project_id' => $project->project_id,
        'academician_id' => $user->academician->academician_id,
        'role' => 'member'
    ]);

    return back()->with('success', 'Successfully joined the project.');
}
}
