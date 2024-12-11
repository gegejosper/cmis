@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div class="d-print-none">
                <h1 class="fw-bold">Deceased Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('panel.deceaseds.index') }}" class="text-decoration-none">Deceased List</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
            <div>
                <a href="{{ route('panel.deceaseds.index') }}" class="btn btn-primary d-print-none">
                    <i class="fas fa-arrow-left"></i> Back to Deceased List
                </a>
                <button class="btn btn-secondary d-print-none" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>

        <!-- Deceased Details Section -->
        <div class="card mb-4 shadow-lg border-0 rounded">
            <div class="card-body">
                <h2 class="h4 mb-4 text-primary font-weight-bold">Deceased Details</h2>
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>First Name:</strong></p>
                        <p class="text-muted">{{ $deceased->first_name }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Middle Name:</strong></p>
                        <p class="text-muted">{{ $deceased->middle_name }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Last Name:</strong></p>
                        <p class="text-muted">{{ $deceased->last_name }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Date of Birth:</strong></p>
                        <p class="text-muted">{{ $deceased->date_of_birth }}</p>
                    </div>
                </div>
                <div class="row">
                    <!-- Second Column -->
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Date of Death:</strong></p>
                        <p class="text-muted">{{ $deceased->dod }}</p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Date of Burial:</strong></p>
                        <p class="text-muted">{{ $deceased->dob }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Graveyard:</strong></p>
                        <p class="text-muted">{{ $deceased->graveyard_details->graveyard_name }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-2"><strong>Block:</strong></p>
                        <p class="text-muted">{{ $deceased->block_details->block_name }}</p>
                    </div>
                </div>
                
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