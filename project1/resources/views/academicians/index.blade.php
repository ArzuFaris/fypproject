@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Academicians</h1>
        <a href="{{ route('academicians.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Academician
        </a>
    </div>

    {{-- Debug information --}}
    @if($academicians->isEmpty())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
            No academicians found in the database.
        </div>
    @else
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            Found {{ $academicians->count() }} academicians.
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Staff Number</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">College</th>
                    <th class="border px-4 py-2">Department</th>
                    <th class="border px-4 py-2">Position</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($academicians as $academician)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $academician->academician_name }}</td>
                        <td class="border px-4 py-2">{{ $academician->academician_number }}</td>
                        <td class="border px-4 py-2">{{ $academician->email }}</td>
                        <td class="border px-4 py-2">{{ $academician->college }}</td>
                        <td class="border px-4 py-2">{{ $academician->department }}</td>
                        <td class="border px-4 py-2">{{ $academician->position }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('academicians.show', $academician) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    View
                                </a>
                                <a href="{{ route('academicians.edit', $academician) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('academicians.destroy', $academician) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm"
                                            onclick="return confirm('Are you sure you want to delete this academician?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center text-gray-500">
                            No academicians found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-4 py-3 border-t">
            {{ $academicians->links() }}
        </div>
    </div>
</div>
@endsection