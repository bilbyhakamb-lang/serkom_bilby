<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMA 7 TASIKMALAYA | @yield('title')</title>

    <!-- SEO Optimization -->
    <meta name="description" content="KasFlow - Dashboard Administrasi">
    <meta name="author" content="KasFlow Team">

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
</head>

<body>

  <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green sticky navigation
         ========================================== -->
<div class="sidebar-wrapper" id="sidebar">

    <!-- Brand -->
<!-- Brand -->
<!-- Dashboard -->
    <div class="sidebar-menu-section">
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a href="#"
                  class="sidebar-menu-link">
                    <i class="bi bi-house-fill"></i>
                    <span>SMN 7 TASIKMALAYA</span>
                </a>
            </li>
                <li class="sidebar-menu-item">
                  <a href="{{ route('dashboard.dashboard') }}"
                    class="sidebar-menu-link {{ request()->routeIs('dashboard.dashboard') ? 'active' : '' }}">
                      <i class="bi bi-images"></i>
                      <span>Dashboard</span>
                  </a>
               </li>
              </ul>
          </div>
    <!-- Navigation -->
    <div class="flex-grow-1 overflow-y-auto">
        <!-- Profile Sekolah -->
        <div class="sidebar-menu-section">
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                  <a href="{{ route('admin.profile') }}"
                     class="sidebar-menu-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                      <i class="bi bi-bank"></i>
                      <span>Profile Sekolah</span>
                  </a>
                </li>
            </ul>
        </div>
        <!-- Components -->
        <div class="sidebar-menu-section">
            <ul class="sidebar-menu-list">
                <!-- Guru -->
                <li class="sidebar-menu-item">
                  <a href="{{ route('admin.guru') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.guru') ? 'active' : '' }}">
                      <i class="bi bi-person-gear"></i>
                      <span>Kelola Guru</span>
                  </a>
                </li>
                <!-- Siswa -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.siswa') }}"
                      class="sidebar-menu-link {{ request()->routeIs('admin.siswa') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Kelola Siswa</span>
                    </a>
                </li>
                <!-- Berita -->
                <li class="sidebar-menu-item">
                  <a href="{{ route('admin.berita') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.berita') ? 'active' : '' }}">
                      <i class="bi bi-newspaper"></i>
                      <span>Kelola Berita</span>
                  </a>
                </li>
            </ul>
        </div>
        <!-- Pages -->
        <div class="sidebar-menu-section">
            <ul class="sidebar-menu-list">
                <!-- Ekstrakulikuler -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.ekstrakulikuler') }}"
                      class="sidebar-menu-link {{ request()->routeIs('admin.ekstrakulikuler') ? 'active' : '' }}">
                        <i class="bi bi-trophy"></i>
                        <span>Kelola Ekstrakulikuler</span>
                    </a>
                </li>
                <!-- Galeri -->
                <li class="sidebar-menu-item">
                  <a href="{{ route('admin.galeri') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
                      <i class="bi bi-images"></i>
                      <span>Kelola Galeri</span>
                  </a>
                </li>
            </ul>
        </div>
       </div>
      </div>
    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <!-- <div class="sidebar-profile">
      <img src="assets/images/avatar.png" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Administrator</div>
        <div class="sidebar-profile-email">admin@email.com</div>
      </div>
    </div>
  </div> -->
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle (visible on large screens only) -->
        <!-- Quick Actions Dropdown -->
        <div class="dropdown ms-2">

          <ul class="dropdown-menu dropdown-menu-quick-action" aria-labelledby="quick-actions-dropdown">
            <li class="dropdown-header">Quick Action Shortcuts</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-plus"></i> New Invoice</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i> New User</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam"></i> New Product</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> System Settings</a></li>
          </ul>
        </div>
      </div>

      <!-- Mid navbar: search pill -->
      <!-- <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Search anything in Spark..." id="main-search">
        <button class="navbar-search-btn" aria-label="Search">
          <i class="bi bi-search"></i>
        </button>
      </div> -->

      <!-- Right actions -->
      <div class="navbar-actions">
        <!-- Fullscreen Toggle -->
        <!-- <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button> -->
        <div class="dropdown">
          <!-- <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
            <i class="bi bi-bell"></i>
            <span class="navbar-action-badge"></span>
          </button> -->
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
            aria-labelledby="btn-notifications">
            <div class="notification-header">
              <h6 class="notification-title">Notifications</h6>
              <button class="btn-clear-all" type="button">Mark all read</button>
            </div>
            <div class="notification-list">
              <!-- Sale Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-success text-white">
                  <i class="bi bi-wallet2"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">New sale received: <strong>$150.00</strong></p>
                  <span class="notification-time">2 mins ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>
              <!-- User Registration Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-primary text-white">
                  <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">New user registered: <strong>John Doe</strong></p>
                  <span class="notification-time">1 hour ago</span>
                </div>
                <span class="notification-unread-dot"></span>
              </a>
              <!-- Low Stock Notification -->
              <a href="#" class="notification-item">
                <div class="notification-icon bg-warning text-dark">
                  <i class="bi bi-box-seam-fill"></i>
                </div>
                <div class="notification-content">
                  <p class="notification-text">Stock running low: <strong>Hoodie</strong></p>
                  <span class="notification-time">3 hours ago</span>
                </div>
              </a>
            </div>
            <a href="#" class="notification-footer">View All Notifications</a>
          </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
          <!-- <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <img src="assets/images/avatar.png" alt="Profile Image" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">Administrator</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button> -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="page-login.html"><i class="bi bi-box-arrow-right"></i>
                Logout</a></li>
          </ul>
        </div>
      </div>
    </header>
    <!-- END: Top Navbar Component -->

    <!-- START: Dashboard Header Banner -->
    <div class="page-header">
      @yield('content')
    </div>
    <!-- END: Dashboard Header Banner -->

    <!-- END: Main Layout Grid -->

    <!-- START: Footer Component -->
    <footer class="footer-custom">
      <div class="footer-left">
        <span class="footer-logo">
          <i class="bi bi-asterisk"></i> ProfileSekolah
        </span>
        <span class="footer-separator">|</span>
        <span class="footer-copy">&copy; 2026 Made with <i class="bi bi-heart-fill text-danger footer-heart"></i> by<a
            href="https://sparkadminpro.gumroad.com/" target="_blank">ProfileSekolah</a>• Distributed by <a
            href="https://www.themewagon.com/" target="_blank">ThemeWagon</a> </span>
      </div>
      <div class="footer-right">
        <ul class="footer-links">
          <li><a href="#" class="footer-link">Overview</a></li>
          <li><a href="#" class="footer-link">Statistics</a></li>
          <li><a href="#" class="footer-link">Help & Documentation</a></li>
          <li><a href="#" class="footer-link">Status <span class="status-dot"></span></a></li>
        </ul>
      </div>
    </footer>
    <!-- END: Footer Component -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

  <!-- Local dashboard interactions controller -->
  <script src="assets/js/dashboard.js"></script>
</body>

</html>