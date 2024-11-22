@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Title -->
            <h1 class="mt-4 text-center text-primary">Block Details</h1>
            <div class="text-center mb-4">
                <a href="/panel/graveyards/{{ $block->graveyard_id }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Graveyard
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Update Block Details Card -->
                    <div class="card shadow-sm mb-5">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fa fa-edit"></i> Update Block Details</h5>
                        </div>
                        <div class="card-body">
                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong><i class="fa fa-exclamation-circle"></i> Errors:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Update Form -->
                            <form action="{{ route('panel.blocks.update', $block->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Block Name -->
                                <div class="mb-3">
                                    <label for="block_name" class="form-label">Block Name</label>
                                    <input 
                                        type="text" 
                                        name="block_name" 
                                        id="block_name" 
                                        class="form-control" 
                                        value="{{ $block->block_name }}" 
                                        placeholder="Enter block name" 
                                        required>
                                </div>

                                <!-- Block Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="{{ $block->status }}" selected>{{ ucfirst($block->status) }}</option>
                                        <option value="available">Available</option>
                                        <option value="not available">Not Available</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info px-4"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Deceased Details Card -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fa fa-users"></i> Deceased Details</h5>
                        </div>
                        <div class="card-body">
                            <!-- Deceased Table -->
                            @if ($block->deceased_details->isNotEmpty())
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($block->deceased_details as $deceased)
                                            <tr>
                                                <td>{{ $deceased->last_name }}, {{ $deceased->first_name }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('panel.deceaseds.destroy', $deceased->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center mt-3">
                                    <p class="text-muted"><i class="fa fa-info-circle"></i> No deceased records available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection