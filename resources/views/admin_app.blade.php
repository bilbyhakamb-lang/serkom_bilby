<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMAN 7 TASIKMALAYA | @yield('title')</title>
    <!-- SEO Optimization -->
    <meta name="description" content="Sistem Informasi Sekolah">
    <meta name="author" content="ProfileSekolah">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <!-- ApexCharts -->
    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet"href="{{ asset('assets/DataTables/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/css/datatables.min.css') }}">
    <!-- CSS khusus halaman -->
    @stack('styles')
    <style>
        /* ============================= */
        /* NAMA SEKOLAH SIDEBAR */
        /* ============================= */
        .school-name {
            display: block;
            max-width: 140px;
            line-height: 1.3;
            font-weight: 600;
            word-break: break-word;
        }
        /* ============================= */
        /* LOGOUT */
        /* ============================= */
        .sidebar-logout {
            margin-top: 20px;
            padding: 0 15px 20px;
        }
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            border: none;
            background: transparent;
            padding: 12px 15px;
            color: #c0392b;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            text-align: left;
            transition: 0.2s;
        }

        .logout-btn i {
            font-size: 17px;
        }
        .logout-btn:hover {
            background: #fce8e8;
            color: #a93226;
        }
        /* ============================= */
        /* RESPONSIVE SIDEBAR */
        /* ============================= */
        @media (max-width: 768px) {
            .school-name {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
    @php
        $profilSidebar = \App\Models\ProfileSekolah::first();
    @endphp
    <!-- ==========================================
         START: Sidebar
         ========================================== -->
    <div class="sidebar-wrapper" id="sidebar">
        <!-- ============================= -->
        <!-- BRAND / NAMA SEKOLAH -->
        <!-- ============================= -->
        <div class="sidebar-menu-section">
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard.dashboard') }}"
                       class="sidebar-menu-link">
                        <i class="bi bi-house-fill"></i>
                        <span class="school-name">
                            {{ $profilSidebar->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                        </span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- DASHBOARD -->
                <!-- ============================= -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard.dashboard') }}"
                       class="sidebar-menu-link {{ request()->routeIs('dashboard.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-images"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- ============================= -->
        <!-- NAVIGATION -->
        <!-- ============================= -->
        <div class="flex-grow-1 overflow-y-auto">
            <!-- ============================= -->
            <!-- PROFILE SEKOLAH -->
            <!-- ============================= -->
            <div class="sidebar-menu-section">
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.profile') }}"
                           class="sidebar-menu-link {{ request()->is('profile*') ? 'active' : '' }}">
                            <i class="bi bi-bank"></i>
                            <span>
                                Profile Sekolah
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ============================= -->
            <!-- GURU / SISWA / BERITA -->
            <!-- ============================= -->
            <div class="sidebar-menu-section">
                <ul class="sidebar-menu-list">
                    <!-- GURU -->
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.guru') }}"
                           class="sidebar-menu-link {{ request()->routeIs(
                               'admin.guru',
                               'guru.create',
                               'admin.guru.show',
                               'guru.edit',
                               'guru.update'
                           ) ? 'active' : '' }}">
                            <i class="bi bi-person-gear"></i>
                            <span>
                                Kelola Guru
                            </span>
                        </a>
                    </li>
                    <!-- SISWA -->
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.siswa') }}"
                           class="sidebar-menu-link {{ request()->is('siswa*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>
                                Kelola Siswa
                            </span>
                        </a>
                    </li>
                    <!-- BERITA -->
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.berita') }}"
                           class="sidebar-menu-link {{ request()->is('berita*') ? 'active' : '' }}">
                            <i class="bi bi-newspaper"></i>
                            <span>
                                Kelola Berita
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="sidebar-menu-section">
                <ul class="sidebar-menu-list">
                    <!-- EKSTRAKULIKULER -->
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.ekstrakulikuler') }}"
                           class="sidebar-menu-link {{ request()->is('ekstrakulikuler*') || request()->is('eskul*') ? 'active' : '' }}">
                            <i class="bi bi-trophy"></i>
                            <span>
                                Kelola Ekstrakulikuler
                            </span>
                        </a>
                    </li>
                    <!-- GALERI -->
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.galeri') }}"
                           class="sidebar-menu-link {{ request()->is('galeri*') ? 'active' : '' }}">
                            <i class="bi bi-images"></i>
                            <span>
                                Kelola Galeri
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ============================= -->
            <!-- LOGOUT SIDEBAR -->
            <!-- ============================= -->
            <div class="sidebar-logout">
                <form action="{{ route('logout') }}"
                      method="POST">
                    @csrf
                    <button type="submit"
                            class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>
                            Logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- ==========================================
         END: Sidebar
         ========================================== -->
    <!-- ==========================================
         START: Main Content
         ========================================== -->
    <div class="main-wrapper">
        <!-- ============================= -->
        <!-- TOP NAVBAR -->
        <!-- ============================= -->
        <header class="navbar-wrapper">
            <div class="navbar-left">
                <!-- Quick Actions -->
                <div class="dropdown ms-2">
                    <ul class="dropdown-menu dropdown-menu-quick-action"
                        aria-labelledby="quick-actions-dropdown">
                        <li class="dropdown-header">
                            Quick Action Shortcuts
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-file-earmark-plus"></i>
                                New Invoice
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person-plus"></i>
                                New User
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-box-seam"></i>
                                New Product
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear"></i>
                                System Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ============================= -->
            <!-- RIGHT ACTIONS -->
            <!-- ============================= -->
            <div class="navbar-actions">
                <!-- NOTIFICATIONS -->
                <div class="dropdown">
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
                         aria-labelledby="btn-notifications">
                        <div class="notification-header">
                            <h6 class="notification-title">
                                Notifications
                            </h6>
                            <button class="btn-clear-all"
                                    type="button">
                                Mark all read
                            </button>
                        </div>
                        <div class="notification-list">
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-success text-white">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">
                                        New sale received:
                                        <strong>$150.00</strong>
                                    </p>
                                    <span class="notification-time">
                                        2 mins ago
                                    </span>
                                </div>
                                <span class="notification-unread-dot"></span>
                            </a>
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-primary text-white">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">
                                        New user registered:
                                        <strong>John Doe</strong>
                                    </p>
                                    <span class="notification-time">
                                        1 hour ago
                                    </span>
                                </div>
                                <span class="notification-unread-dot"></span>
                            </a>
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-warning text-dark">
                                    <i class="bi bi-box-seam-fill"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text">
                                        Stock running low:
                                        <strong>Hoodie</strong>
                                    </p>
                                    <span class="notification-time">
                                        3 hours ago
                                    </span>
                                </div>
                            </a>
                        </div>
                        <a href="#" class="notification-footer">
                            View All Notifications
                        </a>
                    </div>
                </div>
                <!-- ============================= -->
                <!-- PROFILE DROPDOWN -->
                <!-- ============================= -->

                <div class="dropdown ms-2">
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile"
                        aria-labelledby="profile-dropdown">
                        <li class="dropdown-header">
                            Welcome!
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person"></i>
                                My Account
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear"></i>
                                Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-lock"></i>
                                Lock Screen
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}"
                                  method="POST">
                                @csrf
                                <button type="submit"
                                        class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">

                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- ============================= -->
        <!-- PAGE CONTENT -->
        <!-- ============================= -->
        <div class="page-header">
            @yield('content')
        </div>
        <!-- ============================= -->
        <!-- FOOTER -->
        <!-- ============================= -->
        <footer class="footer-custom">
            <div class="footer-left">
                <span class="footer-logo">
                    <i class="bi bi-asterisk"></i>
                    ProfileSekolah
                </span>
                <span class="footer-separator">
                    |
                </span>
                <span class="footer-copy">
                    &copy; 2026 Made with
                    <i class="bi bi-heart-fill text-danger footer-heart"></i>
                    by
                    <a href="https://sparkadminpro.gumroad.com/"
                       target="_blank">
                        ProfileSekolah
                    </a>
                    • Distributed by
                    <a href="https://www.themewagon.com/"
                       target="_blank">
                        ThemeWagon
                    </a>
                </span>
            </div>
            <div class="footer-right">
                <ul class="footer-links">
                    <li>
                        <a href="#" class="footer-link">
                            Overview
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            Statistics
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            Help & Documentation
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            Status
                            <span class="status-dot"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
    <!-- ==========================================
         END: Main Content
         ========================================== -->

    <!-- ==========================================
         SCRIPTS
         ========================================== -->
    <!-- jQuery -->
    <script src="{{ asset('assets/DataTables/js/jquery.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ApexCharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Flatpickr -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets/DataTables/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/DataTables/js/datatables.min.js') }}"></script>
    <!-- Script per halaman -->
    @stack('scripts')

</body>

</html>