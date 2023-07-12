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
                <button class="btn btn-primary btn-sm pull-right" id="printReport">Print Report</button>
            </div>
            <div class="card-body">

                <form action="{{ url('report') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="month">Month:</label>
                            <select name="month" id="month" class="form-control" required>
                                <option value="">Select Month</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <Label>Year</Label>
                            <select name="year" id="year" class="form-control" required>
                                <!-- Add options for years, e.g., from 2010 to current year -->
                                <option value="" selected disabled>Select Year</option>
                                @for ($i = date('Y'); $i <= 2023; $i++)
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="" selected disabled>Choose status</option>
                                <option value="Onhold" {{ request('status') == 'Onhold' ? 'selected' : '' }}>Onhold
                                </option>
                                <option value="Reviewed" {{ request('status') == 'Reviewed' ? 'selected' : '' }}>
                                    Reviewed
                                </option>
                                <option value="Ordered" {{ request('status') == 'Ordered' ? 'selected' : '' }}>Ordered
                                </option>
                                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Review
                                    Submitted Pending Refund</option>
                                <option value="Refunded" {{ request('status') == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Refunded
                                    Pending Review</option>
                                <option value="ReviewedDeleted" {{ request('status') == 'ReviewedDeleted' ? 'selected' : '' }}>
                                    Reviewed Deleted</option>
                                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>
                                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>
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
                    <table class="table table-nowrap mb-0" id="monthlyReportTable">
                        <thead>
                            <tr>
                                <th>Pm Name</th>
                                {{-- <th>User ID</th> --}}
                                <th>Order ID</th>
                                <th>Order Number</th>
                                <th>Email</th>
                                <th>Seller</th>
                                <th>Chinese Seller</th>
                                <th>Order Type</th>
                                <th>Refund Date</th>
                                <th>Review Date</th>
                                <th>Market</th>
                                <th>Pmln C</th>
                                <th>Commission</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            @php
                                $sum_of_commission = 0;
                                $sum_of_pmln_commission = 0;
                                $total = 0;
                            @endphp
                            @isset($data['reports'])
                                @foreach ($data['reports'] as $report)
                                    <tr class="text-center text-secondary">
                                        <td>{{ $report->name }}</td>
                                        {{-- <td>{{ $report->seller_id }}</td> --}}
                                        <td>{{ $report->order_limit }}</td>
                                        <td>{{ $report->order_no }}</td>
                                        <td>{{ $report->c_email }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ $report->chi_seller }}</td>
                                        <td>{{ $report->prod_type }}</td>
                                        <td>{{ $report->refund_date }}</td>
                                        <td>{{ $report->review_date }}</td>
                                        <td>{{ $report->market }}</td>
                                        <td>{{ $report->pmnl_commission }}</td>
                                        <td>{{ $report->commission }}</td>
                                    </tr>

                                    @php
                                        $sum_of_commission += $report->commission;
                                        $sum_of_pmln_commission += $report->pmnl_commission;
                                        $total = $sum_of_commission + $sum_of_pmln_commission;
                                    @endphp
                                @endforeach
                            @endisset

                            <tr>
                                <td>

                                </td>
                                {{-- <td></td> --}}
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <p class="">Portal Fee: <strong
                                        class="text-success ">{{ $sum_of_pmln_commission }}</strong></p>
                                </td>
                                <td>
                                    <p class="">Order Fee: <strong
                                        class="text-success ">{{ $sum_of_commission }}</strong></p>
                                </td>
                            </tr>

                            <tr>
                                <td>

                                </td>
                                {{-- <td></td> --}}
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <strong>
                                        <p class="pull-right">Total: <span class="text-success">{{ $total }}</span></p>
                                    </strong>
                                </td>
                            </tr>

                        </tbody>



                    </table>

                    {{-- <div class="row mt-3">
                        <div class="col-md-12">
                            <strong>
                                <p class="pull-right ml-5">Total: <span class="text-success">{{ $total }}</span></p>
                            </strong>
                            <p class="pull-right ml-5">Total Order Fee: <strong
                                    class="text-success ">{{ $sum_of_commission }}</strong></p>
                            <p class="pull-right ">Total Portal Fee: <strong
                                    class="text-success ">{{ $sum_of_pmln_commission }}</strong></p>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#printReport').on('click', function() {
                $.print("#monthlyReportTable");
            });

        });
    </script>

@endsection
