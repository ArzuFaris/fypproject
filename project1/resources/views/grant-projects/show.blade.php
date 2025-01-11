@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <h2>Research Grant Project Details</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Project Title:</strong></div>
                <div class="col-md-9">{{ $grantProject->title }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Project Leader:</strong></div>
                <div class="col-md-9">{{ $grantProject->projectLeader->academician_name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Grant Amount:</strong></div>
                <div class="col-md-9">RM {{ number_format($grantProject->grant_amount, 2) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Grant Provider:</strong></div>
                <div class="col-md-9">{{ $grantProject->grant_provider }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Start Date:</strong></div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($grantProject->start_date)->format('d/m/Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Duration:</strong></div>
                <div class="col-md-9">{{ $grantProject->duration }} months</div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Project Members</h3>
        </div>
        <div class="card-body">
            @if($grantProject->members->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Staff Number</th>
                                <th>Position</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grantProject->members as $member)
                            <tr>
                                <td>{{ $member->academician->academician_name }}</td>
                                <td>{{ $member->academician->academician_number }}</td>
                                <td>{{ $member->academician->position }}</td>
                                <td>{{ $member->academician->department }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No project members added yet.</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Project Milestones</h3>
        </div>
        <div class="card-body">
            @if($grantProject->milestones->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Target Date</th>
                                <th>Deliverable</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grantProject->milestones as $milestone)
                            <tr>
                                <td>{{ $milestone->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($milestone->target_completion_date)->format('d/m/Y') }}</td>
                                <td>{{ $milestone->deliverable }}</td>
                                <td>{{ $milestone->status }}</td>
                                <td>{{ $milestone->last_updated ? \Carbon\Carbon::parse($milestone->last_updated)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No milestones added yet.</p>
            @endif
        </div>
    </div>

    <div class="d-grid gap-2">
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
            <a href="{{ route('grant-projects.edit', $grantProject) }}" class="btn btn-warning">Edit Project</a>
        @endif
        <a href="{{ route('grant-projects.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection