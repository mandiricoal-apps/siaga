<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Permintaan Pesanan</li>
            </ol>
            <h4 class="font-weight-bolder text-white mb-0 mt-3">Permintaan Pesanan</h4>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-istems-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign In</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/small-logos/logo-spotify.svg"
                                            class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
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
<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Pesanan Yang Harus Dikonfirmasi</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Departemen XXYY</h6>
                                <span class="mb-2 text-xs">Jenis Menu: <span
                                        class="text-dark font-weight-bold ms-sm-2">Menu Spesial</span></span>
                                <span class="mb-2 text-xs">Jumlah Pesanan: <span
                                        class="text-dark ms-sm-2 font-weight-bold">20</span></span>
                                <span class="text-xs">Tanggal Pesanan: <span
                                        class="text-dark ms-sm-2 font-weight-bold">24/09/2023</span></span>
                            </div>
                            <div class="ms-auto text-end mt-4 mr-5">
                                <a href="javascript:;" class="text-secondary text-lg" data-toggle="tooltip"
                                    data-original-title="Detail">
                                    <span class="badge badge-md bg-gradient-info"><i
                                            class="fa-solid fa-eye"></i></span>
                                </a>
                                <a href="/catering/data-snack/ubah" class="text-secondary text-lg"
                                    data-toggle="tooltip" data-original-title="Edit">
                                    <span class="badge badge-md bg-gradient-success"><i
                                            class="fa-solid fa-check"></i><span>
                                </a>
                                <a href="javascript:;" class="text-secondary text-lg" data-toggle="tooltip"
                                    data-original-title="Hapus">
                                    <span class="badge badge-md bg-gradient-danger"><i
                                            class="fa-solid fa-xmark"></i></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Departemen XXYY</h6>
                                <span class="mb-2 text-xs">Jenis Menu: <span
                                        class="text-dark font-weight-bold ms-sm-2">Menu Spesial</span></span>
                                <span class="mb-2 text-xs">Jumlah Pesanan: <span
                                        class="text-dark ms-sm-2 font-weight-bold">20</span></span>
                                <span class="text-xs">Tanggal Pesanan: <span
                                        class="text-dark ms-sm-2 font-weight-bold">24/09/2023</span></span>
                            </div>
                            <div class="ms-auto text-end mt-4 mr-5">
                                <a href="javascript:;" class="text-secondary text-lg" data-toggle="tooltip"
                                    data-original-title="Detail">
                                    <span class="badge badge-md bg-gradient-info"><i
                                            class="fa-solid fa-eye"></i></span>
                                </a>
                                <a href="/catering/data-snack/ubah" class="text-secondary text-lg"
                                    data-toggle="tooltip" data-original-title="Edit">
                                    <span class="badge badge-md bg-gradient-success"><i
                                            class="fa-solid fa-check"></i><span>
                                </a>
                                <a href="javascript:;" class="text-secondary text-lg" data-toggle="tooltip"
                                    data-original-title="Hapus">
                                    <span class="badge badge-md bg-gradient-danger"><i
                                            class="fa-solid fa-xmark"></i></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Riwayat Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="per">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Menu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Menu</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Pemesan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pemesanan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pesanan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success" style="width: 90%; height: 100%;">Selesai</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                            <a href="#" class="text-secondary text-s"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <span class="badge badge-md bg-gradient-danger"><i
                                                        class="fa-solid fa-xmark"></i></span>
                                            </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-primary" style="width: 90%; height: 100%;">Diproses</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                            <a href="#" class="text-secondary text-s"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <span class="badge badge-md bg-gradient-danger"><i
                                                        class="fa-solid fa-xmark"></i></span>
                                            </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-warning" style="width: 90%; height: 100%;">Menunggu</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                            <a href="#" class="text-secondary text-s"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <span class="badge badge-md bg-gradient-danger"><i
                                                        class="fa-solid fa-xmark"></i></span>
                                            </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger" style="width: 90%; height: 100%;">Ditolak</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                            <a href="#" class="text-secondary text-s"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <span class="badge badge-md bg-gradient-danger"><i
                                                        class="fa-solid fa-xmark"></i></span>
                                            </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#per').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ Data per halaman",
                "zeroRecords": "Maaf, tidak dapat menemukan apapun",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang dapat ditampilkan",
                "infoFiltered": "(dari _MAX_ total data)",
                "search": "Cari :",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "",
                    "previous": ""
                },
            }
        });
    });
</script>

