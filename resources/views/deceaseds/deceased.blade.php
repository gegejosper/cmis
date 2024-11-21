@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div>
                <h1 class="fw-bold">Deceased Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel.deceaseds.index') }}" class="text-decoration-none">Deceased List</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
            <a href="{{ route('panel.deceaseds.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Deceased List
            </a>
        </div>

        <!-- Deceased Details Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="h4 mb-3">Details</h2>
                <p><strong>First Name:</strong> {{ $deceased->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $deceased->last_name }}</p>
                <p><strong>Date of Burial:</strong> {{ $deceased->dob }}</p>
                <p><strong>Graveyard:</strong> {{ $deceased->graveyard_details->graveyard_name }}</p>
                <p><strong>Block:</strong> {{ $deceased->block_details->block_name }}</p>
            </div>
        </div>

        <!-- Visitors History Section -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Visitors History</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Visitor's Name</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->fullname }}</td>
                            <td>{{ $visitor->address }}</td>
                            <td>{{ $visitor->date_in }}</td>
                            <td>{{ $visitor->time_in }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($visitors->isEmpty())
                <div class="text-center mt-3">
                    <p class="text-muted">No visitor history available.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
    
@endsection