@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Milestones</h2>
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
            <a href="{{ route('milestones.create') }}" class="btn btn-primary">Add New Milestone</a>
        @endif
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('milestones.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search milestones..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Reset</a>
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
                            <th>ID</th>
                            <th>Project ID</th>
                            <th>Name</th>
                            <th>Target Completion Date</th>
                            <th>Deliverable</th>
                            <th>Status</th>
                            <th>Remark</th>
                            <th>Last updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($milestones as $milestone)
                        <tr>
                            <td>{{ $milestone->milestone_id }}</td>
                            <td>{{ $milestone->project_id }}</td>
                            <td>{{ $milestone->name }}</td>
                            <td>{{ $milestone->target_completion_date }}</td>
                            <td>{{ $milestone->deliverable }}</td>
                            <td>{{ $milestone->status }}</td>
                            <td>{{ $milestone->remark }}</td>
                            <td>{{ $milestone->last_updated }}</td>
                            <td>
                                <div class="btn-group">
                                    <!-- View button - accessible by all -->
                                    <a href="{{ route('milestones.show', $milestone) }}" 
                                       class="btn btn-info btn-sm">View</a>

                                    <!-- Edit button - accessible by admin, staff, and academician -->
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                                        <a href="{{ route('milestones.edit', $milestone) }}" 
                                           class="btn btn-warning btn-sm">Edit</a>
                                    @endif

                                    <!-- Delete button - only for admin and staff -->
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                                        <form action="{{ route('milestones.destroy', $milestone) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
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