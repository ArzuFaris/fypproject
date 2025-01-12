@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Create New Research Grant Project</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('grant-projects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Project ID</label>
                    <input type="text" name="project_id" class="form-control @error('project_id') is-invalid @enderror" value="{{ old('project_id') }}" required>
                    @error('project_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Leader</label>
                    <select name="academician_id" class="form-control @error('academician_id') is-invalid @enderror" required>
                        <option value="">Select Project Leader</option>
                        @foreach($academicians as $academician)
                            <option value="{{ $academician->academician_id }}" {{ old('academician_id') == $academician->academician_id ? 'selected' : '' }}>
                                {{ $academician->academician_name }} - {{ $academician->department }} ({{ $academician->academician_number }})
                            </option>
                        @endforeach
                    </select>
                    @error('academician_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Grant Amount (RM)</label>
                    <input type="number" name="grant_amount" class="form-control @error('grant_amount') is-invalid @enderror" value="{{ old('grant_amount') }}" step="0.01" required>
                    @error('grant_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Grant Provider</label>
                    <input type="text" name="grant_provider" class="form-control @error('grant_provider') is-invalid @enderror" value="{{ old('grant_provider') }}" required>
                    @error('grant_provider')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="text" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Duration (months)</label>
                    <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" required>
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Create Project</button>
                    <a href="{{ route('grant-projects.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
