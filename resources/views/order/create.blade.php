@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center mb-5">
                <div class="col">
                    <h3 class="page-title">Create Order</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Order</li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Order</h4>
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

                <form action="{{ url('order_now') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_no" value="{{ $data['product_no']->product_no ?? '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Order Number</label>
                                        <input type="text" name="order_no" class="form-control" placeholder="Order Number"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Email</label>
                                        <input type="text" name="c_email" class="form-control"
                                            placeholder="Customer Email Address" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Order Pic</label>
                                        <input type="file" name="order_image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Refund Pic</label>
                                        <input type="file" name="refund_image" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>AMZ Review Link</label>
                                        <input type="text" name="review_link" class="form-control"
                                            placeholder="AMZ review link">
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-md-6">
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
                        </div> --}}
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Order Now</button>
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
