<form action="{{ route('project-members.store') }}" method="POST">
    @csrf
    <input type="hidden" name="academician_id" value="{{ Auth::user()->academician->academician_id }}">
    
    <div class="form-group">
        <label for="project_id">Select Project</label>
        <select name="project_id" id="project_id" class="form-control" required>
            @foreach($availableProjects as $project)
                <option value="{{ $project->project_id }}">{{ $project->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="role">Role in Project</label>
        <input type="text" name="role" id="role" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Join Project</button>
</form>