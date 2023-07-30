<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li> <a href="{{ url('/home') }}"><i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Dashboard</span></a> </li>

                {{-- Admin Sidebar Start --}}
                @if (Auth::user()->role == 'admin')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-sticky-note" aria-hidden="true"></i> <span> Products</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('create-products/' . Auth::user()->id) }}">Add Products</a></li>
                            <li><a href="{{ url('products') }}">View Products</a></li>
                            <li><a href="{{ url('enabled') }}">Enabled Products</a></li>
                            <li><a href="{{ url('disabled') }}">Disabled Products</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <span> Orders</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('all_orders/' . Auth::user()->id) }}">All Orders</a></li>
                            <li><a href="{{ url('ordered/' . Auth::user()->id) }}">Ordered</a></li>
                            <li><a href="{{ url('reviewed/' . Auth::user()->id) }}">Reviewed</a></li>
                            <li><a href="{{ url('delivered/' . Auth::user()->id) }}">Review
                                    Submitted Pending Refund</a></li>
                            <li><a href="{{ url('reviewed_deleted/' . Auth::user()->id) }}">Reviewed Deleted</a></li>
                            <li><a href="{{ url('refunded/' . Auth::user()->id) }}">Refunded</a></li>
                            <li><a href="{{ url('on_hold/' . Auth::user()->id) }}">On Hold</a></li>
                            <li><a href="{{ url('pending/' . Auth::user()->id) }}">Refunded Pending</a></li>
                            <li><a href="{{ url('cancelled/' . Auth::user()->id) }}">Cancelled</a></li>
                            <li><a href="{{ url('completed/' . Auth::user()->id) }}">Completed</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span> Reservations</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('reservations/' . Auth::user()->role . '/' . Auth::user()->id) }}">Reserve
                                    Products</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-male" aria-hidden="true"></i> <span> Customers</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('customers') }}">All Customers</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o" aria-hidden="true"></i> <span> Report</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('report') }}">Report</a></li>
                        </ul>
                    </li>
                @endif
                {{-- Admin Sidebar End --}}

                {{-- PMM Sidebar Start --}}
                @if (Auth::user()->role == 'pmm')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-sticky-note" aria-hidden="true"></i> <span> Products</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('create-products/' . Auth::user()->id) }}">Add Products</a></li>
                            <li><a href="{{ url('products') }}">View Products</a></li>
                            <li><a href="{{ url('enabled') }}">Enabled Products</a></li>
                            <li><a href="{{ url('disabled') }}">Disabled Products</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <span> Orders</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('all_orders/' . Auth::user()->id) }}">All Orders</a></li>
                            <li><a href="{{ url('ordered/' . Auth::user()->id) }}">Ordered</a></li>
                            <li><a href="{{ url('reviewed/' . Auth::user()->id) }}">Reviewed</a></li>
                            <li><a href="{{ url('delivered/' . Auth::user()->id) }}">Review
                                    Submitted Pending Refund</a></li>
                            <li><a href="{{ url('reviewed_deleted/' . Auth::user()->id) }}">Reviewed Deleted</a></li>
                            <li><a href="{{ url('refunded/' . Auth::user()->id) }}">Refunded</a></li>
                            <li><a href="{{ url('on_hold/' . Auth::user()->id) }}">On Hold</a></li>
                            <li><a href="{{ url('pending/' . Auth::user()->id) }}">Refunded Pending</a></li>
                            <li><a href="{{ url('cancelled/' . Auth::user()->id) }}">Cancelled</a></li>
                            <li><a href="{{ url('completed/' . Auth::user()->id) }}">Completed</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span> Reservations</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('reservations/' . Auth::user()->role . '/' . Auth::user()->id) }}">Reserve
                                    Products</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o" aria-hidden="true"></i> <span> Report</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('report') }}">Report</a></li>
                        </ul>
                    </li>
                @endif
                {{-- PMM Sidebar End --}}

                {{-- PM Sidebar Start --}}
                @if (Auth::user()->role == 'pm')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-sticky-note" aria-hidden="true"></i> <span> Products</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('products') }}">View Products</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <span>
                                Orders</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('all_orders/' . Auth::user()->id) }}">All Orders</a></li>
                            <li><a href="{{ url('ordered/' . Auth::user()->id) }}">Ordered</a></li>
                            <li><a href="{{ url('reviewed/' . Auth::user()->id) }}">Reviewed</a></li>
                            <li><a href="{{ url('delivered/' . Auth::user()->id) }}">Review
                                    Submitted Pending Refund</a></li>
                            <li><a href="{{ url('reviewed_deleted/' . Auth::user()->id) }}">Reviewed Deleted</a></li>
                            <li><a href="{{ url('refunded/' . Auth::user()->id) }}">Refunded</a></li>
                            <li><a href="{{ url('on_hold/' . Auth::user()->id) }}">On Hold</a></li>
                            <li><a href="{{ url('pending/' . Auth::user()->id) }}">Refunded Pending</a></li>
                            <li><a href="{{ url('cancelled/' . Auth::user()->id) }}">Cancelled</a></li>
                            <li><a href="{{ url('completed/' . Auth::user()->id) }}">Completed</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span> Reservations</span>
                            <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('reservations/' . Auth::user()->role . '/' . Auth::user()->id) }}">Reserve
                                    Products</a></li>
                        </ul>
                    </li>
                @endif
                {{-- PM Sidebar Start --}}

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
