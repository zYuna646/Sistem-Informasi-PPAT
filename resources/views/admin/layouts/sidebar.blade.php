<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/logos/logo_1.png') }}" width="50">
                    <h4 class="mb-0 px-2 fw-bolder">ADMIN PANEL</h4>
                </div>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>  
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar border-top overflow-hidden" data-simplebar="">
            @if (Auth::user()->roles->name === 'admin')
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'dashboard') active @endif"
                        href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'notaris') active @endif" href="{{ route('admin.notaris') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Notaris/PPAT</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'verificator') active @endif" href="{{ route('admin.verificator') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Verificator</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'pelaporan') active @endif"
                        href="{{ route('admin.pelaporan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-files"></i>
                        </span>
                        <span class="hide-menu">Pelaporan</span>
                    </a>
                </li>
            </ul>
            @elseif(Auth::user()->roles->name === 'Notaris' || Auth::user()->roles->name === 'PPAT')
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'dashboard') active @endif"
                        href="{{ route('notaris.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'pelaporan') active @endif"
                        href="{{ route('notaris.pelaporan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-files"></i>
                        </span>
                        <span class="hide-menu">Pelaporan</span>
                    </a>
                </li>
            </ul>
            @elseif(Auth::user()->roles->name === 'Verificator')
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'dashboard') active @endif"
                        href="{{ route('verificator.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'pelaporan') active @endif"
                        href="{{ route('verificator.pelaporan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-files"></i>
                        </span>
                        <span class="hide-menu">Pelaporan</span>
                    </a>
                </li>
            </ul>
            @endif

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>