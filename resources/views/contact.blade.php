@extends('layouts.front')
@section('content_front')
<section>
    <div class="container mt-5"> <!-- container-fluid makes it full width -->
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <img src="{{asset('assets/img/header.JPG')}}" alt="Providence Memorial Park" class="img-fluid rounded" />
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Contact Information</h5>
                    </div>
                    <div class="card-body">
                        <h4>Providence Memorial Park</h4>
                        <p><strong>Address:</strong> National Highway, Magpatao, Lala, Lanao del Norte</p>
                        <p><strong>Office:</strong> National Highway, Maranding, Lala, Lanao del Norte</p>
                        <p><strong>Telephone Numbers:</strong></p>
                        <ul>
                            <li>(063) 496-0288</li>
                            <li>(063) 388-7075</li>
                            <li>(063) 496-0195</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
