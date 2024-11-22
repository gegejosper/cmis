@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center text-primary">Graveyards</h1>
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Graveyard List Card -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fa fa-list"></i> Graveyard List</h5>
                            <a href="/panel/graveyards/create" class="btn btn-light btn-sm">
                                <i class="fa fa-plus"></i> Add Graveyard
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Search Results -->
                            @if (isset($keyword))
                                <div class="alert alert-info">
                                    <em><i class="fa fa-search"></i> Search Result for: <strong class="text-danger">{{ $keyword }}</strong></em>
                                </div>
                            @endif

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Graveyard</th>
                                            <th>Block Numbers</th>
                                            <th>Available Blocks</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($graveyards as $graveyard)
                                            <tr>
                                                <td>{{ $graveyard->graveyard_name }}</td>
                                                <td>{{ $graveyard->block_numbers }}</td>
                                                <td>{{ $graveyard->block_details->where('status', 'available')->count() }}</td>
                                                <td>
                                                    <span class="badge {{ $graveyard->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($graveyard->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-success btn-sm" href="{{ route('panel.graveyards.show', $graveyard->id) }}" title="View Details">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('panel.graveyards.edit', $graveyard->id) }}" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <!-- Uncomment if delete is needed -->
                                                    <!--
                                                    <form action="{{ route('panel.graveyards.destroy', $graveyard->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                    -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- No Graveyards Found -->
                            @if ($graveyards->isEmpty())
                                <div class="text-center mt-3">
                                    <p class="text-muted"><i class="fa fa-info-circle"></i> No graveyards found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection