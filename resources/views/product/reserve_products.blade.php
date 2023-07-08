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
                                        <td class="countdown-cell">
                                        </td>
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
                <div class="float-right mt-3">
                    {{ $data['reserve_products']->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // startCountdown();
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



            // var countDownDate = new Date().getTime() +
            //     3600000; // 1 hour = 60 minutes * 60 seconds * 1000 milliseconds
            // // Update the countdown every second
            // var countdownInterval = setInterval(() => {
            //     updateCountdown();
            // }, 1000);


            // function updateCountdown() {
            //     var now = new Date().getTime();
            //     var distance = countDownDate - now;

            //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            //     // Check if the countdown has ended
            //     $('#myTable').find('.countdown-cell').text(hours + "h " + minutes + "m " + seconds + "s");

            //     if (distance < 0) {
            //         clearInterval(countdownInterval);
            //         // Call the AJAX function or perform any other action
            //         callAjax();
            //     }
            // }

            // function callAjax() {
            //     // Make the AJAX call using jQuery
            //     var id = $('#id').val();
            //     var product_id = $('#product_id').val();
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ url('remove_reservation') }}",
            //         data: {
            //             id: id,
            //             product_id: product_id,
            //         },
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             window.location.reload();
            //         }
            //     });
            // }


            // function startCountdown() {
            //     var countdownCells = $('.countdown-cell');

            //     countdownCells.each(function() {
            //         var countdownCell = $(this);
            //         // var countdownSeconds = parseInt(countdownCell.data('countdown'));
            //         var countdownDate = new Date();
            //         countdownDate.setMinutes(countdownDate.getMinutes() +
            //             1); // Set countdown time to 1 minute from now

            //         var interval = setInterval(() => {
            //             updateCountdown();
            //         }, 1000);


            //         function updateCountdown() {
            //             var now = new Date().getTime();
            //             var distance = countdownDate - now;

            //             //var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            //             var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            //             // var minutes = Math.floor(countdownSeconds / 60);
            //             // var seconds = countdownSeconds % 60;

            //             countdownCell.text(seconds + "s");
            //             // countdownCell.text(minutes + "m " + seconds + "s");

            //             if (distance < 0) {
            //                 clearInterval(interval);
            //                 countdownCell.text("Countdown expired");
            //                 var id = $('#id').val();
            //                 var product_id = $('#product_id').val();
            //                 // Call your AJAX request here
            //                 $.ajax({
            //                     type: "GET",
            //                     url: "{{ url('remove_reservation') }}",
            //                     data: {
            //                         id: id,
            //                         product_id: product_id,
            //                     },
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
            //                             'content')
            //                     },
            //                     dataType: "json",
            //                     success: function(response) {
            //                         window.location.reload();
            //                     }
            //                 });
            //             }
            //         }

            //     });
            // }




            //Second Code

            // function startCountdown() {
            //     var countdownElement = $('#countdown');
            //     var countdownDate = new Date();
            //     countdownDate.setMinutes(countdownDate.getMinutes() + 1); // Set countdown time to 1 minute from now

            //     var interval = setInterval(updateCountdown, 1000); // Update countdown every second

            //     function updateCountdown() {
            //         var now = new Date().getTime();
            //         var distance = countdownDate - now;

            //         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            //         var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            //         countdownElement.text(seconds + "s");

            //         if (distance < 0) {
            //             clearInterval(interval);
            //             countdownElement.text("Countdown expired");
            //             var id = $('#id').val();
            //             var product_id = $('#product_id').val();
            //             // Call your AJAX request here
            //             $.ajax({
            //                 type: "GET",
            //                 url: "{{ url('remove_reservation') }}",
            //                 data: {
            //                     id: id,
            //                     product_id: product_id,
            //                 },
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 },
            //                 dataType: "json",
            //                 success: function(response) {
            //                     setTimeout(() => {
            //                         window.location.reload();
            //                     }, 1000);
            //                     toastr.success(response.message);
            //                 }
            //             });
            //         }
            //     }
            // }

        });
    </script>
@endsection
