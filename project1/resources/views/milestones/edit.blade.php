@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Milestone</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('milestones.update', $milestone->milestone_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input disabled type="text" name="milestone_id" class="form-control @error('milestone_id') is-invalid @enderror" value="{{ old('milestone_id', $milestone->milestone_id) }}" required>
                    @error('milestone_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Project ID</label>
                    <input disabled type="text" name="project_id" class="form-control @error('project_id') is-invalid @enderror" value="{{ old('project_id', $milestone->project_id) }}" required>
                    @error('project_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Milestone Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $milestone->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Target Completion Date</label>
                    <input type="text" name="target_completion_date" class="form-control @error('target_completion_date') is-invalid @enderror" value="{{ old('target_completion_date', $milestone->target_completion_date) }}" required>
                    @error('target_completion_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deliverable</label>
                    <input type="text" name="deliverable" class="form-control @error('deliverable') is-invalid @enderror" value="{{ old('deliverable', $milestone->deliverable) }}" required>
                    @error('deliverable')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="Not Started" {{ old('status', $milestone->status) === 'Not Started' ? 'selected' : '' }}>Not Started</option>
                        <option value="Pending" {{ old('status', $milestone->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status', $milestone->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Delayed" {{ old('status', $milestone->status) === 'Delayed' ? 'selected' : '' }}>Delayed</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Remark</label>
                    <input type="text" name="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark', $milestone->remark) }}" required>
                    @error('remark')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Updated</label>
                    <input type="text" name="last_updated" class="form-control @error('last_updated') is-invalid @enderror" value="{{ old('last_updated', $milestone->last_updated) }}" required>
                    @error('last_updated')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update Milestone</button>
                    <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection