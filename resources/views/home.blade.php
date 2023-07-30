@extends('setup.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="row">

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('completed') }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['completed'] ?? '' }}</h3>
                                <span>COMPLETED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('cancelled/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-ban" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['cancelled'] ?? '' }}</h3>
                                <span>CANCELLED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('refunded/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['refunded'] ?? '' }}</h3>
                                <span>REFUNDED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('ordered/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['ordered'] ?? '' }}</h3>
                                <span>ORDERED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('reviewed/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['reviewed'] ?? '' }}</h3>
                                <span>REVIEWED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('reviewed_deleted/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-star-half-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['reviewedDeleted'] ?? '' }}</h3>
                                <span>RW DELETED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('delivered/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-truck" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['delivered'] ?? '' }}</h3>
                                <span>DELIVERED</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('on_hold/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-pause-circle" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['onhold'] ?? '' }}</h3>
                                <span>ON HOLD</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <a href="{{ url('pending/' . Auth::user()->id) }}" style="color: black;">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-hourglass-half" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $data['pending'] ?? '' }}</h3>
                                <span>PENDING</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pmm')
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="{{ url('enabled') }}" style="color: black;">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $data['enabled'] ?? '' }}</h3>
                                    <span>ENABLED</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="{{ url('disabled') }}" style="color: black;">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-thumbs-down"
                                        aria-hidden="true"></i></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ $data['disabled'] ?? '' }}</h3>
                                    <span>DISABLED</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>

    </div>
    <!-- /Page Content -->
@endsection
