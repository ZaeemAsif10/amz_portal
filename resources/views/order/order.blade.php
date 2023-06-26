@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Orders</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Orders</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Orders</h4>
            </div>
            <div class="card-body">

                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="product_no" class="form-control"
                                placeholder="Search by product code...">
                        </div>
                        <div class="col-md-4">
                            <select name="market" class="form-control">
                                <option value="" selected disabled>Select Market</option>
                                <option value="US">US</option>
                                <option value="UK">UK</option>
                                <option value="DE">DE</option>
                                <option value="IT">IT</option>
                                <option value="CA">CA</option>
                                <option value="ES">ES</option>
                                <option value="AUS">AUS</option>
                                <option value="JAPAN">JAPAN</option>
                                <option value="KSA">KSA</option>
                                <option value="UAE">UAE</option>
                                <option value="General">General</option>
                                <option value="Maxico">Maxico</option>
                                <option value="Russia">Russia</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Netherland">Netherland</option>
                                <option value="Us-High-Commission">Us-High-Commission</option>
                                <option value="Uk-High-Commission">Uk-High-Commission</option>
                                <option value="Walmart-US">Walmart-US</option>
                                <option value="Turkey">Turkey</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="prod_type" class="form-control">
                                <option value="" selected disabled>Select type</option>
                                <option value="Review">Review</option>
                                <option value="Top Reviwer">Top Reviwer</option>
                                <option value="No Review">No Review</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Rating">Rating</option>
                                <option value="RAS">RAS</option>
                                <option value="RAO">RAO</option>
                                <option value="Seller Testing">Seller Testing</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="keyword" class="form-control" placeholder="keyword...">
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="chi_seller" class="form-control"
                                placeholder="Search by chinese seller...">
                        </div>
                        <div class="col-md-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('success') }}
                    </div>
                @elseif (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive mt-5">
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Order Number</th>
                                <th>Product</th>
                                <th>Customer Email</th>
                                <th>Market</th>
                                <th>Type</th>
                                <th>Create Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTable">
                            @if (count($data['orders']) > 0)
                                @foreach ($data['orders'] as $key => $order)
                                    <tr class="text-center text-secondary">
                                        <td >{{ $order->order_limit }}</td>
                                        <td>{{ $order->users->name }}</td>
                                        <td>{{ $order->order_no }}</td>
                                        <td>
                                            <img src="{{ url('public/uploads/image/' . $order->products->image) }}"
                                                width="30" height="40" alt="No Image">
                                        </td>
                                        <td>{{ $order->c_email }}</td>
                                        <td>{{ $order->products->market }}</td>
                                        <td>{{ $order->products->prod_type }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <a href="{{ url('order_detail/' . $order->order_limit) }}"
                                                class="btn btn-success btn-sm">View</a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
                <div class="float-right mt-3">
                    {{ $data['orders']->links('pagination::bootstrap-4') }}
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
