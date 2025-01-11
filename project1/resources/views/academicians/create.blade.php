@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Add New Academician</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('academicians.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Staff ID</label>
                    <input type="text" name="academician_id" class="form-control @error('academician_id') is-invalid @enderror" value="{{ old('academician_id') }}" required>
                    @error('academician_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="academician_name" class="form-control @error('academician_name') is-invalid @enderror" value="{{ old('academician_name') }}" required>
                    @error('academician_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Staff Number</label>
                    <input type="text" name="academician_number" class="form-control @error('academician_number') is-invalid @enderror" value="{{ old('academician_number') }}" required>
                    @error('academician_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">College</label>
                    <input type="text" name="college" class="form-control @error('college') is-invalid @enderror" value="{{ old('college') }}" required>
                    @error('college')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}" required>
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <select name="position" class="form-control @error('position') is-invalid @enderror" required>
                        <option value="">Select Position</option>
                        <option value="Professor" {{ old('position') == 'Professor' ? 'selected' : '' }}>Professor</option>
                        <option value="Assoc Prof" {{ old('position') == 'Assoc Prof' ? 'selected' : '' }}>Associate Professor</option>
                        <option value="Senior Lecturer" {{ old('position') == 'Senior Lecturer' ? 'selected' : '' }}>Senior Lecturer</option>
                        <option value="Lecturer" {{ old('position') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                    </select>
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Create Academician</button>
                    <a href="{{ route('academicians.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection