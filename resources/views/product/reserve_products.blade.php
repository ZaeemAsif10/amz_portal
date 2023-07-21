@extends('setup.master')

@section('title', 'Reserve Products')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Reserve Products</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reserve Products</li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Reserve Products</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive mt-5">
                    <table class="table table-nowrap mb-0" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>User</th>
                                <th>Product ID</th>
                                <th>Time</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="reserveTable">
                            @if (count($data['reserve_products']) > 0)
                                @foreach ($data['reserve_products'] as $key => $reserve)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reserve->users->name ?? '' }}</td>
                                        <td>{{ $reserve->products->product_no ?? '' }}</td>

                                        {{-- <td class="countdown" data-end-time="{{ $reserve->start_time }}">
                                            <span class="countdown-timer badge badge-danger"></span>
                                        </td> --}}

                                        <td>
                                            <span class="countdown-cell badge badge-danger"
                                                data-cell-id="{{ $reserve->id }}"></span>
                                        </td>

                                        {{-- <td>
                                            <div class="countdown badge badge-danger" data-end="{{ $reserve->start_time }}">
                                            </div>
                                        </td> --}}

                                        <td>
                                            <img src="{{ url('public/uploads/image/' . ($reserve->products->image ?? '')) }}"
                                                width="40" height="40" alt="No Image">
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'pm')
                                                <a href="{{ url('create_order/' . ($reserve->products->product_no ?? '')) }}"
                                                    class="btn btn-success btn-sm">Create Order</a>
                                            @endif
                                            <input type="hidden" name="product_id" id="product_id"
                                                value="{{ $reserve->products->id ?? '' }}">
                                            <input type="hidden" name="id" id="id" value="{{ $reserve->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm remove_btn">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')




    <script>
        $(document).ready(function() {

            // Delete Level 1
            $('#reserveTable').on('click', '.remove_btn', function(e) {
                e.preventDefault();

                var id = $('#id').val();
                var product_id = $('#product_id').val();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to Delete this Data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('remove_reservation') }}",
                            data: {
                                id: id,
                                product_id: product_id,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            success: function(response) {
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                                toastr.success(response.message);
                            }
                        });
                    }
                })

            });

        });
    </script>


    <script>
        // public/js/countdown.js
        document.addEventListener('DOMContentLoaded', function() {
            // Get all the td elements with the "countdown-cell" class
            const countdownCells = document.querySelectorAll('.countdown-cell');

            countdownCells.forEach(cell => {
                // Get the cell id from the "data-cell-id" attribute
                const cellId = cell.dataset.cellId;

                // Function to update the countdown timer in the cell
                function updateCountdownTimer(remainingTime) {
                    if (remainingTime >= 0) {
                        cell.innerText = formatTime(remainingTime);
                    } else {
                        cell.innerText = 'Time\'s up!';
                        // Make the AJAX call using jQuery
                        callAjaxEndpoint();

                    }
                }

                // Function to make an AJAX request to fetch the remaining time
                function fetchRemainingTime() {
                    // Make an AJAX GET request to your Laravel backend
                    var url = "{{ url('get_remaining_time') }}/" + cellId;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            var remainingTime = parseInt(data.remaining_time);
                            updateCountdownTimer(remainingTime);

                            // Continue updating the countdown every second
                            setInterval(function() {
                                remainingTime--;
                                updateCountdownTimer(remainingTime);
                            }, 1000);
                        })
                        .catch(error => console.error('Error fetching remaining time:', error));
                }


                // Function to call the AJAX endpoint when the countdown ends
                function callAjaxEndpoint() {
                    // Make an AJAX POST request to your Laravel backend API endpoint
                    var id = $('#id').val();
                    var product_id = $('#product_id').val();
                    $.ajax({
                        type: "GET",
                        url: "{{ url('remove_reservation') }}",
                        data: {
                            id: id,
                            product_id: product_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }


                // Start the countdown by fetching the remaining time from the server
                fetchRemainingTime();
            });

            // Function to format time in HH:MM:SS format
            function formatTime(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const secs = seconds % 60;

                return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }
        });
    </script>





@endsection
