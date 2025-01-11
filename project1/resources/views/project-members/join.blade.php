@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Join a Research Project</h4>
                </div>
                <div class="card-body">
                    <!-- Search Projects Form -->
                    <div class="mb-4">
                        <form action="{{ route('join.project') }}" method="GET" class="row g-3">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" 
                                    placeholder="Search projects by title or ID..." 
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('join.project') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>

                    <!-- Available Projects List -->
                    <div class="list-group">
                        @forelse($projects as $project)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $project->project_title }}</h5>
                                        <p class="mb-1">Project ID: {{ $project->project_id }}</p>
                                        <small>Project Leader: {{ $project->projectLeader->academician_name }}</small>
                                        <br>
                                        <small>Status: {{ $project->status }}</small>
                                    </div>
                                    
                                    @if($project->members->contains('academician_id', auth()->user()->academician->academician_id))
                                        <button class="btn btn-success" disabled>Already Joined</button>
                                    @else
                                        <form action="{{ route('join.project.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $project->project_id }}">
                                            <input type="hidden" name="academician_id" value="{{ auth()->user()->academician->academician_id }}">
                                            <button type="submit" class="btn btn-primary">Join Project</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-3">
                                <p>No projects available to join at this time.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection