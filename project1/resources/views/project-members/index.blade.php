@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Project Members</h2>
        <a href="{{ route('project-members.create') }}" class="btn btn-primary">Add New Member</a>
    </div>

    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('project-members.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search members..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('project-members.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Members Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Project</th>
                            <th>Academician</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projectmembers as $member)
                        <tr>
                            <td>{{ $member->project_member_id }}</td>
                            <td>{{ $member->grantProject->project_title }}</td>
                            <td>{{ $member->academician->academician_name }}</td>
                            <td>{{ $member->role }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('project-members.show', $member) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('project-members.edit', $member) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('project-members.destroy', $member) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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

