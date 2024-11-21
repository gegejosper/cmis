@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Deceased</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('panel.deceaseds.update', $deceased->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-10">
                                <div class="col-lg-3">
                                    <label>First Name </label>
                                    <input type="text" name="first_name" value="{{ $deceased->first_name }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                <label>Last Name </label>
                                <input type="text" name="last_name" value="{{ $deceased->last_name }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                <label>Date of Funeral</label>
                                    <input type="date" name="dob" value="{{ $deceased->dob }}" class="form-control">
                                </div>
                                
                            </div>
                            
                            <button type="submit" class="btn btn-info mt-5">Update</button>
                        </form>
                    </div>
            </div>
        </div>
    </main>
@endsection