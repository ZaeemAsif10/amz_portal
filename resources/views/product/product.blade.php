@extends('setup.master')

@section('title', 'Products')

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
                <h4 class="card-title mb-0">All Prodcuts</h4>
            </div>
            <div class="card-body">

                <form action="{{ url('products') }}" method="POST">
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
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pmm')
                            <div class="col-md-4 mt-2">
                                <input type="text" name="chi_seller" class="form-control"
                                    placeholder="Search by chinese seller...">
                            </div>
                        @else
                            <div class="col-md-4 mt-2">
                                <input type="text" name="seller_id" class="form-control"
                                    placeholder="Search by seller ID...">
                            </div>
                        @endif
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
                                <th>Seller</th>
                                <th>Product ID</th>
                                <th>Market</th>
                                <th>Sale Limit</th>
                                <th>Today Remaining</th>
                                <th>Total Remaining</th>
                                <th>Commission</th>
                                <th>Keyword</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            @if (count($data['products']) > 0)
                                @foreach ($data['products'] as $key => $product)
                                    <tr class="text-center text-secondary">
                                        <td>
                                            <a href="https://api.whatsapp.com/send?phone={{ $product->whats_number }}"
                                                target="_blank">
                                                <img src="{{ url('public/assets/whats/whats2.jpg') }}" width="35"
                                                    height="35" alt="">
                                                <p>{{ $product->seller_id }}</p>
                                            </a>
                                        </td>
                                        <td><a
                                                href="{{ url('product_detail/' . $product->product_no) }}" target="_blank">{{ $product->product_no }}</a>
                                        </td>
                                        <td>{{ $product->market }}</td>
                                        <td>{{ $product->day_sale }}</td>
                                        <td>{{ $product->tot_remaining }}</td>
                                        <td>{{ $product->tot_sale }}</td>
                                        <td>{{ $product->commission }}</td>
                                        <td>{{ $product->keyword }}</td>
                                        <td>
                                            <img src="{{ url('public/uploads/image/' . $product->image) }}" width="30"
                                                height="40" alt="No Image">
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'pm')
                                                <div class="d-flex">
                                                    <form action="{{ url('reserve_now') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_no"
                                                            value="{{ $product->product_no }}">
                                                        <input type="hidden" name="id"
                                                            value="{{ $product->id }}">
                                                        <button type="submit" class="btn btn-secondary btn-sm">Reserve
                                                            Now</button>
                                                    </form>

                                                    <a href="{{ url('product_detail/' . $product->product_no) }}"
                                                        class="btn btn-success btn-sm ml-2">View</a>
                                                </div>
                                            @else
                                                <a href="{{ url('product_detail/' . $product->product_no) }}"
                                                    class="btn btn-success btn-sm">View</a>
                                                @if ($product->status == 1)
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success btn-sm btn_product_status"
                                                        data="{{ $product->id }}">Enabled</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-danger btn-sm btn_product_status"
                                                        data="{{ $product->id }}">Disabled</a>
                                                @endif
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
                            toastr.success(response.message);
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
