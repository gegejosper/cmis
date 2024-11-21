@extends('layouts.front')
@section('content_front')
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12 text-center">
                    <h2 class="display-4">Gallery</h2>
                    <p class="lead">Explore our collection of amazing photos</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4176.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4176.JPG') }}"
                        >
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4178.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4178.JPG') }}"
                        >
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4180.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4180.JPG') }}"
                        >
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4182.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4182.JPG') }}"
                        >
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4183.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4183.JPG') }}"
                        >
                        
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <img src="{{ asset('assets/img/IMG_4186.JPG') }}" alt="Gallery Image" 
                        class="card-img-top fixed-height-image"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        data-src="{{ asset('assets/img/IMG_4186.JPG') }}"
                        >
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Modal for Larger Image View -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="Large Image" class="img-fluid mb-3" id="modalImage">
                    <p id="modalDescription"></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript to dynamically load content into the modal
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');
            var src = button.getAttribute('data-src');

            // Update the modal's content
            var modalTitle = imageModal.querySelector('.modal-title');
            var modalImage = imageModal.querySelector('#modalImage');
            var modalDescription = imageModal.querySelector('#modalDescription');

            modalTitle.textContent = title;
            modalImage.src = src;
            modalDescription.textContent = description;
        });
    </script>
@endsection
