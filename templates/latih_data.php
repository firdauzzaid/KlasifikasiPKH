<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../static/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../static/assets/img/favicon.png">
    <title>
        Latih Data
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
    <!-- Live Code -->
    <!-- <script type="text/javascript" src="../static/assets/js/live.js"></script> -->
    <!-- J query -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">
    <!-- penulisan internal css dalam tag body -->
    <style type="text/css">
        .button1 {
            float: right;
        }

        .custom-alert {
            /* Warna putih dengan opacity 0.5 */
            background-color: rgba(128, 128, 128, 0.5);
        }
    </style>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ url_for('dashboard') }}">
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
                    <a class="nav-link text-white active bg-gradient-primary" href="{{ url_for('menu_latih_data') }}">
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
                    <a class="nav-link text-white" href="{{ url_for('penerimapkh') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Penerima PKH</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url_for('klasifikasi') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Klasifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url_for('hasilklasifikasi') }}">
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
                    <a class="nav-link text-white " href="{{ url_for('logout') }}" onclick="return confirm('Apakah anda yakin ingin keluar?')">
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
                    <h6 class="font-weight-bolder mb-0">Latih Data</h6>
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
                            <a class="text-white text-capitalize ps-3">Data Latih
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            <a class="text-white text-capitalize ps-2">Data Latih CSV
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModalCsv">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            <a class="text-white text-capitalize ps-10"></a>
                            <a class="text-white text-capitalize ps-10"></a>
                            <a class="text-white text-capitalize ps-10"></a>
                            <a class="text-white text-capitalize ps-9" href="javascript:void(0);" onclick="confirmInformation()">
                                <button class="btn btn-primary" id="informasi" name="informasi">Informasi</button>
                            </a>
                            <a class="text-white text-capitalize ps-2" href="javascript:void(0);" onclick="confirmLatihData()">
                                <button class="btn btn-primary" id="latih-data" name="latih-data">Latih Data</button>
                            </a>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">ID Penerima</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Alamat</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Status Lahan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Status Bangunan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Jenis Lantai</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Jenis Dinding</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Jenis Atap</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Sumber Air</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Sumber Penerangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Bahan Baku Memasak</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Jenis Kloset</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Jenis Kendaraan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Aset Pribadi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Telpon Rumah</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Wifi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Status PKH</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for row in data %}
                                    <tr>
                                        <td>{{ row[0] }}</td>
                                        <td>{{ row[2] }}</td>
                                        <td>{{ row[3] }}</td>
                                        <td>{{ row[4] }}</td>
                                        <td>{{ row[5] }}</td>
                                        <td>{{ row[6] }}</td>
                                        <td>{{ row[7] }}</td>
                                        <td>{{ row[8] }}</td>
                                        <td>{{ row[9] }}</td>
                                        <td>{{ row[10] }}</td>
                                        <td>{{ row[11] }}</td>
                                        <td>{{ row[12] }}</td>
                                        <td>{{ row[13] }}</td>
                                        <td>{{ row[14] }}</td>
                                        <td>{{ row[15] }}</td>
                                        <td>{{ row[16] }}</td>
                                        <td>{{ row[17] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ row[0] }}" data-id_penerima_edit="{{ row[0] }}" data-nama_edit="{{ row[2] }}" data-alamat_edit="{{ row[3] }}" data-sts_lahan_edit="{{ row[4] }}" data-sts_bangunan_edit="{{ row[5] }}" data-jns_lantai_edit="{{ row[6] }}" data-jns_dinding_edit="{{ row[7] }}" data-jns_atap_edit="{{ row[8] }}" data-smr_air_edit="{{ row[9] }}" data-smr_penerangan_edit="{{ row[10] }}" data-bb_memasak_edit="{{ row[11] }}" data-jns_kloset_edit="{{ row[12] }}" data-jns_kendaraan_edit="{{ row[13] }}" data-aset_pribadi_edit="{{ row[14] }}" data-tlpn_rumah_edit="{{ row[15] }}" data-wifi_edit="{{ row[16] }}" data-statusAwal_edit="{{ row[17] }}">Edit
                                            </button>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ row[0] }}" data-id_data_hapus="{{ row[0] }}" data-hapus_penerima="{{ row[2] }}">Hapus
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

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Data Latih</h5>
                    </div>

                    <form action="{{ url_for('latih_input_penerima_pkh') }}" method="POST">
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">ID Penerima</label>
                                    <input type="text" id="id_penerima" name="id_penerima" class="form-control" placeholder="Masukan ID" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="emailBasic" class="form-label">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan Alamat" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-control">Status Lahan</label>
                                    <select name="sts_lahan" id="sts_lahan" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Pribadi">Pribadi</option>
                                        <option value="Warisan">Warisan</option>
                                        <option value="Negara">Negara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Status Bangunan</label>
                                    <select name="sts_bangunan" id="sts_bangunan" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Pribadi">Pribadi</option>
                                        <option value="Warisan">Warisan</option>
                                        <option value="Umum">Umum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jenis Lantai</label>
                                    <select name="jns_lantai" id="jns_lantai" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Teraso">Teraso</option>
                                        <option value="Keramik">Keramik</option>
                                        <option value="Vinyl">Vinyl</option>
                                        <option value="Semen">Semen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jenis Dinding</label>
                                    <select name="jns_dinding" id="jns_dinding" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Hebel">Hebel</option>
                                        <option value="Batako">Batako</option>
                                        <option value="Bata Merah">Bata Merah</option>
                                        <option value="GRC">GRC</option>
                                        <option value="Kayu">Kayu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jenis Atap</label>
                                    <select name="jns_atap" id="jns_atap" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Tanah Liat">Tanah Liat</option>
                                        <option value="Asbes">Asbes</option>
                                        <option value="Seng">Seng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Sumber Air</label>
                                    <select name="smr_air" id="smr_air" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="PDAM">PDAM</option>
                                        <option value="Sanyo">Sanyo</option>
                                        <option value="Sumur">Sumur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Sumber Penerangan</label>
                                    <select name="smr_penerangan" id="smr_penerangan" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Listrik">Listrik</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Bahan Baku Memasak</label>
                                    <select name="bb_memasak" id="bb_memasak" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Gas">Gas</option>
                                        <option value="Kompor Minyak">Kompor Minyak</option>
                                        <option value="Tungku">Tungku</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jenis Kloset</label>
                                    <select name="jns_kloset" id="jns_kloset" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Kloset Duduk">Kloset Duduk</option>
                                        <option value="Kloset Jongkok">Kloset Jongkok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
                                    <select name="jns_kendaraan" id="jns_kendaraan" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Mobil">Mobil</option>
                                        <option value="Motor">Motor</option>
                                        <option value="Sepeda">Sepeda</option>
                                        <option value="Angkutan Umum">Angkutan Umum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Aset Pribadi</label>
                                    <select name="aset_pribadi" id="aset_pribadi" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Tanah">Tanah</option>
                                        <option value="Sawah">Sawah</option>
                                        <option value="Rumah">Rumah</option>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Telpon Rumah</label>
                                    <select name="tlpn_rumah" id="tlpn_rumah" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Wifi</label>
                                    <select name="wifi" id="wifi" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Status PKH</label>
                                    <input type="text" id="statusAwal" name="statusAwal" class="form-control" placeholder="Masukan Status PKH" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="input" type="submit" class="btn btn-primary" value="input">Save changes</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

        <!-- Modal Tambah (CSV) -->
        <div class="modal fade" id="tambahModalCsv" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Data Latih</h5>
                    </div>

                    <form action="{{ url_for('input_penerima_pkh_csv') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="csv_file" class="form-label">File CSV</label>
                                    <input type="file" id="csv_file" name="csv_file" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="input" type="submit" class="btn btn-primary" value="input">Import Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        {% for row in data %}
        <div class="modal fade" id="editModal{{ row[0] }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Penerima PKH</h5>
                    </div>

                    <form action="{{ url_for('latih_update_penerima_pkh') }}" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">ID Penerima</label>
                                    <input type="text" id="id_penerima_edit" name="id_penerima_edit" class="form-control" placeholder="Masukan ID" value="{{ row[0] }}" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Nama</label>
                                    <input type="text" id="nama_edit" name="nama_edit" class="form-control" placeholder="Masukan Nama" value="{{ row[2] }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Alamat</label>
                                    <input type="text" id="alamat_edit" name="alamat_edit" class="form-control" placeholder="Masukan Alamat" value="{{ row[3] }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-control">Status Lahan</label>
                                    <select name="sts_lahan_edit" id="sts_lahan_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Pribadi" {% if row[4] == "Pribadi" %}selected{% endif %}>Pribadi</option>
                                        <option value="Warisan" {% if row[4] == "Warisan" %}selected{% endif %}>Warisan</option>
                                        <option value="Negara" {% if row[4] == "Negara" %}selected{% endif %}>Negara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Status Bangunan</label>
                                    <select name="sts_bangunan_edit" id="sts_bangunan_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Pribadi" {% if row[5] == "Pribadi" %}selected{% endif %}>Pribadi</option>
                                        <option value="Warisan" {% if row[5] == "Warisan" %}selected{% endif %}>Warisan</option>
                                        <option value="Umum" {% if row[5] == "Umum" %}selected{% endif %}>Umum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jns_lantai_edit" class="form-label">Jenis Lantai</label>
                                    <select name="jns_lantai_edit" id="jns_lantai_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Teraso" {% if row[6] == "Teraso" %}selected{% endif %}>Teraso</option>
                                        <option value="Keramik" {% if row[6] == "Keramik" %}selected{% endif %}>Keramik</option>
                                        <option value="Vinyl" {% if row[6] == "Vinyl" %}selected{% endif %}>Vinyl</option>
                                        <option value="Semen" {% if row[6] == "Semen" %}selected{% endif %}>Semen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jns_dinding_edit" class="form-label">Jenis Dinding</label>
                                    <select name="jns_dinding_edit" id="jns_dinding_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Hebel" {% if row[7] == "Hebel" %}selected{% endif %}>Hebel</option>
                                        <option value="Batako" {% if row[7] == "Batako" %}selected{% endif %}>Batako</option>
                                        <option value="Bata Merah" {% if row[7] == "Bata Merah" %}selected{% endif %}>Bata Merah</option>
                                        <option value="GRC" {% if row[7] == "GRC" %}selected{% endif %}>GRC</option>
                                        <option value="Kayu" {% if row[7] == "Kayu" %}selected{% endif %}>Kayu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jns_atap_edit" class="form-label">Jenis Atap</label>
                                    <select name="jns_atap_edit" id="jns_atap_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Tanah Liat" {% if row[8] == "Tanah Liat" %}selected{% endif %}>Tanah Liat</option>
                                        <option value="Asbes" {% if row[8] == "Asbes" %}selected{% endif %}>Asbes</option>
                                        <option value="Seng" {% if row[8] == "Seng" %}selected{% endif %}>Seng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="smr_air_edit" class="form-label">Sumber Air</label>
                                    <select name="smr_air_edit" id="smr_air_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="PDAM" {% if row[9] == "PDAM" %}selected{% endif %}>PDAM</option>
                                        <option value="Sanyo" {% if row[9] == "Sanyo" %}selected{% endif %}>Sanyo</option>
                                        <option value="Sumur" {% if row[9] == "Sumur" %}selected{% endif %}>Sumur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="smr_penerangan_edit" class="form-label">Sumber Penerangan</label>
                                    <select name="smr_penerangan_edit" id="smr_penerangan_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Listrik" {% if row[10] == "Listrik" %}selected{% endif %}>Listrik</option>
                                        <option value="Lainnya" {% if row[10] == "Lainnya" %}selected{% endif %}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="bb_memasak_edit" class="form-label">Bahan Baku Memasak</label>
                                    <select name="bb_memasak_edit" id="bb_memasak_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Gas" {% if row[11] == "Gas" %}selected{% endif %}>Gas</option>
                                        <option value="Kompor Minyak" {% if row[11] == "Kompor Minyak" %}selected{% endif %}>Kompor Minyak</option>
                                        <option value="Tungku" {% if row[11] == "Tungku" %}selected{% endif %}>Tungku</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jns_kloset_edit" class="form-label">Jenis Kloset</label>
                                    <select name="jns_kloset_edit" id="jns_kloset_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Kloset Duduk" {% if row[12] == "Kloset Duduk" %}selected{% endif %}>Kloset Duduk</option>
                                        <option value="Kloset Jongkok" {% if row[12] == "Kloset Jongkok" %}selected{% endif %}>Kloset Jongkok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="jns_kendaraan_edit" class="form-label">Jenis Kendaraan</label>
                                    <select name="jns_kendaraan_edit" id="jns_kendaraan_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Mobil" {% if row[13] == "Mobil" %}selected{% endif %}>Mobil</option>
                                        <option value="Motor" {% if row[13] == "Motor" %}selected{% endif %}>Motor</option>
                                        <option value="Sepeda" {% if row[13] == "Sepeda" %}selected{% endif %}>Sepeda</option>
                                        <option value="Angkutan Umum" {% if row[13] == "Angkutan Umum" %}selected{% endif %}>Angkutan Umum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="aset_pribadi_edit" class="form-label">Aset Pribadi</label>
                                    <select name="aset_pribadi_edit" id="aset_pribadi_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Tanah" {% if row[14] == "Tanah" %}selected{% endif %}>Tanah</option>
                                        <option value="Sawah" {% if row[14] == "Sawah" %}selected{% endif %}>Sawah</option>
                                        <option value="Rumah" {% if row[14] == "Rumah" %}selected{% endif %}>Rumah</option>
                                        <option value="Tidak Ada" {% if row[14] == "Tidak Ada" %}selected{% endif %}>Tidak Ada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="tlpn_rumah_edit" class="form-label">Telpon Rumah</label>
                                    <select name="tlpn_rumah_edit" id="tlpn_rumah_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Ya" {% if row[15] == "Ya" %}selected{% endif %}>Ya</option>
                                        <option value="Tidak" {% if row[15] == "Tidak" %}selected{% endif %}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="wifi_edit" class="form-label">Wifi</label>
                                    <select name="wifi_edit" id="wifi_edit" class="form-control">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Ya" {% if row[16] == "Ya" %}selected{% endif %}>Ya</option>
                                        <option value="Tidak" {% if row[16] == "Tidak" %}selected{% endif %}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Status PKH</label>
                                    <input type="text" id="statusAwal_edit" name="statusAwal_edit" class="form-control" placeholder="Masukan StatusPKH" value="{{ row[17] }}" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-primary" value="update">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {% endfor %}

        <!--  Hapus Modal -->
        {% for row in data %}
        <div class="modal fade" id="hapusModal{{ row[0] }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Hapus Data Penerima PKH</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ url_for('latih_delete_penerima_pkh') }}" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">ID Penerima</label>
                                    <input type="text" id="id_data_hapus" name="id_data_hapus" class="form-control" value="{{ row[0] }}" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Nama</label>
                                    <input type="text" id="hapus_penerima" name="hapus_penerima" class="form-control" value="{{ row[2] }}" />
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

        <!-- Modal Akurasi Train  -->
        <div class="modal fade" id="akurasiModal" tabindex="-1" role="dialog" aria-labelledby="akurasiModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="akurasiModalLabel">Simpan Model</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Akurasi Data Latih</label>
                                <input type="text" id="bobotTexttest" name="bobotTexttest" class="form-control" value="{{ session['akurasi_test'] }}" readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Akurasi Data UJI</label>
                                <input type="text" id="bobotTexttrain" name="bobotTexttrain" class="form-control" value="{{ session['akurasi_train'] }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button id="simpanButton" name="simpanButton" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

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
        $(document).ready(function() {
            $('#latih-data').click(function() {
                confirmLatihData();
            });
            setTimeout(function() {
                tampilkanAkurasiModal();
            }, 500);
        });
    </script>

    <script>
        function confirmLatihData() {
            if (confirm("Apakah anda ingin melakukan pelatihan pada seluruh data?")) {
                // Pesan ini akan muncul jika pengguna menekan tombol "OK" pada dialog konfirmasi
                window.location.href = "{{ url_for('latih_data') }}";

            } else {
                // Pesan ini akan muncul jika pengguna menekan tombol "Cancel" pada dialog konfirmasi
                console.log("Batal memuat halaman.");
            }
        }

        function confirmInformation() {
            if (confirm("Tampilkan informasi hasil pelatihan data?")) {
                // Pesan ini akan muncul jika pengguna menekan tombol "OK" pada dialog konfirmasi
                window.location.href = "{{ url_for('infolatihdata') }}";

            } else {
                // Pesan ini akan muncul jika pengguna menekan tombol "Cancel" pada dialog konfirmasi
                console.log("Batal memuat halaman.");
            }
        }

        // Fungsi untuk menampilkan modal
        function tampilkanAkurasiModal(bobot_test, bobot_train) {
            // Isi teks pesan dengan nilai akurasi
            var bobot_test_value = document.getElementById('bobotTexttest');
            var bobot_train_value = document.getElementById('bobotTexttrain');
            bobot_test_value.innerText = bobot_test
            bobot_train_value.innerText = bobot_train

            // Tampilkan modal
            $('#akurasiModal').modal("show");

            document.getElementById('simpanButton').addEventListener('click', function() {
                // Kirim hasil model ke server
                $.ajax({
                    type: "POST",
                    url: "/simpan_model",
                    contentType: "application/json;charset=UTF-8",
                    success: function(response) {
                        alert(response.message); // Tampilkan pesan dari server
                    },
                    error: function(error) {
                        console.log(error);
                        alert(error.message);
                    },
                    complete: function() {
                        $('#akurasiModal').modal("hide");
                    }
                });
            });
        }
    </script>

    <script>
        $('#editModal').appendTo("body")
        $('#hapusModal').appendTo("body")
    </script>

    <script type="text/javascript">
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var idPenerima = button.data('id_penerima_edit')
            var nama = button.data('nama_edit')
            var alamat = button.data('alamat_edit')
            var stsLahan = button.data('sts_lahan_edit')
            var stsBangunan = button.data('sts_bangunan_edit')
            var jnsLantai = button.data('jns_lantai_edit')
            var jnsDinding = button.data('jns_dinding_edit')
            var jnsAtap = button.data('jns_atap_edit')
            var smrAir = button.data('smr_air_edit')
            var smrPenerangan = button.data('smr_penerangan_edit')
            var bbMemasak = button.data('bb_memasak_edit')
            var jnsKloset = button.data('jns_kloset_edit')
            var jnsKendaraan = button.data('jns_kendaraan_edit')
            var asetPribadi = button.data('aset_pribadi_edit')
            var tlpnRumah = button.data('tlpn_rumah_edit')
            var wifi = button.data('wifi_edit')
            var statusAwal = button.data('statusAwal_edit')

            var modal = $(this)
            modal.find('.modal-title').text('Edit Data' + idPenerima)
            modal.find('.modal-body #id_penerima_edit').val(idPenerima)
            modal.find('.modal-body #nama_edit').val(nama)
            modal.find('.modal-body #alamat_edit').val(alamat)
            modal.find('.modal-body #sts_lahan_edit').val(stsLahan)
            modal.find('.modal-body #sts_bangunan_edit').val(stsBangunan)
            modal.find('.modal-body #jns_lantai_edit').val(jnsLantai)
            modal.find('.modal-body #jns_dinding_edit').val(jnsDinding)
            modal.find('.modal-body #jns_atap_edit').val(jnsAtap)
            modal.find('.modal-body #smr_air_edit').val(smrAir)
            modal.find('.modal-body #smr_penerangan_edit').val(smrPenerangan)
            modal.find('.modal-body #bb_memasak_edit').val(bbMemasak)
            modal.find('.modal-body #jns_kloset_edit').val(jnsKloset)
            modal.find('.modal-body #jns_kendaraan_edit').val(jnsKendaraan)
            modal.find('.modal-body #aset_pribadi_edit').val(asetPribadi)
            modal.find('.modal-body #tlpn_rumah_edit').val(tlpnRumah)
            modal.find('.modal-body #wifi_edit').val(wifi)
            modal.find('.modal-body #statusAwal_edit').val(statusAwal)
        })

        $('#hapusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var idPenerima = button.data('id_data_hapus')
            var Nama = button.data('hapus_penerima')

            var modal = $(this)
            modal.find('.modal-title').text('Hapus Data' + idPenerima)
            modal.find('.modal-body #id_data_hapus').val(idPenerima)
            modal.find('.modal-body #hapus_penerima').val(Nama)
        })
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../static/assets/js/material-dashboard.min.js?v=3.0.5"></script>
</body>

</html>