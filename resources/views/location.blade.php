@extends('layouts.front')
@section('content_front')
    <section>
        <div class="container my-5">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">{{$graveyard->graveyard_name}}</h2>
                    <p class="lead">Total Blocks: {{ $graveyard->block_numbers }} | Available: {{$graveyard->block_details->where('status', 'available')->count()}}</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img 
                        src="{{ asset($graveyard->graveyard_image) }}" 
                        alt="{{ $graveyard->graveyard_name }}" 
                        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal"
                    >
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">{{$graveyard->graveyard_name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img 
                            src="{{ asset($graveyard->graveyard_image) }}" 
                            alt="{{ $graveyard->graveyard_name }}" 
                            class="img-fluid"
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container my-5"> <!-- container-fluid makes it full width -->
        <h2 class="text-center">Blocks Availability</h2>
            <div class="row">
            @foreach($graveyard->block_details as $block)
                <div class="col-lg-1 mb-3 text-white">
                    <div 
                        class="block-square d-flex justify-content-center align-items-center text-white"
                        style="background-color: {{ $block->status == 'available' ? 'green' : 'red' }};"
                    >
                        <p class="mb-0 text-white">{{ $block->block_name }}</p>
                        @if($block->status == 'not available')
                            <!-- Deceased Initials -->
                            <!-- <span 
                                class="deceased-details" 
                                data-id="{{ $block->id }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#deceasedModal"
                            >
                                
                            </span> -->

                            <span 
                                class="deceased-details text-center" 
                                data-block-id="{{ $block->id }}" 
                                data-deceased="{{ $block->deceased_details->toJson() }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#deceasedModal"
                                style="font-size:8px;"
                            >
                               NOT AVAILABLE
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <!-- Single Modal -->
    <div class="modal fade" id="deceasedModal" tabindex="-1" aria-labelledby="deceasedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deceasedModalLabel">Details of Deceased</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-deceased-list">
                        <!-- Dynamic content will be injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // jQuery to update modal content dynamically
        // $(document).on('click', '.deceased-details', function() {
        //     let first_name = $(this).data('first-name');
        //     let last_name = $(this).data('last-name');
        //     let age = $(this).data('age');
        //     let date_of_burial = $(this).data('date-of-burial');
        //     let remarks = $(this).data('remarks');
        //     console.log(first_name);
        //     // Update modal content
        //     $('#modal-first-name').text(first_name);
        //     $('#modal-last-name').text(last_name);
        //     $('#modal-age').text(age);
        //     $('#modal-date-of-burial').text(date_of_burial);
        //     $('#modal-remarks').text(remarks);
        // });

        document.addEventListener('DOMContentLoaded', function () {
            const deceasedDetailsTriggers = document.querySelectorAll('.deceased-details');
            const modalDeceasedList = document.getElementById('modal-deceased-list');

            deceasedDetailsTriggers.forEach(trigger => {
                trigger.addEventListener('click', function () {
                    // Clear previous modal content
                    modalDeceasedList.innerHTML = '';

                    // Parse deceased details from data attribute
                    const deceasedDetails = JSON.parse(this.getAttribute('data-deceased'));

                    // Populate the modal with each deceased person's details
                    deceasedDetails.forEach(deceased => {
                        const deceasedInfo = `
                            <div class="deceased-item">
                                <p><strong>First Name:</strong> ${deceased.first_name}</p>
                                <p><strong>Last Name:</strong> ${deceased.last_name}</p>
                                <p><strong>Date of Burial:</strong> ${deceased.dob || 'N/A'}</p>
                                <hr>
                            </div>
                        `;
                        modalDeceasedList.innerHTML += deceasedInfo;
                    });
                });
            });
        });
    </script>
@endsection
