@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center mb-5">
                <div class="col">
                    <h3 class="page-title">Create Product</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Product</h4>
            </div>
            <div class="card-body">

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('store-products') }}" method="POST" enctype="multipart/form-data" id="prodcutForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keyword</label>
                                        <input type="text" name="keyword" class="form-control" placeholder="keyword"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control"
                                            placeholder="brand name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>AMZ Seller</label>
                                        <input type="text" name="amz_seller" class="form-control"
                                            placeholder="AMZ seller" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Market</label>
                                        <select name="market" class="form-control" required>
                                            <option value="US">US</option>
                                            <option value="UK" selected>UK</option>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chinese Seller</label>
                                        <input type="text" name="chi_seller" class="form-control"
                                            placeholder="Chinese seller" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Choose Category</label>
                                        <select name="cate_id" class="form-control" required>
                                            <option value="" selected disabled>Choose category</option>
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Type</label>
                                        <select name="prod_type" class="form-control" required id="prod_type">
                                            <option value="" selected disabled>Choose type</option>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amazon Picture</label>
                                        <input type="file" name="amz_image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Picture</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Commission</label>
                                        <input type="text" name="commission" id="commission" class="form-control"
                                            placeholder="Minimum value should be 700" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PMNL Commission</label>
                                        <input type="text" class="form-control" id="com_pml" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" cols="30" rows="6">
                                    1. Review need to be submitted after 7 days of shipment received
                                    2. Must use keyword for product search.
                                    3. Buyer should be honest, scammer buyer is responsibility of agent.
                                    4. Don't search with Brand Name.</textarea>
                            </div>
                        </div> --}}

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sale Limit Per Day</label>
                                        <input type="text" name="day_sale" class="form-control"
                                            placeholder="Sale limit pr day" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Overall Sale Limit</label>
                                        <input type="text" name="tot_sale" class="form-control"
                                            placeholder="Overall sale limit" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Add Now</button>
                    </div>
                </form>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#prodcutForm').on('change', '#prod_type', function(e) {

                var type = $(this).val();

                if (type == 'review') {
                    $("#commission").attr("placeholder", "Minimum value should be 700");
                    $("#com_pml").val("175");
                } else if (type == 'topreviwer') {
                    $("#commission").attr("placeholder", "Minimum value should be 1000");
                    $("#com_pml").val("175");
                } else if (type == 'noreview') {
                    $("#commission").attr("placeholder", "Minimum value should be 150");
                    $("#com_pml").val("75");
                } else if (type == 'feedback') {
                    $("#commission").attr("placeholder", "Minimum value should be 250");
                    $("#com_pml").val("100");
                } else if (type == 'rating') {
                    $("#commission").attr("placeholder", "Minimum value should be 250");
                    $("#com_pml").val("100");
                } else if (type == 'ras') {
                    $("#commission").attr("placeholder", "Minimum value should be 250");
                    $("#com_pml").val("100");
                } else if (type == 'rao') {
                    $("#commission").attr("placeholder", "Minimum value should be 150");
                    $("#com_pml").val("75");
                } else {
                    $("#commission").attr("placeholder", "Minimum value should be 1000");
                    $("#com_pml").val("175");
                }

            });
        });
    </script>
@endsection
