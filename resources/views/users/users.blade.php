@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                <div>
                    <h1 class="fw-bold">Users List</h1>
                    
                </div>
                <a href="{{ route('panel.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-2"></i> New User
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Users Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Users List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_details->role->name}}</td>
                                    <!-- <td>
                                        <a class="btn btn-warning btn-sm" href="{{ route('panel.deceaseds.edit', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($users->isEmpty())
                        <div class="text-center mt-3">
                            <p class="text-muted">No users records available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection