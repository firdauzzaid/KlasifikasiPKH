<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../static/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../static/assets/img/favicon.png">
  <title>
    Hasil Klasifikasi
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
</head>

<body class="g-sidenav-show  bg-gray-200">
  <!-- penulisan internal css dalam tag body -->
  <style type="text/css">
    .button1 {
      float: right;
    }

    .alert {
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
          <a class="nav-link text-white active bg-gradient-primary" href="{{url_for('hasilklasifikasi')}}">
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

          <h6 class="font-weight-bolder mb-0">Hasil Klasifikasi</h6>
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
                          <span class="font-weight-bold">{{ nama_admin }}</span>
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

    <div class="row ">
      <div class="col-12">
        <div class="card my-4 ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 ">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
              <h6 class="text-white text-capitalize ps-3">Data Hasil Klasifikasi
                <a class="text-white text-capitalize ps-10"></a>
                <a class="text-white text-capitalize ps-10"></a>
                <a class="text-white text-capitalize ps-10"></a>
                <a class="text-white text-capitalize ps-10"></a>
                <a class="text-white text-capitalize ps-10" href="javascript:void(0);" onclick="confirmCetak()">
                  <button class="btn btn-primary" id="cetak" name="cetak">Cetak</button>
                </a>
                <a class="text-white text-capitalize ps-2" href="javascript:void(0);" onclick="confirmHapus()">
                  <button class="btn btn-primary" id="hapus" name="hapus">Hapus</button>
                </a>
              </h6>
            </div>
          </div>

          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Nomor</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">ID Penerima</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Status PKH</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Hasil Klasifikasi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in data %}
                  <tr>
                    <td>{{ row[0] }}</td>
                    <td>{{ row[1] }}</td>
                    <td>{{ row[2] }}</td>
                    <td>{{ row[3] }}</td>
                    <td>{{ row[4] }}</td>
                    <td>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ row[0] }}" data-id_klasifikasi="{{ row[0] }}" data-id_penerima="{{ row[1] }}" data-nama="{{ row[2] }}" data-status_awal="{{ row[3] }}" data-status_pkh="{{ row[4] }}"> Hapus
                      </button>
                    </td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hapus-->
    {% for row in data %}
    <div class="modal fade" id="hapusModal{{ row[0] }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Hapus Data Penerima PKH</h5>
          </div>

          <form action="{{ url_for('delete_hasil_klasifikasi') }}" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">ID Klasifikasi</label>
                  <input type="text" id="id_klasifikasi" name="id_klasifikasi" class="form-control" readonly value="{{ row[0] }}" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="emailBasic" class="form-label">ID Penerima</label>
                  <input type="text" id="id_penerima" name="id_penerima" class="form-control" readonly value="{{ row[1] }}" />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Nama</label>
                  <input type="text" id="nama" name="nama" class="form-control" readonly value="{{ row[2] }}" />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-control">Status Awal</label>
                  <input type="text" id="status_awal" name="status_awal" class="form-control" readonly value="{{ row[3] }}" />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Status PKH</label>
                  <input type="text" id="status_pkh" name="status_pkh" class="form-control" readonly value="{{ row[4] }}" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" name="delete" type="submit" value="delete">Hapus</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    {% endfor %}
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
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../static/assets/js/core/popper.min.js"></script>
  <script src="../static/assets/js/core/bootstrap.min.js"></script>
  <script src="../static/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../static/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script>
    function confirmCetak() {
      if (confirm("Apakah anda ingin mencetak data?")) {
        // Pesan ini akan muncul jika pengguna menekan tombol "OK" pada dialog konfirmasi
        console.log("Memuat halaman...");
        window.location.href = "{{ url_for('cetak_data') }}";
      } else {
        // Pesan ini akan muncul jika pengguna menekan tombol "Cancel" pada dialog konfirmasi
        console.log("Batal memuat halaman.");
      }
    }

    function confirmHapus() {
      if (confirm("Apakah anda ingin menghapus seluruh data?")) {
        // Pesan ini akan muncul jika pengguna menekan tombol "OK" pada dialog konfirmasi
        console.log("Memuat halaman...");
        window.location.href = "{{ url_for('all_hapus') }}";
      } else {
        // Pesan ini akan muncul jika pengguna menekan tombol "Cancel" pada dialog konfirmasi
        console.log("Batal memuat halaman.");
      }
    }
  </script>

  <script>
    $('#hapusModal').appendTo("body")
  </script>

  <script>
    $('#hapusModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var idKlasifikasi = button.data('id_klasifikasi')
      var idPenerima = button.data('id_penerima')
      var Nama = button.data('nama')
      var statusAwal = button.data('status_awal')
      var statusPKH = button.data('status_pkh')

      var modal = $(this)
      modal.find('.modal-title').text('Hapus Data' + idKlasifikasi)
      modal.find('.modal-body #id_klasifikasi').val(idKlasifikasi)
      modal.find('.modal-body #id_penerima').val(idPenerima)
      modal.find('.modal-body #nama').val(Nama)
      modal.find('.modal-body #status_awal').val(statusAwal)
      modal.find('.modal-body #status_pkh').val(statusPKH)
    })
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../static/assets/js/material-dashboard.min.js?v=3.0.5"></script>
</body>

</html>