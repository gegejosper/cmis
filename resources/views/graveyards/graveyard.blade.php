@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Graveyard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Details</li>
                
            </ol>
            <div class="row mt-5" >
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <h1>NAME: {{ $graveyard->graveyard_name }}</h1>
                            <p>Total Blocks: {{ $graveyard->block_numbers }} | Available: {{$number_of_block_available}}</p>
                            <img src="{{ asset($graveyard->graveyard_image) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-toolbar">
                                <a href="javascript:;" id="add_block" class="btn btn-info add_block" data-graveyard_id="{{$graveyard->id}}">
                                    Add Block
                                </a>
                                <a href="{{ route('panel.graveyards.index') }}" class="btn btn-warning">
                                        <i class="fa fa-reply"></i>
                                    </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                           
                            <table id="blocks_list" class="table datatable-table">
                                <thead>
                                <tr>
                                    <th>BLOCK NAME</th>
                                    <th>DECEASED</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($graveyard->block_details as $block)
                                        <tr>
                                            <td>{{$block->block_name}}</td>
                                            <td>
                                                @if($block->deceased_details != null )
                                                {{$block->deceased_details->last_name}}, {{$block->deceased_details->first_name}}
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>{{$block->status}}</td>
                                            
                                            <td>
                                                @if($block->deceased_details == null )
                                                    <a class="btn btn-info add_deceased" href="javascript:;" data-block_id="{{$block->id}}" data-graveyard_id="{{$graveyard->id}}"><i class="fa fa-plus"> </i></a>
                                                @endif   
                                                <a class="btn btn-warning" href="{{route ('panel.blocks.edit', $graveyard->id) }}"><i class="fa fa-pencil"> </i></a>
                                                <!-- <form action="{{ route('panel.graveyards.destroy', $graveyard->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"> </i></button>
                                                </form> -->
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
                                <label>First Name </label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                            </div>
                            <div class="col-lg-4">
                            <label>Last Name </label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
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