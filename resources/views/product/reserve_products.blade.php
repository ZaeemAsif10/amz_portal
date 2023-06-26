@extends('setup.master')

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
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>User</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="reserveTable">
                            @if (count($data['reserve_products']) > 0)
                                @foreach ($data['reserve_products'] as $key => $reserve)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reserve->users->name }}</td>
                                        <td>{{ $reserve->products->product_no }}</td>
                                        <td>
                                            <img src="{{ url('public/uploads/image/' . $reserve->products->image) }}"
                                                width="40" height="40" alt="No Image">
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'pm')
                                                <a href="{{ url('create_order/' . $reserve->products->product_no) }}"
                                                    class="btn btn-success btn-sm">Create Order</a>
                                            @endif
                                            <input type="hidden" name="product_id" id="product_id"
                                                value="{{ $reserve->products->id }}">
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

                                alert(response.message);
                                window.location.reload();
                                // toastr.success(response.message);
                            }
                        });
                    }
                })

            });

        });
    </script>
@endsection
