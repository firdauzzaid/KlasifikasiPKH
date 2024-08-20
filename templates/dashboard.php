<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../static/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../static/assets/img/favicon.png">
  <title>
    Dasboard
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../static/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../static/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../static/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <!-- <script type="text/javascript" src="../static/assets/js/live.js"></script> -->

</head>

<body class="g-sidenav-show  bg-gray-200">
  <style type="text/css">
    .custom-alert {
      /* Warna putih dengan opacity 0.5 */
      background-color: rgba(128, 128, 128, 0.5);
    }
  </style>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{url_for('dashboard')}}">
        <img src="../static/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">PKH Clasisifocation</span>
      </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Menu</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url_for('menu_latih_data') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">filter_tilt_shift</i>
            </div>
            <span class="nav-link-text ms-1">Latih Data</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url_for('menu_validasi_data') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">transform</i>
            </div>
            <span class="nav-link-text ms-1">Validasi Data</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{url_for('penerimapkh')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Penerima PKH</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{url_for('klasifikasi')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Klasifikasi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{url_for('hasilklasifikasi')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Hasil Klasifikasi</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{url_for('logout')}}" onclick="return confirm('Apakah anda yakin ingin keluar?')">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Pesan notifikasi -->
    {% with messages = get_flashed_messages(category_filter=['success', 'error']) %}
    {% if messages %}
    <div class="container-fluid py-1 px-3">
      <div class="row">
        <div class="card-body">
          {% set first_message = messages[0] %}
          <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>{{ first_message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    {% endif %}
    {% endwith %}
    <!-- Pesan notifikasi -->

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class='fas fa-user-cog' style='font-size:20px'></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../static/assets/img/small-logos/user.png" class="avatar avatar-sm  me-3 ">
                      </div>

                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">{{ nama_admin  }}</span>
                        </h6>
                      </div>

                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize" href="{{url_for('penerimapkh')}}">Penerima PKH</p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Jumlah Data : {{ total_data }}</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize" href="{{url_for('klasifikasi')}}">Klasifikasi</p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Jumlah Data : {{ total_data }}</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize" href="{{url_for('hasilklasifikasi')}}">Hasil Klasifikasi</p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"></span>Jumlah Data : {{ total_hasilklasifikasi }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--   Chart   -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-xl-8 col-sm-8 col-md-8">
          <div class="card card-style mb-8">
            <div class="card-body">
              <div class="chart-container" style="display: flex; justify-content: center; align-items: center;">
                <canvas id="bar-pie"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!--   Akurasi   -->
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-8">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="text-center pt-1">
                <p class="text-sm mb-0 text-capitalize">Nilai Akurasi Sistem</p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <div class="row">
                <div class="col-sm-10">
                  <p class="mb-4"><span class="text-danger text-sm-4 font-weight-bolder"></span>Akurasi Yang Digunakan Saat Ini</p>
                  <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                      <pre>Akurasi Data Uji    : {{ hasil_akurasi_test }}</pre>
                  </p>
                  <p class="mb-0 pl-2"><span class="text-danger text-sm font-weight-bolder">
                      <pre>Akurasi Data Latih  : {{ hasil_akurasi_train }}</pre>
                  </p>
                </div>
              </div>
              <hr class="dark horizontal my-3">
              <div class="row">
                <div class="col-sm-10">
                  <p class="mb-4"><span class="text-danger text-sm font-weight-bolder"></span>Hasil Akurasi Terbaru</p>
                  <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                      <pre>Akurasi Data Uji    : {{ new_akurasi_test }}</pre>
                  </p>
                  <p class="mb-0 pl-2"><span class="text-danger text-sm font-weight-bolder">
                      <pre>Akurasi Data Latih  : {{ new_akurasi_train }}</pre>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Skrip AJAX untuk mengambil data dari server Flask -->
    <script>
      // Buat fungsi untuk mengambil data dari server Flask
      function getDataFromFlask() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/get_data', true);

        xhr.onload = function() {
          if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            var totalLayak = data.total_layak;
            var totalTidakLayak = data.total_tidak_layak;

            // Gunakan nilai-nilai ini untuk membuat grafik di sini
            var ctx = document.getElementById('bar-pie').getContext('2d');
            var mychart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ['Layak', 'Tidak Layak'],
                datasets: [{
                  label: 'Data',
                  data: [totalLayak, totalTidakLayak],
                  backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 205, 86)'],
                  hoverOffset: 2
                }]
              },
              options: {
                animation: {
                  duration: 1000,
                  easing: 'easeInOutCubic'
                }
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem) {
                      return tooltipItem.yLabel + ' Data';
                    }
                  }
                }
              },
              options: {
                title: {
                  display: true,
                  text: 'Grafik Data Layak vs Tidak Layak'
                },
                scales: {
                  y: {
                    beginAtZero: true,
                    title: {
                      display: true,
                      text: 'Jumlah Data'
                    }
                  },
                  x: {
                    title: {
                      display: true,
                      text: 'Status'
                    }
                  }
                }
              }
            });
          }
        };
        xhr.send();
      }
      // Panggil fungsi untuk mengambil data saat dokumen dimuat
      getDataFromFlask();
    </script>
    <!--   EndChart   -->

  </main>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../static/assets/js/core/popper.min.js"></script>
  <script src="../static/assets/js/core/bootstrap.min.js"></script>
  <script src="../static/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../static/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../static/assets/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../static/assets/js/material-dashboard.min.js?v=3.0.5"></script>

</body>

</html>