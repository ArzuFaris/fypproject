@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Academician Details</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3"><strong>Name:</strong></div>
                <div class="col-md-9">{{ $academician->academician_name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Staff Number:</strong></div>
                <div class="col-md-9">{{ $academician->academician_number }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Email:</strong></div>
                <div class="col-md-9">{{ $academician->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>College:</strong></div>
                <div class="col-md-9">{{ $academician->college }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Department:</strong></div>
                <div class="col-md-9">{{ $academician->department }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Position:</strong></div>
                <div class="col-md-9">{{ $academician->position }}</div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('academicians.edit', $academician) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('academicians.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection