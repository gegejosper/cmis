@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Graveyard</h1>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Update Graveyard Details</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>There were some errors with your submission:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('panel.graveyards.update', $graveyard->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Graveyard Name -->
                                <div class="mb-3">
                                    <label for="graveyard_name" class="form-label">Graveyard Name</label>
                                    <input 
                                        type="text" 
                                        name="graveyard_name" 
                                        id="graveyard_name" 
                                        class="form-control" 
                                        value="{{ $graveyard->graveyard_name }}" 
                                        placeholder="Enter graveyard name">
                                </div>

                                <!-- Block Numbers -->
                                <div class="mb-3">
                                    <label for="block_numbers" class="form-label">Block Numbers</label>
                                    <input 
                                        type="text" 
                                        name="block_numbers" 
                                        id="block_numbers" 
                                        class="form-control" 
                                        value="{{ $graveyard->block_numbers }}" 
                                        placeholder="Enter block numbers">
                                </div>

                                <!-- Graveyard Image -->
                                <div class="mb-3">
                                    <label for="graveyard_image" class="form-label">Graveyard Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        name="graveyard_image" 
                                        id="graveyard_image" 
                                        accept="image/*">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection