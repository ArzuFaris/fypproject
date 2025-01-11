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