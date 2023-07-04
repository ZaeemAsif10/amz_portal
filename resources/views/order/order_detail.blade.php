@extends('setup.master')

@section('title', 'Order Detail')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">


            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Order Detail</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order Detail</li>
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


        <form action="{{ url('update_order_detail') }}" method="POST" enctype="multipart/form-data" id="detail_from">
            @csrf
            <input type="hidden" name="edit_order_detail_id" value="{{ $data['order_detail']->order_limit }}">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h4>Order Picture</h4>
                            <img src="{{ asset('public/uploads/order_image/' . $data['order_detail']->order_image) }}"
                                class="img-fluid" alt="No Image">
                            <input type="file" name="image" class="form-control">

                            <hr>
                            <h4 class="mt-4">Refund Picture</h4>
                            <img src="{{ asset('public/uploads/refund_image/' . $data['order_detail']->refund_image) }}"
                                class="img-fluid" alt="No Image">
                            <input type="file" name="refund_image" class="form-control" id="refund_image">
                            <hr>
                            <h4 class="mt-4">Review Picture</h4>
                            <img src="{{ asset('public/uploads/review_image/' . $data['order_detail']->review_image) }}"
                                class="img-fluid" alt="No Image">
                            <input type="file" name="review_image" class="form-control" id="review_image">
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
                                    <h5>Order Number</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->order_no ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Customer Email</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->c_email ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Product ID</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->products->product_no ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>AMZ Review Link</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->review_link ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Market</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->products->market ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Order Status</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->status ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Order Date</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->date ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Review Date</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->review_date ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Refund Date</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->refund_date ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Last Update Date </h5>
                                    <p class="text-secondary">{{ $data['order_detail']->updated_at ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Commission</h5>
                                    <p class="text-secondary">{{ $data['order_detail']->products->commission ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="display: none;" id="update_detail">
                            <h4>Update Details</h4>
                            <div class="row mb-3">
                                <div class="col-md-6 mt-2">
                                    <label>Order Number</label>
                                    <input type="text" name="order_no" class="form-control"
                                        value="{{ $data['order_detail']->order_no }}" placeholder="order_no" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>AMZ Review Link</label>
                                    <input type="text" name="review_link" class="form-control"
                                        value="{{ $data['order_detail']->review_link }}" placeholder="AMZ Review Link">
                                </div>

                                @if (Auth::user()->role == 'admin')
                                    <div class="col-md-6 mt-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="" selected disabled>Choose status</option>
                                            <option value="Onhold"
                                                {{ $data['order_detail']->status == 'Onhold' ? 'selected' : '' }}>Onhold
                                            </option>
                                            <option value="Reviewed"
                                                {{ $data['order_detail']->status == 'Reviewed' ? 'selected' : '' }}>
                                                Reviewed
                                            </option>
                                            <option value="Ordered"
                                                {{ $data['order_detail']->status == 'Ordered' ? 'selected' : '' }}>Ordered
                                            </option>
                                            <option value="Delivered"
                                                {{ $data['order_detail']->status == 'Delivered' ? 'selected' : '' }}>Review
                                                Submitted Pending Refund</option>
                                            <option value="Refunded"
                                                {{ $data['order_detail']->status == 'Refunded' ? 'selected' : '' }}>
                                                Refunded
                                            </option>
                                            <option value="Pending"
                                                {{ $data['order_detail']->status == 'Pending' ? 'selected' : '' }}>Refunded
                                                Pending Review</option>
                                            <option value="ReviewedDeleted"
                                                {{ $data['order_detail']->status == 'ReviewedDeleted' ? 'selected' : '' }}>
                                                Reviewed Deleted</option>
                                            <option value="Cancelled"
                                                {{ $data['order_detail']->status == 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                            <option value="Completed"
                                                {{ $data['order_detail']->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                        </select>
                                    </div>
                                    @elseif (Auth::user()->role == 'pmm')
                                    <div class="col-md-6 mt-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="" selected disabled>Choose status</option>
                                            <option value="Onhold"
                                                {{ $data['order_detail']->status == 'Onhold' ? 'selected' : '' }}>Onhold
                                            </option>
                                            <option value="Reviewed"
                                                {{ $data['order_detail']->status == 'Reviewed' ? 'selected' : '' }}>
                                                Reviewed
                                            </option>
                                            <option value="Ordered"
                                                {{ $data['order_detail']->status == 'Ordered' ? 'selected' : '' }}>Ordered
                                            </option>
                                            <option value="Delivered"
                                                {{ $data['order_detail']->status == 'Delivered' ? 'selected' : '' }}>Review
                                                Submitted Pending Refund</option>
                                            <option value="Refunded"
                                                {{ $data['order_detail']->status == 'Refunded' ? 'selected' : '' }}>
                                                Refunded
                                            </option>
                                            <option value="Pending"
                                                {{ $data['order_detail']->status == 'Pending' ? 'selected' : '' }}>Refunded
                                                Pending Review</option>
                                            <option value="ReviewedDeleted"
                                                {{ $data['order_detail']->status == 'ReviewedDeleted' ? 'selected' : '' }}>
                                                Reviewed Deleted</option>
                                            <option value="Cancelled"
                                                {{ $data['order_detail']->status == 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                    </div>
                                @else
                                    <div class="col-md-6 mt-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="" selected disabled>Choose status</option>
                                            <option value="Reviewed"
                                                {{ $data['order_detail']->status == 'Reviewed' ? 'selected' : '' }}>
                                                Reviewed
                                            </option>
                                            <option value="Ordered"
                                                {{ $data['order_detail']->status == 'Ordered' ? 'selected' : '' }}>Ordered
                                            </option>
                                            <option value="Cancelled"
                                                {{ $data['order_detail']->status == 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                    </div>
                                @endif

                                <div class="col-md-6 mt-2">
                                    <label for="">Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
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

            var user_role = "{{ Auth::user()->role }}";
            if (user_role == 'pmm') {
                $('#refund_image').css('display', 'block');
                $('#review_image').css('display', 'none');
            } else if (user_role == 'pm') {
                $('#review_image').css('display', 'block');
                $('#refund_image').css('display', 'none');
            } else {
                $('#review_image').css('display', 'block');
                $('#refund_image').css('display', 'block');
            }

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
