@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Graveyard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('panel.graveyards.update', $graveyard->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-4">Graveyard Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="graveyard_name" class="form-control" value="{{ $graveyard->graveyard_name }}">
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-4">Block Numbers: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="block_numbers" value="{{ $graveyard->block_numbers }}" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                        
                            <hr>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection