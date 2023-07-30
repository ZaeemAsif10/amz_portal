@extends('setup.master')

@section('title', 'Customer Details')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                {{ session('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                {{ session('error') }}
            </div>
        @endif


        <form action="{{ url('profile_update') }}" method="POST" enctype="multipart/form-data" id="detail_from">
            @csrf
            <input type="hidden" name="customer_id" value="{{ $data['customer_detail']->id }}">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $path = 'public/uploads/profile/' . $data['customer_detail']->image;
                            @endphp

                            @if ($data['customer_detail']->image != '' && File::exists($path))
                                <img src="{{ asset('public/uploads/profile/' . $data['customer_detail']->image) }}"
                                    class="img-fluid rounded-circle mb-3" width="70%" height="70%" alt="No Image">
                            @else
                                <img src="{{ asset('public/assets/whats/profile.png') }}"
                                    class="img-fluid rounded-circle mb-3" width="70%" height="70%" alt="No Image">
                            @endif
                            <input type="file" name="image" class="form-control">
                            <h4 class="mt-4">{{ $data['customer_detail']->name ?? '' }}</h4>
                            <h5 class="mt-4">{{ $data['customer_detail']->email ?? '' }}</h5>
                        </div>
                        <div class="col-md-8"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Customer Details</h3>
                        </div>


                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 mt-2">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $data['customer_detail']->name ?? '' }}" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control"
                                        value="{{ $data['customer_detail']->email ?? '' }}">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" value="{{ $data['customer_detail']->phone ?? '' }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">Whatsapp Number</label>
                                    <input type="text" name="whats_number"
                                        value="{{ $data['customer_detail']->whats_number ?? '' }}" class="form-control">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">Bank Name</label>
                                    <input type="text" name="bank_name"
                                        value="{{ $data['customer_detail']->bank_name ?? '' }}" class="form-control">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">Account Holer Name</label>
                                    <input type="text" name="account_h_name"
                                        value="{{ $data['customer_detail']->account_h_name ?? '' }}" class="form-control">
                                </div>

                                <div class="col-md-12 mt-2">
                                    <label for="">Bank Account/No </label>
                                    <input type="text" name="account_no"
                                        value="{{ $data['customer_detail']->account_no ?? '' }}" class="form-control">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">CNIC Front</label>
                                    <input type="file" name="cnic_front" class="form-control">
                                    <img src="{{ asset('public/uploads/cnic/front/' . $data['customer_detail']->cnic_front) }}"
                                        class="img-fluid mt-3" width="100%" height="50%" alt="">
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">CNIC Back</label>
                                    <input type="file" name="cnic_back" class="form-control">
                                    <img src="{{ asset('public/uploads/cnic/back/' . $data['customer_detail']->cnic_back) }}"
                                        class="img-fluid mt-3" width="100%" height="50%" alt="">
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
