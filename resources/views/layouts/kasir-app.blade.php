
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Toko plastik GH Tanjungpinang.</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="supported-color-schemes" content="light dark" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <link rel="icon" href="{{ asset('logo/Lambang_Kota_Tanjungpinang.png') }}" type="image/x-icon">
    <!--end::Primary Meta Tags-->

    <!--begin::Preload AdminLTE CSS-->
    <link rel="preload" href="{{ asset('lte/dist/css/adminlte.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.css') }}">
    </noscript>
    <!--end::Preload AdminLTE CSS-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
      crossorigin="anonymous"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin CSS-->
    <link rel="stylesheet" href="{{ asset('lte/dist/vendor/overlayscrollbars/overlayscrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/vendor/apexcharts/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/vendor/jsvectormap/jsvectormap.min.css') }}">
    <!--end::Third Party Plugin CSS-->
    <style>
/* Overlay transparan */
#loading-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.8);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

/* Animasi spinner */
.spinner {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}
</style>

</head>

  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
   <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav d-flex align-items-center">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list fs-4"></i>
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->

    <!--begin::End Navbar Links-->
    <ul class="navbar-nav d-flex align-items-center ms-auto">
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen fs-5"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit fs-5 d-none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->

      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle fs-4 me-2"></i>
          <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
        </a>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>

      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
         <a href="{{ route('kasir.dashboard') }}" class="brand-link d-flex align-items-center">
    <!-- Logo -->
    <img
        src="{{ asset('logo/Lambang_Kota_Tanjungpinang.png') }}"
        alt="Logo"
        class="opacity-75 shadow me-2"
        style="width: 35px; height: 35px; object-fit: contain;"
    />

    <!-- Teks -->
    <span class="brand-text fw-light" style="font-size: 16px; white-space: nowrap;">
        Toko plastik GH Tanjungpinang
    </span>
</a>

          <!--end::Brand Link-->
        </div>
        <!--begin::Sidebar Wrapper-->
        
        <div class="sidebar-wrapper">
 <nav class="mt-2">
    <!-- Sidebar Menu -->
    <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation"
    >
        {{-- Dashboard --}}
        <li class="nav-header">Dashboard</li>
        <li class="nav-item border-bottom">
            <a href="{{ route('kasir.dashboard') }}"
               class="nav-link {{ request()->routeIs('kasir.dashboard') ? 'active bg-primary text-white' : '' }}">
                <i class="nav-icon bi bi-speedometer2"></i>
                <p>Home</p>
            </a>
        </li>

        {{-- Stok Barang --}}
        <li class="nav-header">Manajemen Stok</li>
        <li class="nav-item border-bottom">
            <a href="{{ route('admin_kasir.stok.index') }}"
               class="nav-link {{ request()->routeIs('admin_kasir.stok.*') ? 'active bg-primary text-white' : '' }}">
                <i class="nav-icon bi bi-box-seam"></i>
                <p>Stok Barang</p>
            </a>
        </li>
    </ul>
</nav>




        </div>
        <!--end::Sidebar Wrapper-->
        
      </aside>
      <!-- Main Content -->
       <div id="loading-overlay">
    <div class="spinner"></div>
</div>

    <main class="container">
        @if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif


        @yield('content')
    </main>
      <!--end::Sidebar-->
<!--begin::Footer-->
<footer class="app-footer bg-light border-top py-3">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!--begin::Copyright-->
    <span class="text-muted">
      &copy; <span id="year"></span> Toko plastik GH Tanjungpinang. 
      All rights reserved.
    </span>
    <!--end::Copyright-->

    <!--begin::Credits-->
    <span class="text-muted">
      Dikembangkan dengan ❤️ menggunakan 
      <a href="https://adminlte.io" class="text-decoration-none fw-bold">AdminLTE</a>
    </span>
    <!--end::Credits-->
  </div>
</footer>
<!--end::Footer-->



    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script>
  // otomatis update tahun copyright
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
<!-- JS untuk highlight langsung -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll("#navigation .nav-link");

    links.forEach(link => {
      link.addEventListener("click", function() {
        // hapus semua active dulu
        links.forEach(l => l.classList.remove("active", "bg-primary", "bg-success", "bg-info", "text-white"));

        // tambahin active ke yg di klik
        this.classList.add("active", "bg-primary", "text-white");
      });
    });
  });
</script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    <script>
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>
    <!-- jsvectormap -->
    <script>
      // World map by jsVectorMap
      new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [
          {
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [
          {
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [
          {
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>
    <!--end::Script-->
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'none'; // matikan alert warning
    $('#dataTable').DataTable({
        destroy: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: { 
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
              next: "Berikutnya", 
                previous: "Sebelumnya"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('.form-hapus');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah submit langsung

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit kalau dikonfirmasi
                }
            });
        });
    });
});
</script>
<script>
document.getElementById('btn-simpan').addEventListener('click', function(e) {
    Swal.fire({
        title: 'Yakin ingin menyimpan data?',
        text: "Data akan disimpan ke database.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-simpan').submit();
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const btnSubmit = document.getElementById("btnSubmit");
    const spinner = btnSubmit.querySelector(".spinner-border");
    const icon = btnSubmit.querySelector(".bi");

    if (form) {
        form.addEventListener("submit", function () {
            // Munculkan spinner
            spinner.classList.remove("d-none");
            // Sembunyikan icon save
            if (icon) icon.classList.add("d-none");
            // Disable tombol agar tidak double klik
            btnSubmit.setAttribute("disabled", true);
        });
    }
});
</script>



  </body>
  @stack('scripts')
