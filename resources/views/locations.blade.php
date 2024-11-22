@extends('layouts.front')
@section('content_front')
    <section>
        <div class="container"> 
            <div class="row my-5">
                
                @foreach($graveyards as $graveyard)
                <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset($graveyard->graveyard_image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$graveyard->graveyard_name}}</h5>
                        <p class="card-text">Total Blocks: {{ $graveyard->block_numbers }} | Available: {{$graveyard->block_details->where('status', 'available')->count()}}</p>
                        <a href="/gardens/view/{{$graveyard->id}}" class="btn btn-primary">View</a>
                    </div>
                </div></div>
                @endforeach   
                
            </div>
         
        <!-- container-fluid makes it full width -->
        </div>
    </section>
@endsection
