@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Join Research Project</h1>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('project-members.store') }}" method="POST">
                @csrf
                <input type="hidden" name="academician_id" value="{{ Auth::user()->academician->academician_id }}">

                <div class="mb-6">
                    <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">Select Project</label>
                    <select name="project_id" id="project_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Select a project...</option>
                        @foreach($availableProjects as $project)
                        <option value="{{ $project->project_id }}">
                            {{ $project->title }} (Led by {{ $project->leader->academician_name }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="member_role" class="block text-sm font-medium text-gray-700 mb-2">Your Role in Project</label>
                    <input type="text" name="member_role" id="member_role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="e.g., Researcher, Domain Expert, Technical Lead">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('project-members.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Join Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection