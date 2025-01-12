<?php

namespace App\Http\Controllers;

use App\Models\Academician;
use Illuminate\Http\Request;
use App\Models\User;
use function Ramsey\Uuid\v1;

class AcademicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$academicians = Academician::all();
        //$academicians = Academician::paginate(10);

        $this->authorize('viewAny', Academician::class);

        $query = Academician::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('academician_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('college', 'like', "%{$search}%");
            });
        }

        $academicians = $query->get();
        return view('academicians.index', compact('academicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Academician::class);

        $users = User::whereDoesntHave('academician')
            ->where('role', 'academician')
            ->get();

        return view('academicians.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Academician::class);
        
        $validated = $request->validate([
            'academician_id' => 'required|string|unique:academicians',
            'user_id' => 'required|exists:users,id|unique:academicians',
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
        $this->authorize('view', $academician);
        return view('academicians.show', compact('academician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academician $academician)
    {
        $this->authorize('update', $academician);
        return view('academicians.edit', compact('academician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academician $academician)
    {
        $this->authorize('update', $academician);
        
        $validated = $request->validate([
            'academician_id' => 'required|string|unique:academicians',
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
        $this->authorize('delete', $academician);
        
        $academician->delete();
        return redirect()->route('academicians.index')
            ->with('success', 'Academician deleted successfully');
    }
}
