<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\GrantProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Milestone::class);
        
        $query = Milestone::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('milestone_id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('deliverable', 'like', "%{$search}%")
                  ->orWhere('project_id', 'like', "%{$search}%");
            });
        }

        $milestones = $query->with('grantProject')->get();
        return view('milestones.index', compact('milestones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Milestone::class);
        
        $projects = GrantProject::all();
        return view('milestones.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'milestone_id' => 'required|string|unique:milestones',
            'name' => 'required|string|max:255',
            'target_completion_date' => 'required|string|max:255',
            'deliverable' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'remark' => 'nullable|string'
        ]);*/

        $this->authorize('create', Milestone::class);

        $validated = $request->validate([
            'milestone_id' => 'required|string|unique:milestones',
            'project_id' => 'required|exists:grant_projects,id',
            'name' => 'required',
            'target_completion_date' => 'required|date',
            'deliverable' => 'required',
            'status' => 'required',
            'remark' => 'nullable'
        ]);

        //$validated['project_id'] = $project->id;
        $validated['last_updated'] = now();

        Milestone::create($validated);

        return redirect()->route('milestones.index')
            ->with('success', 'Milestone created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Milestone $milestone)
    {
        $this->authorize('view', $milestone);

        return view('milestones.show', compact('milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milestone $milestone)
    {
        $this->authorize('update', $milestone);

        return view('milestones.edit', compact('milestone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Milestone $milestone)
    {
        /*$validated = $request->validate([
            'milestone_id' => 'required|string|unique:milestones',
            'name' => 'required|string|max:255',
            'target_completion_date' => 'required|string|max:255',
            'deliverable' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'remark' => 'nullable|string'
        ]);*/

        $this->authorize('update', $milestone);

        $validated = $request->validate([
            'project_id' => 'required|exists:grant_projects,id',
            'name' => 'required',
            'target_completion_date' => 'required|date',
            'deliverable' => 'required',
            'status' => 'required',
            'remark' => 'nullable'
        ]);

        $validated['last_updated'] = now();

        $milestone->update($validated);

        return redirect()->route('milestones.index')
            ->with('success', 'Milestone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milestone $milestone)
    {
        $this->authorize('delete', $milestone);
        
        $milestone->delete();
        return redirect()->route('milestones.index')
            ->with('success', 'Milestone deleted successfully');
    }
}
