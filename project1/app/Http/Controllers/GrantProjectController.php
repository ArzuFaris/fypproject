<?php

namespace App\Http\Controllers;

use App\Models\GrantProject;
use App\Models\Academician;
use Illuminate\Http\Request;

class GrantProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GrantProject::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('project_id', 'like', "%{$search}%")
                ->orWhere('project_title', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhere('budget', 'like', "%{$search}%");
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
        $academicians = Academician::all();
        return view('grant-projects.create', compact('academicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academician_id' => 'required',
            'project_id' => 'required|string|unique:grant_projects',
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric|min:0',
            'grant_provider' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $grantProject = GrantProject::create($validated);
        //$project->members()->attach($request->members);

        return redirect()->route('grant-projects.index')
            ->with('success', 'Grant project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GrantProject $grantProject)
    {
        //$grantProject->load('projectLeader', 'members', 'milestones');
        return view('grant-projects.show', compact('grantProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrantProject $grantProject)
    {
        $academicians = Academician::all();
        return view('grant-projects.edit', compact('grantProject', 'academicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrantProject $grantProject)
    {
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
        $grantProject->delete();
        return redirect()->route('grant-projects.index')
            ->with('success', 'Grant project deleted successfully');
    }
}
