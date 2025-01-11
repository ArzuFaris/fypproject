@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Research Grant Projects</h2>
        <a href="{{ route('grant-projects.create') }}" class="btn btn-primary">Add New Project</a>
    </div>

    <!-- Add this after your header and before the table -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('grant-projects.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search projects..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('grant-projects.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Title</th>
                            <th>Project Leader</th>
                            <th>Grant Amount (RM)</th>
                            <th>Provider</th>
                            <th>Start Date</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grantprojects as $project)
                        <tr>
                            <td>{{ $project->project_id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->projectLeader->academician_name }}</td>
                            <td>{{ number_format($project->grant_amount, 2) }}</td>
                            <td>{{ $project->grant_provider }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                            <td>{{ $project->duration }} months</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('grant-projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('grant-projects.edit', $project->project_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('grant-projects.destroy', $project->project_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection