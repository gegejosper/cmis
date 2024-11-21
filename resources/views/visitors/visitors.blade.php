@extends('layouts.layout')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <h1 class="fw-bold">Visitors Logs</h1>
                <button class="btn btn-primary" id="printButton">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>

            <!-- Visitors History Section -->
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($visitors->isEmpty())
                        <div class="text-center mt-3">
                            <p class="text-muted">No visitor history available.</p>
                        </div>
                    @else
                        <table class="table table-hover table-bordered datatable-table" id="visitorTable">
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

                        
                    @endif
                </div>
            </div>
        </div>
    </main>


<!-- JavaScript for Print Functionality -->
<script>
    document.getElementById('printButton').addEventListener('click', function () {
        const printContents = document.getElementById('visitorTable').outerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    });
    $(document).ready(function() {
        $('#visitorTable').DataTable({
            "pageLength": 20, // Set the default number of rows per page
            "initComplete": function() {
                // Add the 'form-control' class to the page length dropdown
                $('select[name="blocks_list_length"]').addClass('mx-2');
            }
        }); 
    });
</script>
@endsection