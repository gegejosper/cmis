@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Graveyards</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List of Graveyard</li>
                <li class="breadcrumb-item">
                    <a href="/panel/dashboard" class="btn btn-warning">
                        <i class="fa fa-reply"></i>
                    </a>
                    
                </li>
            </ol>
            <div class="row">
                <div class="col-lg-8">
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card p-4">
                        <div class="card-header">
                            <div class="card-toolbar">
                            <a href="/panel/graveyards/create" class="btn btn-info">
                        Add Graveyard
                    </a>
                            </div>
                        </div>
                    <table class="table datatable-table">
                        @if(isset($keyword))
                            <tr><td><em>Search Result for: <span class="text-danger">{{$keyword}}</span></em></td></tr>
                        @endif
                        <tr>
                            <td>GRAVEYARD</td>
                            <td>BLOCK NUMBERS</td>
                            <td>AVAILABLE</td>
                            <td>STATUS</td>
                            <td>ACTION</td>
                        </tr>
                        @foreach($graveyards as $graveyard)
                            <tr>
                                <td>{{$graveyard->graveyard_name}}</td>
                                <td>{{$graveyard->block_numbers}}</td>
                                <td>{{$graveyard->block_details->where('status', 'available')->count()}}</td>
                                <td>{{$graveyard->status}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route ('panel.graveyards.show', $graveyard->id) }}"><i class="fa fa-search"> </i></a>
                                    <a class="btn btn-warning" href="{{route ('panel.graveyards.edit', $graveyard->id) }}"><i class="fa fa-pencil"> </i></a>
                                    <!-- <form action="{{ route('panel.graveyards.destroy', $graveyard->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"> </i></button>
                                    </form> -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
                
                </div>
            </div>
        </div>
    </main>
@endsection