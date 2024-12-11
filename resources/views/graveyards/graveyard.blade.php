@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Title -->
            <h1 class="mt-4 text-center text-primary">Graveyard Details</h1>
            <div class="row mt-5">
                <!-- Graveyard Info Section -->
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5">Graveyard: <strong>{{ $graveyard->graveyard_name }}</strong></h2>
                            <p><strong>Total Blocks:</strong> {{ $graveyard->block_numbers }} | <strong>Available:</strong> {{ $number_of_block_available }}</p>
                            <img src="{{ asset($graveyard->graveyard_image) }}" alt="Graveyard Image" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                </div>

                <!-- Block Details Section -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fa fa-cogs"></i> Block Details</h5>
                                <div class="btn-group">
                                    <a href="javascript:;" id="add_block" class="btn btn-light btn-sm add_block" data-graveyard_id="{{ $graveyard->id }}">
                                        <i class="fa fa-plus"></i> Add Block
                                    </a>
                                    <a href="{{ route('panel.graveyards.index') }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-reply"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Blocks Table -->
                            <div class="table-responsive">
                                <table id="blocks_list" class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Block Name</th>
                                            <th>Deceased</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($graveyard->block_details as $block)
                                            <tr>
                                                <td>{{ $block->block_name }}</td>
                                                <td>
                                                    @if($block->deceased_details && $block->deceased_details->isNotEmpty())
                                                        @foreach($block->deceased_details as $deceased)
                                                            <a href="{{ route('panel.deceaseds.show', $deceased->id) }}"><span>{{ $deceased->last_name }}, {{ $deceased->first_name }}</span> </a>
                                                            <br>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge {{ 
                                                            $block->status === 'available' ? 'bg-success' : 
                                                            ($block->status === 'reserved' ? 'bg-warning' : 'bg-secondary') 
                                                        }}">
                                                        {{ ucfirst($block->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-info btn-sm add_deceased" href="javascript:;" data-block_id="{{ $block->id }}" data-graveyard_id="{{ $graveyard->id }}" title="Add Deceased">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                    <a class="btn btn-warning btn-sm" href="/panel/blocks/{{ $block->id }}/edit" title="Edit Block">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('panel.blocks.destroy', $block->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                title="Delete" 
                                                                @if($block->status !== 'available') disabled @endif>
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="add-deceased-modal" class="modal modal-lg" style="margin-top:100px; max-height: 500px;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Add Deceased</h5>
                    <button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form id="add_deceased" method="POST">
                        @csrf
                        <div class="row mb-10">
                            <div class="col-lg-4">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-lg-4">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label>Date of Burial</label>
                                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control" required>
                            </div>
                            
                        </div>
                        <input type="hidden" name="block_id" id="block_id">
                        <input type="hidden" name="graveyard_id" id="graveyard_id">
                        <button type="submit" class="btn btn-info mt-5">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="add-block-modal" class="modal modal-lg" style="margin-top:100px; max-height: 500px;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Add Block</h5>
                    <button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form id="add_block" method="POST">
                        @csrf
                        <div class="row mb-10">
                            <div class="col-lg-12">
                                <label>Block Name </label>
                                <input type="text" name="block_name" class="form-control" required>
                            </div>
                            
                        </div>
                        <input type="hidden" name="graveyardblockid" id="graveyardblockid" value="{{ $graveyard->id }}">
                        <input type="hidden" name="status" id="status" value="available">
                        <button type="submit" class="btn btn-info mt-5">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
<script>
    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
</script>
<script src="{{asset('js/graveyard.js')}}"></script>
@endsection