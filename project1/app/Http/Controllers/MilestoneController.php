<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\GrantProject;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milestones = Milestone::latest()->orderby('target_completion_date')->paginate(10);
        return view('milestones.index', compact('project', 'milestones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('milestones.create', compact('grantproject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'milestone_id' => 'required|string|unique:milestones',
            'name' => 'required|string|max:255',
            'target_completion_date' => 'required|string|max:255',
            'deliverable' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'remark' => 'nullable|string'
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
        return view('milestones.show', compact('milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milestone $milestone)
    {
        return view('milestones.edit', compact('milestone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'milestone_id' => 'required|string|unique:milestones',
            'name' => 'required|string|max:255',
            'target_completion_date' => 'required|string|max:255',
            'deliverable' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'remark' => 'nullable|string'
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
        $milestone->delete();
        return redirect()->route('milestones.index')
            ->with('success', 'Milestone deleted successfully');
    }
}
