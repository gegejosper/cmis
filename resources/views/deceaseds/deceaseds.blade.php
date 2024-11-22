@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="fw-bold">Deceased Records</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">List of Deceased</li>
                </ol>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search and Actions Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="/panel/deceaseds/search" method="post" class="row g-3">
                    @csrf
                    <div class="col-md-10">
                        <input type="text" name="search_query" class="form-control" placeholder="Search Deceased" required>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa fa-search me-1"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Deceased Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Deceased List</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date of Funeral</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deceaseds as $deceased)
                            <tr>
                                <td>{{ $deceased->id }}</td>
                                <td>{{ $deceased->last_name }}, {{ $deceased->first_name }} {{ $deceased->middle_name }}</td>
                                <td>{{ $deceased->dob }}</td>
                                <td>{{ $deceased->graveyard_details->graveyard_name }}, Block {{ $deceased->block_details->block_name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm add-visitor" href="javascript:;" 
                                       data-deceased_id="{{ $deceased->id }}" 
                                       data-first_name="{{ $deceased->first_name }}" 
                                       data-last_name="{{ $deceased->last_name }}" 
                                       data-bs-toggle="modal" data-bs-target="#add-visitor-modal">
                                       <i class="fa fa-plus"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('panel.deceaseds.show', $deceased->id) }}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('panel.deceaseds.edit', $deceased->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
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

<!-- Add Visitor Modal -->
<div id="add-visitor-modal" class="modal fade" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVisitorModalLabel">Add Visitor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    Deceased Name: <strong><span id="deceased-name"></span></strong>
                </div>
                <form id="add_visitor" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"  class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="time_in" value="{{ old('time_in', date('H:i')) }}" class="form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="deceased_id" id="deceased_id">
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/deceaseds.js')}}"></script>
@endsection