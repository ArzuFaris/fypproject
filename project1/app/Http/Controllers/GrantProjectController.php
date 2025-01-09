<?php

namespace App\Http\Controllers;

use App\Models\GrantProject;
use Illuminate\Http\Request;

class GrantProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$grantprojects = Project::with(['leader', 'members'])->paginate(10);
        $grantProjects = GrantProject::paginate(10);
        return view('grantprojects.index', compact('grantproject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$academicians = Academician::all();
        return view('grantprojects.create', compact('academician'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            //'academician_id' => 'required',
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric|min:0',
            'grant_provider' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $project = GrantProject::create($validated);
        //$project->members()->attach($request->members);

        return redirect()->route('grantprojects.index')
            ->with('success', 'Grant project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GrantProject $grantProject)
    {
        return view('grantprojects.show', compact('academician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrantProject $grantProject)
    {
        //$academicians = Academician::all();
        return view('grantprojects.edit', compact('grantproject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrantProject $grantProject)
    {
        $validated = $request->validate([
            //'academician_id' => 'required',
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric|min:0',
            'grant_provider' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        $grantProject->update($validated);
        //$project->members()->sync($request->members);

        return redirect()->route('grantprojects.index')
            ->with('success', 'Grant project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrantProject $grantProject)
    {
        $grantProject->delete();
        return redirect()->route('grantprojects.index')
            ->with('success', 'Grant project deleted successfully');
    }
}
