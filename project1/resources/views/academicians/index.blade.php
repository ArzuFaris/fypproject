@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Academicians</h2>
        <a href="{{ route('academicians.create') }}" class="btn btn-primary">Add New Academician</a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Staff Number</th>
                            <th>Email</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($academicians as $academician)
                        <tr>
                            <td>{{ $academician->academician_id }}</td>
                            <td>{{ $academician->academician_name }}</td>
                            <td>{{ $academician->academician_number }}</td>
                            <td>{{ $academician->email }}</td>
                            <td>{{ $academician->college }}</td>
                            <td>{{ $academician->department }}</td>
                            <td>{{ $academician->position }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('academicians.show', $academician) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('academicians.edit', $academician) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('academicians.destroy', $academician) }}" method="POST" class="d-inline">
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