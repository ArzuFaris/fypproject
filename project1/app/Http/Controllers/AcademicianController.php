<?php

namespace App\Http\Controllers;

use App\Models\Academician;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AcademicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$academicians = Academician::all();
        $academician = Academician::paginate(10);
        return view('academicians.index', compact ('academicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academician.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academician_name' => 'required|string|max:255',
            'academician_number' => 'required|string|max:255',
            'email' => 'required|email|unique:academicians',
            'college' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255'
        ]);

        Academician::create($validated);

        return redirect()->route('academicians.index')
            ->with('success', 'Academician created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Academician $academician)
    {
        return view('academicians.show', compact('academician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academician $academician)
    {
        return view('academicians.edit', compact('academician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academician $academician)
    {
        $validated = $request->validate([
            'academician_name' => 'required|string|max:255',
            'academician_number' => 'required|string|max:255'. $academician->id,
            'email' => 'required|email|unique:academicians,email,' . $academician->id,
            'college' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255'
        ]);

        $academician->update($validated);

        return redirect()->route('academicians.index')
            ->with('success', 'Academician updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academician $academician)
    {
        $academician->delete();
        return redirect()->route('academicians.index')
            ->with('success', 'Academician deleted successfully');
    }
}
