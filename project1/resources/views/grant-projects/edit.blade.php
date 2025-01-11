@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Research Grant Project</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('grant-projects.update', $grantProject) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Project ID</label>
                    <input type="text" name="project_id" class="form-control @error('project_id') is-invalid @enderror" value="{{ old('project_id', $grantProject->project_id) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $grantProject->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Leader</label>
                    <select name="academician_id" class="form-control @error('academician_id') is-invalid @enderror" required>
                        @foreach($academicians as $academician)
                            <option value="{{ $academician->id }}" {{ old('academician_id', $grantProject->academician_id) == $academician->id ? 'selected' : '' }}>
                                {{ $academician->academician_name }} ({{ $academician->academician_number }})
                            </option>
                        @endforeach
                    </select>
                    @error('academician_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Grant Amount (RM)</label>
                    <input type="number" name="grant_amount" class="form-control @error('grant_amount') is-invalid @enderror" value="{{ old('grant_amount', $grantProject->grant_amount) }}" step="0.01" required>
                    @error('grant_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Grant Provider</label>
                    <input type="text" name="grant_provider" class="form-control @error('grant_provider') is-invalid @enderror" value="{{ old('grant_provider', $grantProject->grant_provider) }}" required>
                    @error('grant_provider')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="string" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $grantProject->start_date) }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Duration (months)</label>
                    <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $grantProject->duration) }}" required>
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update Project</button>
                    <a href="{{ route('grant-projects.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection