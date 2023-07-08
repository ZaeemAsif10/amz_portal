@extends('setup.master')

@section('title', 'Report')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Prodcuts</h4>
            </div>
            <div class="card-body">

                <form action="{{ url('report') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">From</label>
                            <input type="date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">To</label>
                            <input type="date" name="to_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="" selected disabled>Choose status</option>
                                <option value="Onhold">Onhold
                                </option>
                                <option value="Reviewed">
                                    Reviewed
                                </option>
                                <option value="Ordered">Ordered
                                </option>
                                <option value="Delivered">Review
                                    Submitted Pending Refund</option>
                                <option value="Refunded">
                                    Refunded
                                </option>
                                <option value="Pending">Refunded
                                    Pending Review</option>
                                <option value="ReviewedDeleted">
                                    Reviewed Deleted</option>
                                <option value="Cancelled">
                                    Cancelled
                                </option>
                                <option value="Completed">
                                    Completed
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="">Search</label>
                            <button type="submit" class="btn btn-primary w-100"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-5">
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Number</th>
                                <th>Customer Email</th>
                                <th>Market</th>
                                <th>Chinese Seller</th>
                                <th>Commission</th>
                                <th>Order Type</th>
                                <th>Refund Date</th>
                                <th>Review Date</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            @isset($data['reports'])
                                @foreach ($data['reports'] as $report)
                                    <tr class="text-center text-secondary">
                                        <td>{{ $report->order_limit }}</td>
                                        <td>{{ $report->order_no }}</td>
                                        <td>{{ $report->c_email }}</td>
                                        <td>{{ $report->market }}</td>
                                        <td>{{ $report->chi_seller }}</td>
                                        <td>{{ $report->commission }}</td>
                                        <td>{{ $report->prod_type }}</td>
                                        <td>{{ $report->refund_date }}</td>
                                        <td>{{ $report->review_date }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')

@endsection
