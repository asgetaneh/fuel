@php
    $isVehicleMenu = request()->routeIs('vehicle-types.index', 'vehicles.index', 'vehicle-performances.index', 'drivers.index');
    $isFuelMenu = request()->routeIs('stations.index', 'measurements.index',
     'fuels.index', 'fuel-prices.index', 'fuel-request-reasons.index',
      'station-fuel-storeds.index','station-fuel-storeds.create','station-fuel-storeds.edit', 'station-fuel-storeds.show',
     'fuel-requests.index', 'fuel-requests.create', 'fuel-requests.edit', 'fuel-requests.show',
      'fuel-distributes.index','fuel-distributes.create', 'fuel-distributes.edit', 'fuel-distributes.show');
    $isSettingsMenu = $isVehicleMenu || $isFuelMenu || request()->routeIs('offices.index', 'trips.index');
    $isReportMenu = request()->routeIs('report.index'); // update if more reports
    $isUserMenu = request()->routeIs('users.index'); // update if user pages added
@endphp

<!--begin::Sidebar-->
<aside class="app-sidebar bg-white shadow pt-5" data-bs-theme="light" style="z-index: 100">
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Settings Menu -->
                <li class="nav-item {{ $isSettingsMenu ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isSettingsMenu ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Settings <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">

                        <!-- Offices -->
                        <li class="nav-item">
                            <a href="{{ route('offices.index') }}" class="nav-link {{ request()->routeIs('offices.index') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trips.index') }}" class="nav-link {{ request()->routeIs('trips.index') ? 'active' : '' }}">
                                <i class="fas fa-map	"></i>
                                <p>Trips</p>
                            </a>
                        </li>

                        <!-- Vehicle Management -->
                        <li class="nav-item {{ $isVehicleMenu ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $isVehicleMenu ? 'active' : '' }}">
                                <i class="nav-icon bi bi-truck-front"></i>
                                <p>Vehicle Management <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview ps-4">
                                <li class="nav-item">
                                    <a href="{{ route('vehicle-types.index') }}" class="nav-link {{ request()->routeIs('vehicle-types.index') ? 'active' : '' }}">
                                        <i class="bi bi-truck"></i>
                                        <p>Vehicle Type</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vehicles.index') }}" class="nav-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}">
                                        <i class="bi bi-truck-front-fill"></i>
                                        <p>Vehicles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vehicle-performances.index') }}" class="nav-link {{ request()->routeIs('vehicle-performances.index') ? 'active' : '' }}">
                                        <i class="bi bi-speedometer2"></i>
                                        <p>Vehicle Performance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('drivers.index') }}" class="nav-link {{ request()->routeIs('drivers.index') ? 'active' : '' }}">
                                        <i class="bi bi-person-badge-fill"></i>
                                        <p>Drivers</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Fuel Management -->
                        <li class="nav-item {{ $isFuelMenu ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $isFuelMenu ? 'active' : '' }}">
                                <i class="nav-icon bi bi-fuel-pump-fill"></i>
                                <p>Fuel Management <i class="nav-arrow bi bi-chevron-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview ps-4">
                                <li class="nav-item">
                                    <a href="{{ route('stations.index') }}" class="nav-link {{ request()->routeIs('stations.index') ? 'active' : '' }}">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <p>Fuel Stations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('measurements.index') }}" class="nav-link {{ request()->routeIs('measurements.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel Measurement</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuels.index') }}" class="nav-link {{ request()->routeIs('fuels.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuel-prices.index') }}" class="nav-link {{ request()->routeIs('fuel-prices.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel Prices</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuel-request-reasons.index') }}" class="nav-link {{ request()->routeIs('fuel-request-reasons.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel reuest reasons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('station-fuel-storeds.index') }}" class="nav-link {{ request()->routeIs('station-fuel-storeds.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel Receive/stored</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuel-requests.index') }}" class="nav-link {{ request()->routeIs('fuel-requests.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel request</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fuel-distributes.index') }}" class="nav-link {{ request()->routeIs('fuel-fuel-distributes.index') ? 'active' : '' }}">
                                        <i class="fas fa-gas-pump"></i>
                                        <p>Fuel distribution</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <!-- Reports -->
                <li class="nav-item {{ $isReportMenu ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isReportMenu ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <p>Report <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->routeIs('report.index') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li class="nav-item {{ $isUserMenu ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isUserMenu ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i>
                        <p>User Management <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview ps-4">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->
