@extends('layouts.layout')

@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="fw-bold">Burial List</h1>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="card mb-4  d-print-none">
            <div class="card-body">
                <form method="GET" action="{{ route('panel.filter_reports') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="month" class="form-label">Month</label>
                            <select name="month" id="month" class="form-control">
                                <option value="">All Months</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request()->month == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="year" class="form-label">Year</label>
                            <select name="year" id="year" class="form-control">
                                <option value="">All Years</option>
                                @foreach(range(date('Y'), 1900) as $year)
                                    <option value="{{ $year }}" {{ request()->year == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary" style="margin-top:8px;"><i class="fa-solid fa-folder"></i> Filter</button>
                            <button class="btn btn-secondary d-print-none" style="margin-top:8px;" onclick="window.print()">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Deceased Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Burial List</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date of Funeral</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deceaseds as $deceased)
                            <tr>
                                <td>{{ $deceased->id }}</td>
                                <td>{{ $deceased->last_name }}, {{ $deceased->first_name }} {{ $deceased->middle_name }}</td>
                                <td>{{ $deceased->dob }}</td>
                                <td>{{ $deceased->graveyard_details->graveyard_name }}, Block {{ $deceased->block_details->block_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($deceaseds->isEmpty())
                    <div class="text-center mt-3">
                        <p class="text-muted">No deceased records available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection