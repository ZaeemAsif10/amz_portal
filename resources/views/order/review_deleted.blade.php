@extends('setup.master')

@section('title', 'Review Deleted')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Review Deleted</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Review Deleted</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Review Deleted</h4>
            </div>
            <div class="card-body">

                <form action="{{ url('reviewed_deleted') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="c_email" class="form-control"
                                placeholder="Search by customer email...">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="product_no" class="form-control"
                                placeholder="Search by porduct ID...">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="order_no" class="form-control" placeholder="Search by order...">
                        </div>
                        <div class="col-md-3 ">
                            <button type="submit" class="btn btn-primary w-100"><i class="fa fa-search"></i></button>
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
                                <th>Update Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTable">
                            @if (count($data['reviewed_deleted']) > 0)
                                @foreach ($data['reviewed_deleted'] as $key => $order)
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
                                        <td>{{ $order->updated_at }}</td>
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
                    {{ $data['reviewed_deleted']->links('pagination::bootstrap-4') }}
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
