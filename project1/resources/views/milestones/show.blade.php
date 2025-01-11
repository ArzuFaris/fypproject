@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Milestone Details</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>ID:</strong></div>
                <div class="col-md-9">{{ $milestone->milestone_id }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Project ID:</strong></div>
                <div class="col-md-9">{{ $milestone->project_id }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Name:</strong></div>
                <div class="col-md-9">{{ $milestone->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Target Completion Date:</strong></div>
                <div class="col-md-9">{{ $milestone->target_completion_date }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Deliverable:</strong></div>
                <div class="col-md-9">{{ $milestone->deliverable }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Status:</strong></div>
                <div class="col-md-9">{{ $milestone->status }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Remark:</strong></div>
                <div class="col-md-9">{{ $milestone->remark }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"><strong>Last Updated:</strong></div>
                <div class="col-md-9">{{ $milestone->last_updated }}</div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('milestones.edit', $milestone->milestone_id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('milestones.destroy', $milestone->milestone_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection

<!--@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Project Header --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h1>
                <p class="text-gray-600 mt-1">Project ID: {{ $project->project_id }}</p>
            </div>
            @if(Auth::user()->academician->academician_id === $project->academician_id)
            <div>
                <a href="{{ route('grant-projects.edit', $project->project_id) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Edit Project
                </a>
            </div>
            @endif
        </div>

        {{-- Project Details Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Grant Amount</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">RM {{ number_format($project->grant_amount, 2) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Grant Provider</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $project->grant_provider }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Project Duration</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $project->duration }} months</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Expected End Date</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">
                    {{ \Carbon\Carbon::parse($project->start_date)->addMonths($project->duration)->format('d M Y') }}
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Project Status</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">
                    @if(\Carbon\Carbon::parse($project->start_date)->addMonths($project->duration)->isPast())
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm">Completed</span>
                    @else
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Active</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Project Team --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Project Team</h2>
            @if(Auth::user()->academician->academician_id === $project->academician_id)
            <button onclick="window.location.href='{{ route(project-members.create, [project_id => $project->project_id]) }}'"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm">
                Add Member
            </button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        @if(Auth::user()->academician->academician_id === $project->academician_id)
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Project Leader --}}
                    <tr class="bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $project->leader->academician_name }}
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full ml-2">Leader</span>
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $project->leader->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Project Leader</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->leader->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->leader->position }}</td>
                        @if(Auth::user()->academician->academician_id === $project->academician_id)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <span class="text-gray-400">Cannot Remove Leader</span>
                        </td>
                        @endif
                    </tr>

                    {{-- Project Members --}}
                    @foreach($project->members as $member)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $member->academician->academician_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->academician->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $member->member_role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $member->academician->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $member->academician->position }}</td>
                        @if(Auth::user()->academician->academician_id === $project->academician_id)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('project-members.destroy', $member->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to remove this member?')">
                                    Remove
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Milestones --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Project Milestones</h2>
            @if(Auth::user()->academician->academician_id === $project->academician_id)
            <button onclick="window.location.href='{{ route(milestones.create, [project_id => $project->project_id]) }}'"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm">
                Add Milestone
            </button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deliverable</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                        @if(Auth::user()->academician->academician_id === $project->academician_id)
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($project->milestones as $milestone)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $milestone->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($milestone->target_completion_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $milestone->deliverable }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($milestone->status)
                                @case('Completed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $milestone->status }}
                                    </span>
                                    @break
                                @case('In Progress')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $milestone->status }}
                                    </span>
                                    @break
                                @default
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $milestone->status }}
                                    </span>
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $milestone->last_updated ? \Carbon\Carbon::parse($milestone->last_updated)->format('d M Y H:i') : 'Not updated' }}
                        </td>
                        @if(Auth::user()->academician->academician_id === $project->academician_id)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('milestones.edit', $milestone->milestone_id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                            <form action="{{ route('milestones.destroy', $milestone->milestone_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this milestone?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection-->