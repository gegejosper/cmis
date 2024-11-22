@extends('layouts.front')
@section('content_front')
<section class="search_page">
    <div class="container"> 
        <div class="row my-5">
            <div class="col-lg-12 text-center">
                <h2 class="mb-4">Search for a deceased..</h2>
                <p class="mb-5 text-muted">
                    Enter the first name or last name of the individual you’re looking for and click "Search." 
                    You can find detailed records quickly and easily.
                    Do not use complete name.
                </p>
                <form action="/search" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <div class="input-group" style="max-width: 600px;">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="q" 
                            placeholder="Enter name (e.g., John Doe)" 
                            aria-label="Search"
                            required
                        >
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@if(isset($deceaseds) && $deceaseds->count() > 0)

<section>
    <div class="container my-5">
        <h2 class="mb-4 text-center">Search Results</h2>
        
        @if(!empty($keyword))
            <p class="text-center text-muted">Search term: <strong>{{ $keyword }}</strong></p>
        @endif

        @if($deceaseds->count() > 0)
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Burial</th>
                            <th>Block</th>
                            <th>Graveyard</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deceaseds as $index => $deceased)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $deceased->first_name }}</td>
                            <td>{{ $deceased->last_name }}</td>
                            <td>{{ $deceased->dob ?? 'N/A' }}</td>
                            <td>{{ $deceased->block_details->block_name ?? 'N/A' }}</td>
                            <td>{{ $deceased->graveyard_details->graveyard_name ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center mt-4">
                No results found for <strong>{{ $keyword }}</strong>.
            </div>
        @endif
    </div>
</section>
@endif
@endsection
