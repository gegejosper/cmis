@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
           
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h5 mb-0">Recent Visitors</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Visitor's Name</th>
                                        <th>Deceased</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->fullname }}</td>
                                        <td>{{ $visitor->deceased_details->last_name }}</td>
                                        <td>{{ $visitor->address }}</td>
                                        <td>{{ $visitor->date_in }}</td>
                                        <td>{{ $visitor->time_in }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($visitors->isEmpty())
                            <div class="text-center mt-3">
                                <p class="text-muted">No visitor history available.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container"> 
            <div class="row my-5">
                <div class="col-lg-12">
                @foreach($graveyards as $graveyard)
                <div class="card" style="width: 18rem;">
                    <img src="{{asset($graveyard->graveyard_image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$graveyard->graveyard_name}}</h5>
                        <p class="card-text">Total Blocks: {{ $graveyard->block_numbers }} | Available: {{$graveyard->block_details->where('status', 'available')->count()}}</p>
                        <a href="/panel/graveyards/{{$graveyard->id}}" class="btn btn-primary">View</a>
                    </div>
                </div>
                @endforeach   
                </div>
            </div>
        </div> -->
    </main>

@endsection
@section('scripts')

@endsection