@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">


            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Products</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Disabled Products</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-5">
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Market</th>
                                <th>Sale Limit</th>
                                <th>Today Remaining</th>
                                <th>Total Remaining</th>
                                <th>Commission</th>
                                <th>Keyword</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            @if (count($data['products']) > 0)
                                @foreach ($data['products'] as $key => $product)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->market }}</td>
                                        <td>{{ $product->day_sale }}</td>
                                        <td>{{ $product->tot_remaining }}</td>
                                        <td>{{ $product->tot_sale }}</td>
                                        <td>{{ $product->commission }}</td>
                                        <td>{{ $product->keyword }}</td>
                                        <td>{{ $product->product_no }}</td>
                                        <td>
                                            <img src="{{ url('public/uploads/image/' . $product->image) }}" width="30"
                                                height="40" alt="No Image">
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm">View</a>
                                            @if ($product->status == 1)
                                                <a href="javascript:void(0)" class="btn btn-success btn-sm btn_product_status"
                                                    data="{{ $product->id }}">Enabled</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm btn_product_status"
                                                    data="{{ $product->id }}">Disabled</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="float-right mt-3">
                    {{ $data['products']->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //status update
            $('#productTable').on('click', '.btn_product_status', function() {

                var id = $(this).attr('data');

                $.ajax({
                    url: '{{ url('/update_status') }}',
                    type: 'get',
                    async: false,
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            alert(response.message);
                            // toastr.success(response.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }

                    },
                    error: function() {
                        alert('somthing went wrong');
                    }

                });

            });
        });
    </script>
@endsection
