@php
    use Illuminate\Support\Facades\Auth;
@endphp
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
    /* Mengubah warna teks di pagination */
    .pagination .page-item .page-link {
        color: black;
        /* Ganti dengan warna yang Anda inginkan */
    }

    /* Mengubah warna teks pada tombol aktif di pagination */
    .pagination .page-item.active .page-link {
        background-color: #7b5e50;
        border-color: #7b5e50;
        color: white;
        /* Ganti dengan warna yang Anda inginkan */
    }

    .nav-pills .nav-link.active {
        background-color: #7b5e50 !important;
        /* Warna latar belakang */
        color: white;
        /* Warna teks */
    }

    /* Merubah warna teks pada selector yang tidak aktif */
    .nav-pills .nav-link {
        color: black;
        /* Warna teks default */
    }
</style>

<div class="container-fluid py-4 mt-3">
    @if (session('error'))
        <script>
            // Tampilkan pesan error dalam pop-up
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berhasil',
                text: '{{ session('error') }}', // Ambil pesan error dari session
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            // Tampilkan pesan error dalam pop-up
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}', // Ambil pesan error dari session
            });
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-12 mb-2">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#jadwal-snacks"
                            role="tab" aria-controls="snacks" aria-selected="true">
                            Data Snack
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#jadwal-menus" role="tab"
                            aria-controls="menus" aria-selected="false">
                            Data Menu Spesial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#jadwal-menur" role="tab"
                            aria-controls="menur" aria-selected="false">
                            Data Menu Reguler
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="jadwal-snacks" role="tabpanel"aria-labelledby="snacks">
                        <div class="row justify-content-center mt-4">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Table Snack</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('export.snack', request()->query()) }}" method="GET"
                                            id="filter-snack">
                                            {{-- <p for="example-text-input" class="text-md text-center">Filter Data Taping</p> --}}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span class="text-xxs"
                                                                style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Awal</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="minSnack"
                                                            name="minSnack" required>
                                                        @if ($errors->has('minSnack'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('minSnack') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span class="text-xxs"
                                                                style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Akhir</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="maxSnack"
                                                            name="maxSnack" required>
                                                        @if ($errors->has('maxSnack'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('maxSnack') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="example-text-input"
                                                        class="form-control-label dateselect col-12"></label>
                                                    <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                                        onclick="dataSnack()">
                                                        <i class="text-sm fa-solid fa-file-excel"
                                                            style="margin-right: 10px"></i>Export to Excel</a>
                                                    <script>
                                                        // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                        function dataSnack() {
                                                            document.getElementById('filter-snack').submit();
                                                        }
                                                    </script>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="snack">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Snack</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Tanggal Berlaku</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Shift</th>
                                                        {{-- <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th> --}}
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Aksi
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($snack as $msnack)
                                                        <tr>
                                                            <td class="align-middle text-center">
                                                                @php
                                                                    $makanan = json_decode($msnack->nama_makanan);
                                                                @endphp
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    @for ($i = 0; $i < count($makanan); $i++)
                                                                        <span class="text-muted">
                                                                            {{ $makanan[$i] }}
                                                                        </span>
                                                                        @if ($i < count($makanan) - 1)
                                                                            |
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                @php
                                                                    $dates = $msnack->tanggal_berlaku;
                                                                    $timestamp = strtotime($dates);
                                                                    $date = date('d F Y', $timestamp);
                                                                @endphp
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $date }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $msnack->shift }}</span>
                                                            </td>
                                                            {{-- <td class="align-middle text-center text-sm">
                                                                @if ($tgl_berlaku < $msnack->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-warning"
                                                                        style="width: 70%; height: 100%;">Soon</span>
                                                                @endif
                                                                @if ($tgl_berlaku == $msnack->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-success"
                                                                        style="width: 70%; height: 100%;">Available</span>
                                                                @endif
                                                                @if ($tgl_berlaku > $msnack->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-danger"
                                                                        style="width: 70%; height: 100%;">Expired</span>
                                                                @endif

                                                            </td> --}}

                                                            <td class="align-middle text-center">
                                                                <a type="button"
                                                                    class="fa-solid fa-eye text-s badge badge-md text-dark"
                                                                    data-toggle="tooltip" data-original-title="Detail"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal{{ $msnack->id }}"
                                                                    style="border: solid 1px">
                                                                    @if (Auth::user()->id_role == 2)
                                                                        <a href="/data-snack/ubah/{{ $msnack->id }}"
                                                                            class="btn text-dark badge badge-md fa-solid fa-square-pen"
                                                                            data-toggle="tooltip"
                                                                            data-original-title="Edit"
                                                                            style="border: solid 1px;margin-left:5%">
                                                                        </a>
                                                                    @endif
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="exampleModal{{ $msnack->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content m-5">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"
                                                                            id="exampleModalLabel">Detail
                                                                            Snack</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg  text-dark">
                                                                                Tanggal
                                                                                Berlaku</p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @php
                                                                                    $tgl = $msnack->tanggal_berlaku;
                                                                                    $timestamp = strtotime($tgl);
                                                                                    $formattedDate = date('d F Y', $timestamp);
                                                                                @endphp
                                                                                {{ $formattedDate }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Waktu Pesanan
                                                                            </p>
                                                                            @if ($msnack->shift == 'Pagi')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    07.00 - 12.00 WIB </p>
                                                                            @endif
                                                                            @if ($msnack->shift == 'Siang')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    12.00 - 17.00 WIB </p>
                                                                            @endif
                                                                            @if ($msnack->shift == 'Malam')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    17.00 - 20.00 WIB </p>
                                                                            @endif
                                                                        </div>
                                                                        @php
                                                                            $makanan = json_decode($msnack->nama_makanan, true);
                                                                            $no = 1;
                                                                        @endphp
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Snack Tersedia
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @foreach ($makanan as $item)
                                                                                    {{ $no++ }}.
                                                                                    {{ $item }} <br>
                                                                                @endforeach
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="jadwal-menus" role="tabpanel"aria-labelledby="menus">
                        <div class="row justify-content-center mt-4">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Tabel Menu Spesial</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('export.menuspesial', request()->query()) }}"
                                            method="GET" id="filter-menus">
                                            {{-- <p for="example-text-input" class="text-md text-center">Filter Data Taping</p> --}}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span
                                                                class="text-xxs" style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Awal</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="minMenus"
                                                            name="minMenus" required>
                                                        @if ($errors->has('minMenus'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('minMenus') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span
                                                                class="text-xxs" style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Akhir</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="maxMenus"
                                                            name="maxMenus" required>
                                                        @if ($errors->has('maxMenus'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('maxMenus') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="example-text-input"
                                                        class="form-control-label dateselect col-12"></label>
                                                    <a class="btn btn-sm ms-auto bg-dark text-white mt-2"
                                                        type="button" onclick="dataMenus()">
                                                        <i class="text-sm fa-solid fa-file-excel"
                                                            style="margin-right: 10px"></i>Export to Excel</a>
                                                    <script>
                                                        // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                        function dataMenus() {
                                                            document.getElementById('filter-menus').submit();
                                                        }
                                                    </script>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="menus">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Menu Spesial 1,5 Main Course</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Menu Spesial 2,5 Main Course</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Tanggal Berlaku</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Shift</th>
                                                        {{-- <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th> --}}
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Aksi
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($menus as $menu)
                                                        @php
                                                            $makanan = json_decode($menu->nama_makanan);
                                                        @endphp
                                                        <tr>
                                                            <td class="align-middle text-center">

                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $makanan[0] }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">

                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $makanan[1] }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                @php
                                                                    $dates = $menu->tanggal_berlaku;
                                                                    $timestamp = strtotime($dates);
                                                                    $date = date('d F Y', $timestamp);
                                                                @endphp
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $date }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $menu->shift }}</span>
                                                            </td>
                                                            {{-- <td class="align-middle text-center text-sm">
                                                                @if ($tgl_berlaku < $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-warning"
                                                                        style="width: 100%; height: 100%;">Soon</span>
                                                                @endif
                                                                @if ($tgl_berlaku == $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-success"
                                                                        style="width: 100%; height: 100%;">Available</span>
                                                                @endif
                                                                @if ($tgl_berlaku > $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-danger"
                                                                        style="width: 100%; height: 100%;">Expired</span>
                                                                @endif
                                                            </td> --}}

                                                            <td class="align-middle text-center">
                                                                <a type="button"
                                                                    class="btn fa-solid fa-eye text-s badge badge-md text-dark"
                                                                    data-toggle="tooltip" data-original-title="Detail"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal{{ $menu->id }}"
                                                                    style="border: solid 1px">
                                                                </a>

                                                                @if (Auth::user()->id_role == 2)
                                                                    <a href="/data-menu-spesial/ubah/{{ $menu->id }}"
                                                                        class="btn fa-solid badge badge-md fa-square-pen text-dark"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="Edit"
                                                                        style="border: solid 1px">
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="exampleModal{{ $menu->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content m-5">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"
                                                                            id="exampleModalLabel">Detail
                                                                            Menu</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg  text-dark">
                                                                                Tanggal
                                                                                Berlaku</p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @php
                                                                                    $tgl = $menu->tanggal_berlaku;
                                                                                    $timestamp = strtotime($tgl);
                                                                                    $formattedDate = date('d F Y', $timestamp);
                                                                                @endphp
                                                                                {{ $formattedDate }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Waktu Pesanan
                                                                            </p>
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    07.00 - 12.00 WIB </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    12.00 - 17.00 WIB </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    17.00 - 20.00 WIB </p>
                                                                            @endif
                                                                        </div>
                                                                        @php
                                                                            $makanan = json_decode($menu->nama_makanan, true);
                                                                            $no = 1;
                                                                        @endphp
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Menu Tersedia
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md fw-bold">
                                                                                {{ $no }}. Menu
                                                                                Spesial 1,5 main course
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md"
                                                                                style="margin-left: 5%">
                                                                                {{ $makanan[0] }}
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md fw-bold">
                                                                                {{ $no + 1 }}. Menu
                                                                                Spesial 2,5 main course
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md"
                                                                                style="margin-left: 5%">
                                                                                {{ $makanan[1] }}
                                                                            </p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>s
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="jadwal-menur" role="tabpanel"aria-labelledby="menur">
                        <div class="row justify-content-center mt-4">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Tabel Menu Spesial</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('export.menureguler', request()->query()) }}"
                                            method="GET" id="filter-menur">
                                            {{-- <p for="example-text-input" class="text-md text-center">Filter Data Taping</p> --}}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span
                                                                class="text-xxs" style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Awal</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="minMenur"
                                                            name="minMenur" required>
                                                        @if ($errors->has('minMenur'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('minMenur') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label dateselect"><span
                                                                class="text-xxs" style="vertical-align: top;"><i
                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                            Akhir</label>
                                                        <input class="form-control bg-white" type="date"
                                                            placeholder="yyyy-mm-dd" id="maxMenur"
                                                            name="maxMenur" required>
                                                        @if ($errors->has('maxMenur'))
                                                            <span
                                                                class="text-danger text-xs">{{ $errors->first('maxMenur') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="example-text-input"
                                                        class="form-control-label dateselect col-12"></label>
                                                    <a class="btn btn-sm ms-auto bg-dark text-white mt-2"
                                                        type="button" onclick="dataMenur()">
                                                        <i class="text-sm fa-solid fa-file-excel"
                                                            style="margin-right: 10px"></i>Export to Excel</a>
                                                    <script>
                                                        // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                        function dataMenur() {
                                                            document.getElementById('filter-menur').submit();
                                                        }
                                                    </script>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="menur">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Menu Reguler</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Tanggal Berlaku</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Shift</th>
                                                        {{-- <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status
                                                        </th> --}}
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Aksi
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($menur as $menu)
                                                        <tr>
                                                            <td class="align-middle text-center">
                                                                @php
                                                                    $makanan = json_decode($menu->nama_makanan);
                                                                @endphp
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    @for ($i = 0; $i < count($makanan); $i++)
                                                                        <span class="text-muted">
                                                                            {{ $makanan[$i] }}
                                                                        </span>
                                                                        @if ($i < count($makanan) - 1)
                                                                            |
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                @php
                                                                    $dates = $menu->tanggal_berlaku;
                                                                    $timestamp = strtotime($dates);
                                                                    $date = date('d F Y', $timestamp);
                                                                @endphp
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $date }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span
                                                                    class="text-secondary text-xs font-weight-bold">{{ $menu->shift }}</span>
                                                            </td>
                                                            {{-- <td class="align-middle text-center text-sm">
                                                                @if ($tgl_berlaku < $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-warning"
                                                                        style="width: 70%; height: 100%;">Soon</span>
                                                                @endif
                                                                @if ($tgl_berlaku == $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-success"
                                                                        style="width: 70%; height: 100%;">Available</span>
                                                                @endif
                                                                @if ($tgl_berlaku > $menu->tanggal_berlaku)
                                                                    <span class="badge badge-sm bg-gradient-danger"









                                                                        style="width: 70%; height: 100%;">Expired</span>
                                                                @endif
                                                            </td> --}}

                                                            <td class="align-middle text-center">
                                                                <a type="button"
                                                                    class="btn fa-solid text-dark fa-eye text-s badge badge-md"
                                                                    data-toggle="tooltip" data-original-title="Detail"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal{{ $menu->id }}"
                                                                    style="border: solid 1px">
                                                                </a>
                                                                @if (Auth::user()->id_role == 2)
                                                                    <a href="/data-menu-reguler/ubah/{{ $menu->id }}"
                                                                        class="fa-solid fa-square-pen text-dark badge badge-md"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="Edit"
                                                                        style="border: solid 1px">
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="exampleModal{{ $menu->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content m-5">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"
                                                                            id="exampleModalLabel">Detail
                                                                            Menu</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @php
                                                                            $makanan = json_decode($menu->nama_makanan, true);
                                                                            $no = 1;
                                                                        @endphp
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg  text-dark">
                                                                                Tanggal
                                                                                Berlaku</p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @php
                                                                                    $tgl = $menu->tanggal_berlaku;
                                                                                    $timestamp = strtotime($tgl);
                                                                                    $formattedDate = date('d F Y', $timestamp);
                                                                                @endphp
                                                                                {{ $formattedDate }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Waktu Pesanan
                                                                            </p>
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    07.00 - 12.00 WIB </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    12.00 - 17.00 WIB </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    17.00 - 20.00 WIB </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Menu Tersedia
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @foreach ($makanan as $item)
                                                                                    {{ $no++ }}.
                                                                                    {{ $item }} <br>
                                                                                @endforeach
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn bg-gradient-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#minSnack, #maxSnack,#minMenus,#maxMenus,#minMenur,#maxMenur").flatpickr({
            dateFormat: "Y-m-d"
        });
        var tableMenus = $('#menus').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
            "order": [
                [2, "desc"]
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

        var tableMenur = $('#menur').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
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

        var tableSnack = $('#snack').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
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

        $('#minSnack, #maxSnack').on('change', function() {
            var minSnack = new Date($('#minSnack').val());
            minSnack.setDate(minSnack.getDate() - 1);
            var maxSnack = $('#maxSnack').val();

            console.log(minSnack, maxSnack);

            tableSnack.columns(1).search('')
                .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

            $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var currentDate = new Date(data[
                        1]); // Mengambil nilai tanggal pada kolom keenam (indeks 5)
                    var selectedDate = new Date(minSnack);
                    if (isNaN(selectedDate.getTime()))
                        return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                    if (minSnack && !maxSnack) {
                        return currentDate >= selectedDate;
                    } else if (!minSnack && maxSnack) {
                        return currentDate <= new Date(maxSnack);
                    } else {
                        var endDate = new Date(maxSnack);
                        endDate.setDate(endDate.getDate());
                        return currentDate > selectedDate && currentDate <= endDate;
                    }
                }
            );

            tableSnack.draw();
        });

        $('#minSnack, #maxSnack').on('keyup', function() {
            if ($('#minSnack').val() === '' && $('#maxSnack').val() === '') {
                tableSnack.columns(5).search('').draw();
            }
        });

        $('#minMenus, #maxMenus').on('change', function() {
            var minMenus = new Date($('#minMenus').val());
            minMenus.setDate(minMenus.getDate() - 1);
            var maxMenus = $('#maxMenus').val();

            console.log(minMenus, maxMenus);

            tableMenus.columns(2).search('')
                .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

            $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var currentDate = new Date(data[
                        2]); // Mengambil nilai tanggal pada kolom keenam (indeks 5)
                    var selectedDate = new Date(minMenus);
                    if (isNaN(selectedDate.getTime()))
                        return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                    if (minMenus && !maxMenus) {
                        return currentDate >= selectedDate;
                    } else if (!minMenus && maxMenus) {
                        return currentDate <= new Date(maxMenus);
                    } else {
                        var endDate = new Date(maxMenus);
                        endDate.setDate(endDate.getDate());
                        return currentDate > selectedDate && currentDate <= endDate;
                    }
                }
            );

            tableMenus.draw();
        });

        $('#minMenus, #maxMenus').on('keyup', function() {
            if ($('#minMenus').val() === '' && $('#maxMenus').val() === '') {
                tableMenus.columns(5).search('').draw();
            }
        });

        $('#minMenur, #maxMenur').on('change', function() {
            var minMenur = new Date($('#minMenur').val());
            minMenur.setDate(minMenur.getDate() - 1);
            var maxMenur = $('#maxMenur').val();

            console.log(minMenur, maxMenur);

            tableMenur.columns(1).search('')
                .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

            $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var currentDate = new Date(data[
                        1]); // Mengambil nilai tanggal pada kolom keenam (indeks 5)
                    var selectedDate = new Date(minMenur);
                    if (isNaN(selectedDate.getTime()))
                        return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                    if (minMenur && !maxMenur) {
                        return currentDate >= selectedDate;
                    } else if (!minMenur && maxMenur) {
                        return currentDate <= new Date(maxMenur);
                    } else {
                        var endDate = new Date(maxMenur);
                        endDate.setDate(endDate.getDate());
                        return currentDate > selectedDate && currentDate <= endDate;
                    }
                }
            );

            tableMenur.draw();
        });

        $('#minMenur, #maxMenur').on('keyup', function() {
            if ($('#minMenur').val() === '' && $('#maxMenur').val() === '') {
                tableMenur.columns(5).search('').draw();
            }
        });
    });
</script>
