@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">


            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Product Detail</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Detail</li>
                    </ul>
                </div>
            </div>

        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ url('update_product_detail') }}" method="POST" enctype="multipart/form-data" id="detail_from">
            @csrf
            <input type="hidden" name="edit_detail_id" value="{{ $data['product_detail']->product_no }}">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-body">

                            <h4>Picture</h4>
                            <img src="{{ asset('public/uploads/image/' . $data['product_detail']->image) }}"
                                class="img-fluid" alt="No Image">
                            <input type="file" name="image" class="form-control">
                            <hr>
                            <h4 class="mt-4">Amazon Picture</h4>
                            <img src="{{ asset('public/uploads/amz/image/' . $data['product_detail']->amz_image) }}"
                                class="img-fluid" alt="No Image">
                            <input type="file" name="amz_image" class="form-control">
                        </div>
                        <div class="col-md-8"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Details</h3>
                            <a href="javascript:void(0)" class="btn btn-success btn-sm pull-right btn_edit_detail">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm pull-right btn_cancel"
                                style="display: none;">Cancel</a>
                        </div>
                        <div class="card-body" id="view_detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Keyword</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->keyword }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Sold By</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->amz_seller }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Brand Name</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->brand_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Product ID</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->product_no }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Market</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->market }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Category</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->category->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Commsission</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->commission }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Chinese Seller</h4>
                                    <p class="text-secondary">{{ $data['product_detail']->chi_seller }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Product Type </h4>
                                    <p class="text-secondary">{{ $data['product_detail']->prod_type }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Seller Name </h4>
                                    <p class="text-secondary">{{ $data['product_detail']->users->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Daily Sale Limit </h4>
                                    <p class="text-secondary">{{ $data['product_detail']->tot_remaining }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Overall Sale </h4>
                                    <p class="text-secondary">{{ $data['product_detail']->tot_sale }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;" id="update_detail">
                            <h4>Update Details</h4>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label>Keyword</label>
                                    <input type="text" name="keyword" class="form-control"
                                        value="{{ $data['product_detail']->keyword }}" placeholder="keyword" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control"
                                        value="{{ $data['product_detail']->brand_name }}" placeholder="brand name"
                                        required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>AMZ Seller</label>
                                    <input type="text" name="amz_seller" class="form-control"
                                        value="{{ $data['product_detail']->amz_seller }}" placeholder="AMZ seller"
                                        required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>Market</label>
                                    <select name="market" class="form-control" required>
                                        <option value="US"
                                            {{ $data['product_detail']->market == 'US' ? 'selected' : '' }}>US</option>
                                        <option value="UK"
                                            {{ $data['product_detail']->market == 'UK' ? 'selected' : '' }}>UK</option>
                                        <option value="DE"
                                            {{ $data['product_detail']->market == 'DE' ? 'selected' : '' }}>DE</option>
                                        <option value="IT"
                                            {{ $data['product_detail']->market == 'IT' ? 'selected' : '' }}>IT</option>
                                        <option value="CA"
                                            {{ $data['product_detail']->market == 'CA' ? 'selected' : '' }}>CA</option>
                                        <option value="ES"
                                            {{ $data['product_detail']->market == 'ES' ? 'selected' : '' }}>ES</option>
                                        <option value="AUS"
                                            {{ $data['product_detail']->market == 'AUS' ? 'selected' : '' }}>AUS</option>
                                        <option value="JAPAN"
                                            {{ $data['product_detail']->market == 'JAPAN' ? 'selected' : '' }}>JAPAN
                                        </option>
                                        <option value="KSA"
                                            {{ $data['product_detail']->market == 'KSA' ? 'selected' : '' }}>KSA</option>
                                        <option value="UAE"
                                            {{ $data['product_detail']->market == 'UAE' ? 'selected' : '' }}>UAE</option>
                                        <option value="General"
                                            {{ $data['product_detail']->market == 'General' ? 'selected' : '' }}>General
                                        </option>
                                        <option value="Maxico"
                                            {{ $data['product_detail']->market == 'Maxico' ? 'selected' : '' }}>Maxico
                                        </option>
                                        <option value="Russia"
                                            {{ $data['product_detail']->market == 'Russia' ? 'selected' : '' }}>Russia
                                        </option>
                                        <option value="Sweden"
                                            {{ $data['product_detail']->market == 'Sweden' ? 'selected' : '' }}>Sweden
                                        </option>
                                        <option value="Netherland"
                                            {{ $data['product_detail']->market == 'Netherland' ? 'selected' : '' }}>
                                            Netherland</option>
                                        <option value="Us-High-Commission"
                                            {{ $data['product_detail']->market == 'Us-High-Commission' ? 'selected' : '' }}>
                                            Us-High-Commission</option>
                                        <option value="Uk-High-Commission"
                                            {{ $data['product_detail']->market == 'Uk-High-Commission' ? 'selected' : '' }}>
                                            Uk-High-Commission</option>
                                        <option value="Walmart-US"
                                            {{ $data['product_detail']->market == 'Walmart-US' ? 'selected' : '' }}>
                                            Walmart-US</option>
                                        <option value="Turkey"
                                            {{ $data['product_detail']->market == 'Turkey' ? 'selected' : '' }}>Turkey
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>Choose Category</label>
                                    <select name="cate_id" class="form-control" required>
                                        <option value="" selected disabled>Choose category</option>
                                        @isset($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $data['product_detail']->cate_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label>Product Type</label>
                                        <select name="prod_type" class="form-control" required id="prod_type">
                                            <option value="" selected disabled>Choose type</option>
                                            <option value="Review"
                                                {{ $data['product_detail']->prod_type == 'Review' ? 'selected' : '' }}>
                                                Review</option>
                                            <option value="Top Reviwer"
                                                {{ $data['product_detail']->prod_type == 'Top Reviwer' ? 'selected' : '' }}>
                                                Top Reviwer</option>
                                            <option value="No Review"
                                                {{ $data['product_detail']->prod_type == 'No Review' ? 'selected' : '' }}>
                                                No Review</option>
                                            <option value="Feedback"
                                                {{ $data['product_detail']->prod_type == 'Feedback' ? 'selected' : '' }}>
                                                Feedback</option>
                                            <option value="Rating"
                                                {{ $data['product_detail']->prod_type == 'Rating' ? 'selected' : '' }}>
                                                Rating</option>
                                            <option value="RAS"
                                                {{ $data['product_detail']->prod_type == 'RAS' ? 'selected' : '' }}>RAS
                                            </option>
                                            <option value="RAO"
                                                {{ $data['product_detail']->prod_type == 'RAO' ? 'selected' : '' }}>RAO
                                            </option>
                                            <option value="Seller Testing"
                                                {{ $data['product_detail']->prod_type == 'Seller Testing' ? 'selected' : '' }}>
                                                Seller Testing</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Commission</label>
                                        <input type="text" name="commission"
                                            value="{{ $data['product_detail']->commission }}" class="form-control"
                                            required>
                                    </div>
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            //click on edit button
            $('#detail_from').on('click', '.btn_edit_detail', function() {

                $('.btn_edit_detail').css('display', 'none');
                $('.btn_cancel').css('display', 'block');

                $('#view_detail').css('display', 'none');
                $('#update_detail').css('display', 'block');

            });

            //click on cancel button
            $('#detail_from').on('click', '.btn_cancel', function() {

                $('.btn_edit_detail').css('display', 'block');
                $('.btn_cancel').css('display', 'none');

                $('#view_detail').css('display', 'block');
                $('#update_detail').css('display', 'none');

            });
        });
    </script>
@endsection
