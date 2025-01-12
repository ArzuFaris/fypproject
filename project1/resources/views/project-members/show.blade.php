@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ $project->title }}</h1>
                <p class="text-gray-600">Led by {{ $project->leader->academician_name }}</p>
            </div>
            <div class="bg-blue-50 rounded-lg px-4 py-2">
                <span class="text-sm font-medium text-blue-800">Grant Amount: RM {{ number_format($project->grant_amount, 2) }}</span>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Project Details</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Grant Provider</p>
                    <p class="font-medium">{{ $project->grant_provider }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Start Date</p>
                    <p class="font-medium">{{ $project->start_date }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Duration</p>
                    <p class="font-medium">{{ $project->duration }} months</p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Project Members</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($project->members as $member)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->academician->academician_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->member_role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->academician->department }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->academician->position }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>