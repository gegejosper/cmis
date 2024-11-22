@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Graveyard</h1>
            <ol class="breadcrumb mb-4 justify-content-center">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card p-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Create Graveyard</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('panel.graveyards.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-3">Graveyard: </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="graveyard_name" value="{{ old('graveyard_name') }}" class="form-control" placeholder="Please enter graveyard name">
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-3">Block Numbers: </label>
                                    <div class="col-lg-9">
                                        <input type="number" name="block_numbers" value="{{ old('block_numbers') }}" class="form-control" placeholder="Please enter block number">
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-3 col-form-label">Graveyard Image:</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="graveyard_image" id="graveyard_image" accept="image/*">
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="active">
                                <hr>
                                <button type="submit" class="btn btn-info">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection