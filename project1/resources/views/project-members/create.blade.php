@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add Project Member</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('project-members.store') }}" method="POST">
                        @csrf

                        <!-- Project Selection -->
                        <div class="mb-3">
                            <label class="form-label">Project</label>
                            <select name="project_id" class="form-control @error('project_id') is-invalid @enderror" required>
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->project_id }}">
                                        {{ $project->project_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Academician Selection -->
                        <div class="mb-3">
                            <label class="form-label">Academician</label>
                            <select name="academician_id" class="form-control @error('academician_id') is-invalid @enderror" required>
                                <option value="">Select Academician</option>
                                @foreach($academicians as $academician)
                                    <option value="{{ $academician->academician_id }}">
                                        {{ $academician->academician_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('academician_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                <option value="">Select Role</option>
                                <option value="Project Leader">Project Leader</option>
                                <option value="Project Member">Project Member</option>
                                <option value="Research Assistant">Research Assistant</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Member</button>
                            <a href="{{ route('project-members.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection