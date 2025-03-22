<aside class="left-sidebar with-vertical">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index.html" class="text-nowrap logo-img">
                <img src="https://cdn-icons-png.flaticon.com/512/11287/11287355.png" class="dark-logo" alt="Logo-Dark"
                    width="40" />
                <img src="https://cdn-icons-png.flaticon.com/512/11287/11287355.png" class="light-logo" alt="Logo-light"
                    width="40" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Home -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('events.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Agenda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('events.calendar') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar"></i>
                        </span>
                        <span class="hide-menu">Jadwal</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('event_reports.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-report"></i>
                            </span>
                            <span class="hide-menu">Report</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
