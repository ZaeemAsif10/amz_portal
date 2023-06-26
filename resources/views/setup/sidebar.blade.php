<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a href="{{ url('/') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                </li>

                {{-- Admin Sidebar Start --}}
                @if (Auth::user()->role == 'admin')
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Product Management</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('create-products') }}">Add Products</a></li>
                        <li><a href="{{ url('products') }}">View Products</a></li>
                        <li><a href="{{ url('enabled') }}">Enabled Products</a></li>
                        <li><a href="{{ url('disabled') }}">Disabled Products</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Reservations</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('reservations') }}">Reserve Products</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Customers</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('customers') }}">All Customers</a></li>
                    </ul>
                </li>
                @endif
                 {{-- Admin Sidebar End --}}

                {{-- PMM Sidebar Start --}}
                @if (Auth::user()->role == 'pmm')
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Product Management</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('create-products') }}">Add Products</a></li>
                        <li><a href="{{ url('products') }}">View Products</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Orders</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('all_orders') }}">All Orders</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Reservations</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('reservations') }}">Reserve Products</a></li>
                    </ul>
                </li>
                @endif
                {{-- PMM Sidebar End --}}

                {{-- PM Sidebar Start --}}
                @if (Auth::user()->role == 'pm')
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Product Management</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('products') }}">View Products</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Orders</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('all_orders') }}">All Orders</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Reservations</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ url('reservations') }}">Reserve Products</a></li>
                    </ul>
                </li>
                @endif
                {{-- PM Sidebar Start --}}

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
