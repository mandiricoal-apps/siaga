@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Menu;
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

<!-- Add the SweetAlert2 stylesheet link in the head section of your HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

<!-- Add the SweetAlert2 script link at the end of the body section of your HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
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

@if(Auth::user()->id_role == 4)
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#riwayat" role="tab"
                            aria-controls="snacks" aria-selected="true">
                            Riwayat Permintaan Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pesData" role="tab"
                            aria-controls="menus" aria-selected="false">
                            Data Pesanan
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="riwayat" role="tabpanel"aria-labelledby="snacks">
                        <div class="card mb-4 mt-5">
                            <div class="card-header pb-0">
                                <h6>Riwayat Permintaan Pesanan</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('export.datamakan', request()->query()) }}" method="GET"
                                    id="filter-taping">
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
                                                    placeholder="yyyy-mm-dd" id="minRiwayat" name="minRiwayat" required>
                                                @if ($errors->has('minRiwayat '))
                                                    <span
                                                        class="text-danger text-xs">{{ $errors->first('minRiwayat') }}</span>
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
                                                    placeholder="yyyy-mm-dd" id="maxRiwayat" name="maxRiwayat" required>
                                                @if ($errors->has('maxRiwayat'))
                                                    <span
                                                        class="text-danger text-xs">{{ $errors->first('maxRiwayat') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                            <label for="example-text-input"
                                                class="form-control-label dateselect col-12"></label>
                                            <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                                onclick="dataExport()">
                                                <i class="text-sm fa-solid fa-file-excel"
                                                    style="margin-right: 10px"></i>Export to
                                                Excel</a>
                                            <script>
                                                // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                function dataExport() {
                                                    document.getElementById('filter-taping').submit();
                                                }
                                            </script>
                                        </div> --}}
                                        <script>
                                            $("#minRiwayat, #maxRiwayat").flatpickr({
                                                dateFormat: "Y-m-d"
                                            });
                                        </script>
                                    </div>
                                </form>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0" id="permintaan_pes">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Jenis Menu</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Jumlah Porsi</th>
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
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($req as $order)
                                                @php
                                                    $detail_menu = json_decode($order->makanan, true);
                                                    $detail_porsi = json_decode($order->jumlah_pesanan, true);
                                                    $total_porsi = array_sum($detail_porsi);
                                                    $tglPesanan = json_decode($order->tanggal_pesanan, true);
                                                    $tglAwl = \Carbon\Carbon::parse($tglPesanan[0]);
                                                    $tglSekarang = Carbon\Carbon::now();
                                                @endphp
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $order->jenis_pesanan }}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $total_porsi }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $order->name }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $tglPesanan[0] }}
                                                            <b class="text-dark text-lg"> - </b>
                                                            {{ $tglPesanan[1] }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        @if ($order->status == 'Selesai')
                                                            <span class="badge badge-sm bg-gradient-success"
                                                                style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'Menunggu')
                                                            <span class="badge badge-sm bg-gradient-warning"
                                                                style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'Diproses')
                                                            <span class="badge badge-sm bg-gradient-info"
                                                                style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                            <span class="badge badge-sm bg-gradient-danger"
                                                                style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a type="button"
                                                            class="fa-solid fa-eye text-dark badge badge-md"
                                                            data-toggle="tooltip" data-original-title="Detail"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#detailPermintaan{{ $order->order_id }}"
                                                            style="border: solid 1px">
                                                        </a>
                                                        @if ($order->status != 'Menunggu' || $tglAwl->lessThanOrEqualTo($tglSekarang))
                                                            <button href="/proses-setuju/{{ $order->id }}"
                                                                class="text-dark badge badge-md bg-secondary"
                                                                data-toggle="tooltip" data-original-title="Edit"
                                                                style="border: solid 1px" disabled>
                                                                <span class=""><i
                                                                        class="fa-solid fa-check text-white"></i><span>
                                                            </button>
                                                            <button type="button"
                                                                class="text-dark badge badge-md bg-secondary"
                                                                data-toggle="tooltip" data-original-title="Hapus"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#cancelPesanan{{ $order->id }}"
                                                                style="border: solid 1px" disabled>
                                                                <span class=""><i
                                                                        class="fa-solid fa-xmark text-white"></i></span>
                                                            </button>
                                                        @else
                                                            <a href="/proses-setuju/{{ $order->id }}"
                                                                class="text-dark badge badge-md" data-toggle="tooltip"
                                                                data-original-title="Edit" style="border: solid 1px">
                                                                <span class=""><i
                                                                        class="fa-solid fa-check text-dark"></i><span>
                                                            </a>
                                                            <a type="button" class="text-dark badge badge-md "
                                                                data-toggle="tooltip" data-original-title="Hapus"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#cancelPesanan{{ $order->id }}"
                                                                style="border: solid 1px">
                                                                <span class=""><i
                                                                        class="fa-solid fa-xmark text-dark"></i></span>
                                                            </a>
                                                        @endif

                                                    </td>
                                                </tr>
                                                <div class="modal fade modal-xl "
                                                    id="detailPermintaan{{ $order->order_id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content m-5">
                                                            <div class="d-flex modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">Detail
                                                                    Pesanan</h4>

                                                                {{-- @if ($user->status == 'Aktif')
                                                                    <p class="badge badge-sm text-xxs bg-gradient-success m-1"
                                                                        style="width: 30%; height: 100%;">
                                                                        {{ $user->status }}</p>
                                                                @else
                                                                    <p class="badge badge-sm text-xxs bg-gradient-danger"
                                                                        style="width: 30%; height: 100%;">
                                                                        {{ $user->status }}</p>
                                                                @endif --}}
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex row">
                                                                    <div class="col md 6">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Status
                                                                                Pesanan
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @if ($order->status == 'Selesai')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                                                                @endif
                                                                                @if ($order->status == 'Menunggu')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                                                                @endif
                                                                                @if ($order->status == 'Diproses')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-info">{{ $order->status }}</span>
                                                                                @endif
                                                                                @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                                                    <span
                                                                                        class="badge badge-sm bg-gradient-danger">{{ $order->status }}</span>
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Nama Pemesan
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $order->name }}
                                                                            </p>

                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg  text-dark">
                                                                                Jenis Menu
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $order->jenis_pesanan }}
                                                                            </p>
                                                                        </div>
                                                                        @php

                                                                            $kirim = json_decode($order->tanggal_pesanan, true);
                                                                            foreach ($kirim as $tglPess) {
                                                                                $tgl[] = \Carbon\Carbon::parse($tglPess);
                                                                            }
                                                                            $waktu = \Carbon\Carbon::parse($order->waktu_pesanan);
                                                                            $num = 1;
                                                                        @endphp

                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Tanggal
                                                                                Pemesanan</p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $order->created_at->isoFormat('DD MMMM Y') }}
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Tanggal
                                                                                Pengiriman
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $tgl[0]->isoFormat('DD MMM Y') }} -
                                                                                {{ $tgl[1]->isoFormat('DD MMM Y') }}
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Jam
                                                                                Pengiriman
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $waktu->format('h:i A') }}
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Lokasi
                                                                                Pengantaran
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $order->lokasi_pengantaran }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Nama Peserta
                                                                            </p>
                                                                            @php
                                                                                $data_peserta = explode(',', $order->detail_karyawan);
                                                                            @endphp

                                                                            @foreach ($data_peserta as $item)
                                                                                {{ $item }} <br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" style="margin-left: 5%">
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark">
                                                                                Menu Makanan
                                                                            </p>
                                                                            <div
                                                                                style="max-height: 300px; overflow-y: auto;">
                                                                                @if ($order->jenis_pesanan == 'Menu Spesial')
                                                                                    @php
                                                                                        $menu = json_decode($order->id_menu, true);
                                                                                        $menus = Menu::whereIn('id', $menu)
                                                                                            ->orderBy('tanggal_berlaku', 'asc')
                                                                                            ->get();
                                                                                        $k = 0;
                                                                                        $i = 0;

                                                                                    @endphp
                                                                                    @foreach ($menus as $namaMenu)
                                                                                        @php
                                                                                            $indeksMenu = 0;
                                                                                            $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                            $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                        @endphp
                                                                                        <b
                                                                                            class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                        <br>

                                                                                        <span class="text-muted"
                                                                                            style="margin-bottom: 7%">
                                                                                            <p class="text-sm"
                                                                                                style="margin-bottom: auto">
                                                                                                1,5
                                                                                                Main Course</p>
                                                                                            <b
                                                                                                class="">{{ $nmakanan[0] }}</b>
                                                                                            :
                                                                                            <b
                                                                                                class="">{{ $detail_porsi[$i] }}</b>
                                                                                            porsi
                                                                                            <br>
                                                                                            @php
                                                                                                $k++;
                                                                                                $i++;
                                                                                            @endphp
                                                                                            <p class="text-sm"
                                                                                                style="margin-bottom: auto">
                                                                                                2,5
                                                                                                Main Course</p>
                                                                                            <b
                                                                                                class="">{{ $nmakanan[1] }}</b>
                                                                                            :
                                                                                            <b
                                                                                                class="">{{ $detail_porsi[$i] }}</b>
                                                                                            porsi
                                                                                            <br>
                                                                                            @php
                                                                                                $k++;
                                                                                                $i++;
                                                                                            @endphp
                                                                                        </span>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if ($order->jenis_pesanan == 'Snack')
                                                                                    @php
                                                                                        $menu = json_decode($order->id_menu, true);
                                                                                        $menus = Menu::whereIn('id', $menu)->get();
                                                                                        $k = 0;
                                                                                        $i = 0;
                                                                                    @endphp

                                                                                    @foreach ($menus as $namaMenu)
                                                                                        @php
                                                                                            $indeksMenu = 0;
                                                                                            $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                            $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                        @endphp
                                                                                        <b
                                                                                            class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                        <br>
                                                                                        @foreach ($nmakanan as $nm)
                                                                                            <span
                                                                                                class="text-muted mb-5">
                                                                                                <b
                                                                                                    class="text-dark">{{ $nm }}</b>
                                                                                                :
                                                                                                <b
                                                                                                    class="text-dark">{{ $detail_porsi[$i] }}</b>
                                                                                                porsi
                                                                                            </span>
                                                                                            @if (count($detail_porsi) == 1)
                                                                                            @else
                                                                                                @if ($i < count($detail_porsi) - 1)
                                                                                                    <br>
                                                                                                @else
                                                                                                @endif
                                                                                            @endif
                                                                                            @php
                                                                                                $k++;
                                                                                                $i++;
                                                                                            @endphp
                                                                                        @endforeach
                                                                                        <br>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if ($order->jenis_pesanan == 'Others')
                                                                                    @php
                                                                                        $kirim = json_decode($order->tanggal_pesanan, true);
                                                                                        $tanggalAwal = new DateTime($kirim[0]);
                                                                                        $tanggalAkhir = new DateTime($kirim[1]);

                                                                                        $tanggalAkhir->modify('+1 day');

                                                                                        $interval = new DateInterval('P1D'); // Interval 1 hari
                                                                                        $daterange = new DatePeriod($tanggalAwal, $interval, $tanggalAkhir);
                                                                                        $k = 0;
                                                                                        $i = 0;
                                                                                        $namaMakanan = json_decode($order->makanan, true);
                                                                                    @endphp

                                                                                    @foreach ($daterange as $tglPes)
                                                                                        @php
                                                                                            $indeksMenu = 0;
                                                                                            $tanggalPes = $tglPes->format('Y-m-d');
                                                                                            $pesanDate = \Carbon\Carbon::parse($tanggalPes);
                                                                                            // $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                            // $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                        @endphp
                                                                                        <b
                                                                                            class="text-dark">{{ $pesanDate->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                        <br>
                                                                                        <span class="text-muted mb-5">
                                                                                            <b
                                                                                                class="text-dark">{{ $namaMakanan[$i] }}</b>
                                                                                            :
                                                                                            <b
                                                                                                class="text-dark">{{ $detail_porsi[$k] }}</b>
                                                                                            porsi
                                                                                        </span>
                                                                                        @if (count($detail_porsi) == 1)
                                                                                        @else
                                                                                            @if ($k < count($detail_porsi) - 1)
                                                                                                <br>
                                                                                            @else
                                                                                            @endif
                                                                                        @endif
                                                                                        @php
                                                                                            $k++;
                                                                                            $i++;
                                                                                        @endphp
                                                                                        <br>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="horizontal dark">
                                                                    <div class="col-md-4">
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark ">
                                                                                Alasan
                                                                                Pemesanan
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                {{ $order->alasan_pemesanan }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="justify-content-between mb-3">
                                                                            <p class="fw-bold mb-0 text-lg text-dark ">
                                                                                Catatan
                                                                                Pemesanan
                                                                            </p>
                                                                            <p class="text-muted mb-0 text-md">
                                                                                @if ($order->catatan == null)
                                                                                    <div class="text-sm text-danger"
                                                                                        style="font-style: italic">
                                                                                        Kosong
                                                                                    </div>
                                                                                @else
                                                                                    {{ $order->catatan }}
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    @if ($order->status == 'Dibatalkan')
                                                                        <div class="col-md-4">
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark ">
                                                                                    Alasan
                                                                                    Pembatalan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    @if ($order->alasan == null)
                                                                                        <div class="text-sm text-danger"
                                                                                            style="font-style: italic">
                                                                                            Kosong
                                                                                        </div>
                                                                                    @else
                                                                                        {{ $order->alasan }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if ($order->status == 'Ditolak')
                                                                        <div class="col-md-4">
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark ">
                                                                                    Alasan
                                                                                    Penolakan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    @if ($order->alasan == null)
                                                                                        <div class="text-sm text-danger"
                                                                                            style="font-style: italic">
                                                                                            Kosong
                                                                                        </div>
                                                                                    @else
                                                                                        {{ $order->alasan }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
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

                                                <div class="modal fade modal-md"
                                                    id="cancelPesanan{{ $order->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalSignTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="card-body pb-3">
                                                                        <form role="form text-left" id="form-alasan"
                                                                            method="POST"
                                                                            action="/proses-tolak/{{ $order->id }}">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="example-text-input"
                                                                                            class="form-control-label"><span
                                                                                                class="text-xxs"
                                                                                                style="vertical-align: top;"><i
                                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                            Alasan Penolakan</label>
                                                                                        <input class="form-control"
                                                                                            type="text"
                                                                                            placeholder="Masukkan alasan"
                                                                                            name="alasan"
                                                                                            id="alasan">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <button
                                                                                            class="btn btn-sm ms-auto bg-gradient-danger"
                                                                                            type="submit"">Tolak
                                                                                            Pesanan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <script>
                                                                                // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                                function showcancelConfirmation() {
                                                                                    Swal.fire({
                                                                                        title: 'Konfirmasi',
                                                                                        text: 'Apakah Anda Yakin Ingin Membatalkan Pesanan?',
                                                                                        icon: 'warning',
                                                                                        showCancelButton: true,
                                                                                        confirmButtonText: 'Ya',
                                                                                        cancelButtonText: 'Batal',
                                                                                    }).then((result) => {
                                                                                        if (result.isConfirmed) {
                                                                                            document.getElementById('form-alasan').submit();
                                                                                        }
                                                                                    });
                                                                                }
                                                                            </script>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <script>
                                        $(document).ready(function() {
                                            var table2 = $('#permintaan_pes').DataTable({
                                                "pageLength": 5,
                                                "lengthMenu": [5, 10, 25, 50, 100],
                                                "order": [
                                                    [3, "desc"]
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
                                            $('#minRiwayat, #maxRiwayat').on('change', function() {
                                                var minTgl = $('#minRiwayat').val();
                                                var maxTgl = $('#maxRiwayat').val();

                                                console.log(minTgl, maxTgl);

                                                table2.columns(3).search('')
                                                    .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

                                                $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
                                                $.fn.dataTable.ext.search.push(
                                                    function(settings, data, dataIndex) {
                                                        var sekarang = new Date(data[
                                                            3]); // Mengambil nilai tanggal pada kolom keenam (indeks 3)
                                                        var pilih = new Date(minTgl);
                                                        if (isNaN(pilih.getTime()))
                                                            return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                                                        if (minTgl && !maxTgl) {
                                                            return sekarang >= pilih;
                                                        } else if (!minTgl && maxTgl) {
                                                            return sekarang <= new Date(maxTgl);
                                                        } else {
                                                            var tglAkhir = new Date(maxTgl);
                                                            tglAkhir.setDate(tglAkhir.getDate() + 1);
                                                            return sekarang > pilih && sekarang <= tglAkhir;
                                                        }
                                                    }
                                                );

                                                table2.draw();
                                            });

                                            // Reset filter saat salah satu input dikosongkan
                                            $('#minRiwayat, #maxRiwayat').on('keyup', function() {
                                                if ($('#minRiwayat').val() === '' && $('#maxRiwayat').val() === '') {
                                                    table.columns(3).search('').draw();
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="pesData" role="tabpanel"aria-labelledby="menus">
                        <div class="col-12">
                            <div class="card mb-4 mt-5">
                                <div class="card-header pb-0">
                                    <h6>Data Pesanan</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('export.pesanan', request()->query()) }}" method="GET"
                                        id="export-pesanan">
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
                                                        placeholder="yyyy-mm-dd" id="min" name="min"
                                                        data-input required>
                                                    @if ($errors->has('min '))
                                                        <span
                                                            class="text-danger text-xs">{{ $errors->first('min') }}</span>
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
                                                        placeholder="yyyy-mm-dd" id="max" name="max"
                                                        required>
                                                    @if ($errors->has('max'))
                                                        <span
                                                            class="text-danger text-xs">{{ $errors->first('max') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input"
                                                    class="form-control-label dateselect col-12"></label>
                                                <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                                    onclick="dataExport()">
                                                    <i class="text-sm fa-solid fa-file-excel"
                                                        style="margin-right: 10px"></i>Export to
                                                    Excel</a>
                                                <script>
                                                    // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                    function dataExport() {
                                                        document.getElementById('export-pesanan').submit();
                                                    }
                                                </script>
                                            </div>
                                            <script>
                                                $("#min, #max").flatpickr({
                                                    dateFormat: "Y-m-d"
                                                });
                                            </script>
                                        </div>
                                    </form>
                                    <hr class="horizontal dark">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="data_pes">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Jenis Menu</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Jumlah Porsi</th>
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
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $order->jenis_pesanan }}</span>
                                                        </td>
                                                        @php
                                                            $detail_menu = json_decode($order->makanan, true);
                                                            $detail_porsi = json_decode($order->jumlah_pesanan, true);
                                                            $total_porsi = array_sum($detail_porsi);
                                                            $kirim = json_decode($order->tanggal_pesanan, true);
                                                        @endphp

                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $total_porsi }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $order->name }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $kirim[0] }}
                                                                <b class="text-dark text-lg"> - </b>
                                                                {{ $kirim[1] }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            @if ($order->status == 'Selesai')
                                                                <span class="badge badge-sm bg-gradient-success"
                                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                            @endif
                                                            @if ($order->status == 'Menunggu')
                                                                <span class="badge badge-sm bg-gradient-warning"
                                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                            @endif
                                                            @if ($order->status == 'Diproses')
                                                                <span class="badge badge-sm bg-gradient-info"
                                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                            @endif
                                                            @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                                <span class="badge badge-sm bg-gradient-danger"
                                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle" style="text-align: center">
                                                            <a type="button"
                                                                class="fa-solid fa-eye text-s badge badge-md text-dark"
                                                                data-toggle="tooltip" data-original-title="Detail"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#detailPesanan{{ $order->order_id }}"
                                                                style="border: solid 1px">
                                                            </a>

                                                        </td>
                                                    </tr>

                                                    <div class="modal fade modal-xl "
                                                        id="detailPesanan{{ $order->order_id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content m-5">
                                                                <div class="d-flex modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">
                                                                        Detail
                                                                        Pesanan</h4>

                                                                    {{-- @if ($user->status == 'Aktif')
                                                                        <p class="badge badge-sm text-xxs bg-gradient-success m-1"
                                                                            style="width: 30%; height: 100%;">
                                                                            {{ $user->status }}</p>
                                                                    @else
                                                                        <p class="badge badge-sm text-xxs bg-gradient-danger"
                                                                            style="width: 30%; height: 100%;">
                                                                            {{ $user->status }}</p>
                                                                    @endif --}}
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex row">
                                                                        <div class="col md 6">
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Status
                                                                                    Pesanan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    @if ($order->status == 'Selesai')
                                                                                        <span
                                                                                            class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                                                                    @endif
                                                                                    @if ($order->status == 'Menunggu')
                                                                                        <span
                                                                                            class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                                                                    @endif
                                                                                    @if ($order->status == 'Diproses')
                                                                                        <span
                                                                                            class="badge badge-sm bg-gradient-info">{{ $order->status }}</span>
                                                                                    @endif
                                                                                    @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                                                        <span
                                                                                            class="badge badge-sm bg-gradient-danger">{{ $order->status }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Nama Pemesan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $order->name }}
                                                                                </p>

                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg  text-dark">
                                                                                    Jenis Menu
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $order->jenis_pesanan }}
                                                                                </p>
                                                                            </div>
                                                                            @php

                                                                                $kirim = json_decode($order->tanggal_pesanan, true);
                                                                                foreach ($kirim as $tglPess) {
                                                                                    $tgl[] = \Carbon\Carbon::parse($tglPess);
                                                                                }
                                                                                $waktu = \Carbon\Carbon::parse($order->waktu_pesanan);
                                                                                $num = 1;
                                                                            @endphp

                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Tanggal
                                                                                    Pemesanan</p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $order->created_at->isoFormat('DD MMMM Y') }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Tanggal
                                                                                    Pengiriman
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $tgl[0]->isoFormat('DD MMM Y') }}
                                                                                    -
                                                                                    {{ $tgl[1]->isoFormat('DD MMM Y') }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Jam
                                                                                    Pengiriman
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $waktu->format('h:i A') }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Lokasi
                                                                                    Pengantaran
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $order->lokasi_pengantaran }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Nama Peserta
                                                                                </p>
                                                                                @php
                                                                                    $data_peserta = explode(',', $order->detail_karyawan);
                                                                                @endphp

                                                                                @foreach ($data_peserta as $item)
                                                                                    {{ $item }} <br>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6" style="margin-left: 5%">
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                    Menu Makanan
                                                                                </p>
                                                                                <div
                                                                                    style="max-height: 300px; overflow-y: auto;">
                                                                                    @if ($order->jenis_pesanan == 'Menu Spesial')
                                                                                        @php
                                                                                            $menu = json_decode($order->id_menu, true);
                                                                                            $menus = Menu::whereIn('id', $menu)->get();
                                                                                            $k = 0;
                                                                                            $i = 0;

                                                                                        @endphp
                                                                                        @foreach ($menus as $namaMenu)
                                                                                            @php
                                                                                                $indeksMenu = 0;
                                                                                                $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                                $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                            @endphp
                                                                                            <b
                                                                                                class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                            <br>

                                                                                            <span class="text-muted"
                                                                                                style="margin-bottom: 7%">
                                                                                                <p class="text-sm"
                                                                                                    style="margin-bottom: auto">
                                                                                                    1,5
                                                                                                    Main Course</p>
                                                                                                <b
                                                                                                    class="">{{ $nmakanan[0] }}</b>
                                                                                                :
                                                                                                <b
                                                                                                    class="">{{ $detail_porsi[$i] }}</b>
                                                                                                porsi
                                                                                                <br>
                                                                                                @php
                                                                                                    $k++;
                                                                                                    $i++;
                                                                                                @endphp
                                                                                                <p class="text-sm"
                                                                                                    style="margin-bottom: auto">
                                                                                                    2,5
                                                                                                    Main Course</p>
                                                                                                <b
                                                                                                    class="">{{ $nmakanan[1] }}</b>
                                                                                                :
                                                                                                <b
                                                                                                    class="">{{ $detail_porsi[$i] }}</b>
                                                                                                porsi
                                                                                                <br>
                                                                                                @php
                                                                                                    $k++;
                                                                                                    $i++;
                                                                                                @endphp
                                                                                            </span>
                                                                                            <br>
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @if ($order->jenis_pesanan == 'Snack')
                                                                                        @php
                                                                                            $menu = json_decode($order->id_menu, true);
                                                                                            $menus = Menu::whereIn('id', $menu)
                                                                                                ->orderBy('tanggal_berlaku', 'asc')
                                                                                                ->get();
                                                                                            $k = 0;
                                                                                            $i = 0;
                                                                                        @endphp

                                                                                        @foreach ($menus as $namaMenu)
                                                                                            @php
                                                                                                $indeksMenu = 0;
                                                                                                $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                                $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                            @endphp
                                                                                            <b
                                                                                                class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                            <br>
                                                                                            @foreach ($nmakanan as $nm)
                                                                                                <span
                                                                                                    class="text-muted mb-5">
                                                                                                    <b
                                                                                                        class="text-dark">{{ $nm }}</b>
                                                                                                    :
                                                                                                    <b
                                                                                                        class="text-dark">{{ $detail_porsi[$i] }}</b>
                                                                                                    porsi
                                                                                                </span>
                                                                                                @if (count($detail_porsi) == 1)
                                                                                                @else
                                                                                                    @if ($i < count($detail_porsi) - 1)
                                                                                                        <br>
                                                                                                    @else
                                                                                                    @endif
                                                                                                @endif
                                                                                                @php
                                                                                                    $k++;
                                                                                                    $i++;
                                                                                                @endphp
                                                                                            @endforeach
                                                                                            <br>
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @if ($order->jenis_pesanan == 'Others')
                                                                                        @php
                                                                                            $kirim = json_decode($order->tanggal_pesanan, true);
                                                                                            $tanggalAwal = new DateTime($kirim[0]);
                                                                                            $tanggalAkhir = new DateTime($kirim[1]);

                                                                                            $tanggalAkhir->modify('+1 day');

                                                                                            $interval = new DateInterval('P1D'); // Interval 1 hari
                                                                                            $daterange = new DatePeriod($tanggalAwal, $interval, $tanggalAkhir);
                                                                                            $k = 0;
                                                                                            $i = 0;
                                                                                            $namaMakanan = json_decode($order->makanan, true);
                                                                                        @endphp

                                                                                        @foreach ($daterange as $tglPes)
                                                                                            @php
                                                                                                $indeksMenu = 0;
                                                                                                $tanggalPes = $tglPes->format('Y-m-d');
                                                                                                $pesanDate = \Carbon\Carbon::parse($tanggalPes);
                                                                                                // $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                                // $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                            @endphp
                                                                                            <b
                                                                                                class="text-dark">{{ $pesanDate->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                            <br>
                                                                                            <span
                                                                                                class="text-muted mb-5">
                                                                                                <b
                                                                                                    class="text-dark">{{ $namaMakanan[$i] }}</b>
                                                                                                :
                                                                                                <b
                                                                                                    class="text-dark">{{ $detail_porsi[$k] }}</b>
                                                                                                porsi
                                                                                            </span>
                                                                                            @if (count($detail_porsi) == 1)
                                                                                            @else
                                                                                                @if ($k < count($detail_porsi) - 1)
                                                                                                    <br>
                                                                                                @else
                                                                                                @endif
                                                                                            @endif
                                                                                            @php
                                                                                                $k++;
                                                                                                $i++;
                                                                                            @endphp
                                                                                            <br>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr class="horizontal dark">
                                                                        <div class="col-md-4">
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark ">
                                                                                    Alasan
                                                                                    Pemesanan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    {{ $order->alasan_pemesanan }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="justify-content-between mb-3">
                                                                                <p
                                                                                    class="fw-bold mb-0 text-lg text-dark ">
                                                                                    Catatan
                                                                                    Pemesanan
                                                                                </p>
                                                                                <p class="text-muted mb-0 text-md">
                                                                                    @if ($order->catatan == null)
                                                                                        <div class="text-sm text-danger"
                                                                                            style="font-style: italic">
                                                                                            Kosong
                                                                                        </div>
                                                                                    @else
                                                                                        {{ $order->catatan }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        @if ($order->status == 'Dibatalkan')
                                                                            <div class="col-md-4">
                                                                                <div
                                                                                    class="justify-content-between mb-3">
                                                                                    <p
                                                                                        class="fw-bold mb-0 text-lg text-dark ">
                                                                                        Alasan
                                                                                        Pembatalan
                                                                                    </p>
                                                                                    <p class="text-muted mb-0 text-md">
                                                                                        @if ($order->alasan == null)
                                                                                            <div class="text-sm text-danger"
                                                                                                style="font-style: italic">
                                                                                                Kosong
                                                                                            </div>
                                                                                        @else
                                                                                            {{ $order->alasan }}
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if ($order->status == 'Ditolak')
                                                                            <div class="col-md-4">
                                                                                <div
                                                                                    class="justify-content-between mb-3">
                                                                                    <p
                                                                                        class="fw-bold mb-0 text-lg text-dark ">
                                                                                        Alasan
                                                                                        Penolakan
                                                                                    </p>
                                                                                    <p class="text-muted mb-0 text-md">
                                                                                        @if ($order->alasan == null)
                                                                                            <div class="text-sm text-danger"
                                                                                                style="font-style: italic">
                                                                                                Kosong
                                                                                            </div>
                                                                                        @else
                                                                                            {{ $order->alasan }}
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endif
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

                                                    <div class="modal fade modal-md"
                                                        id="cancelPesanan{{ $order->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalSignTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-0">
                                                                    <div class="card card-plain">
                                                                        <div class="card-body pb-3">
                                                                            <form role="form text-left"
                                                                                id="form-alasan" method="POST"
                                                                                action="/cancel-pesanan/{{ $order->id }}">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="example-text-input"
                                                                                                class="form-control-label"><span
                                                                                                    class="text-xxs"
                                                                                                    style="vertical-align: top;"><i
                                                                                                        class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                                Alasan Penolakan</label>
                                                                                            <input class="form-control"
                                                                                                type="text"
                                                                                                placeholder="Masukkan alasan"
                                                                                                name="alasan"
                                                                                                id="alasan">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div
                                                                                            class="d-flex align-items-center">
                                                                                            <button
                                                                                                class="btn btn-sm ms-auto bg-gradient-danger"
                                                                                                type="submit"">Batalkan
                                                                                                Pesanan</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <script>
                                                                                    // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                                    function showcancelConfirmation() {
                                                                                        Swal.fire({
                                                                                            title: 'Konfirmasi',
                                                                                            text: 'Apakah Anda Yakin Ingin Membatalkan Pesanan?',
                                                                                            icon: 'warning',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonText: 'Ya',
                                                                                            cancelButtonText: 'Batal',
                                                                                        }).then((result) => {
                                                                                            if (result.isConfirmed) {
                                                                                                document.getElementById('form-alasan').submit();
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                </script>
                                                                            </form>
                                                                        </div>
                                                                    </div>
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
@endif
@if(Auth::user()->id_role == 3)
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12">
                <div class="card mb-4 mt-5">
                    <div class="card-header pb-0">
                        <h6>Data Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('export.pesanan', request()->query()) }}" method="GET"
                            id="export-pesanan">
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
                                            placeholder="yyyy-mm-dd" id="min" name="min"
                                            data-input required>
                                        @if ($errors->has('min '))
                                            <span
                                                class="text-danger text-xs">{{ $errors->first('min') }}</span>
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
                                            placeholder="yyyy-mm-dd" id="max" name="max"
                                            required>
                                        @if ($errors->has('max'))
                                            <span
                                                class="text-danger text-xs">{{ $errors->first('max') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="example-text-input"
                                        class="form-control-label dateselect col-12"></label>
                                    <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                        onclick="dataExport()">
                                        <i class="text-sm fa-solid fa-file-excel"
                                            style="margin-right: 10px"></i>Export to
                                        Excel</a>
                                    <script>
                                        // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                        function dataExport() {
                                            document.getElementById('export-pesanan').submit();
                                        }
                                    </script>
                                </div>
                                <script>
                                    $("#min, #max").flatpickr({
                                        dateFormat: "Y-m-d"
                                    });
                                </script>
                            </div>
                        </form>
                        <hr class="horizontal dark">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="data_pes">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jenis Menu</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah Porsi</th>
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
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $order->jenis_pesanan }}</span>
                                            </td>
                                            @php
                                                $detail_menu = json_decode($order->makanan, true);
                                                $detail_porsi = json_decode($order->jumlah_pesanan, true);
                                                $total_porsi = array_sum($detail_porsi);
                                                $kirim = json_decode($order->tanggal_pesanan, true);
                                            @endphp

                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $total_porsi }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $order->name }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $kirim[0] }}
                                                    <b class="text-dark text-lg"> - </b>
                                                    {{ $kirim[1] }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($order->status == 'Selesai')
                                                    <span class="badge badge-sm bg-gradient-success"
                                                        style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                @endif
                                                @if ($order->status == 'Menunggu')
                                                    <span class="badge badge-sm bg-gradient-warning"
                                                        style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                @endif
                                                @if ($order->status == 'Diproses')
                                                    <span class="badge badge-sm bg-gradient-info"
                                                        style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                @endif
                                                @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                    <span class="badge badge-sm bg-gradient-danger"
                                                        style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle" style="text-align: center">
                                                <a type="button"
                                                    class="fa-solid fa-eye text-s badge badge-md text-dark"
                                                    data-toggle="tooltip" data-original-title="Detail"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailPesanan{{ $order->order_id }}"
                                                    style="border: solid 1px">
                                                </a>

                                            </td>
                                        </tr>

                                        <div class="modal fade modal-xl "
                                            id="detailPesanan{{ $order->order_id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered"
                                                role="document">
                                                <div class="modal-content m-5">
                                                    <div class="d-flex modal-header">
                                                        <h4 class="modal-title" id="exampleModalLabel">
                                                            Detail
                                                            Pesanan</h4>

                                                        {{-- @if ($user->status == 'Aktif')
                                                            <p class="badge badge-sm text-xxs bg-gradient-success m-1"
                                                                style="width: 30%; height: 100%;">
                                                                {{ $user->status }}</p>
                                                        @else
                                                            <p class="badge badge-sm text-xxs bg-gradient-danger"
                                                                style="width: 30%; height: 100%;">
                                                                {{ $user->status }}</p>
                                                        @endif --}}
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex row">
                                                            <div class="col md 6">
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Status
                                                                        Pesanan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        @if ($order->status == 'Selesai')
                                                                            <span
                                                                                class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                                                        @endif
                                                                        @if ($order->status == 'Menunggu')
                                                                            <span
                                                                                class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                                                        @endif
                                                                        @if ($order->status == 'Diproses')
                                                                            <span
                                                                                class="badge badge-sm bg-gradient-info">{{ $order->status }}</span>
                                                                        @endif
                                                                        @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                                            <span
                                                                                class="badge badge-sm bg-gradient-danger">{{ $order->status }}</span>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Nama Pemesan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $order->name }}
                                                                    </p>

                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg  text-dark">
                                                                        Jenis Menu
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $order->jenis_pesanan }}
                                                                    </p>
                                                                </div>
                                                                @php

                                                                    $kirim = json_decode($order->tanggal_pesanan, true);
                                                                    foreach ($kirim as $tglPess) {
                                                                        $tgl[] = \Carbon\Carbon::parse($tglPess);
                                                                    }
                                                                    $waktu = \Carbon\Carbon::parse($order->waktu_pesanan);
                                                                    $num = 1;
                                                                @endphp

                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Tanggal
                                                                        Pemesanan</p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $order->created_at->isoFormat('DD MMMM Y') }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Tanggal
                                                                        Pengiriman
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $tgl[0]->isoFormat('DD MMM Y') }}
                                                                        -
                                                                        {{ $tgl[1]->isoFormat('DD MMM Y') }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Jam
                                                                        Pengiriman
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $waktu->format('h:i A') }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Lokasi
                                                                        Pengantaran
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $order->lokasi_pengantaran }}
                                                                    </p>
                                                                </div>
                                                                <div class="justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Nama Peserta
                                                                    </p>
                                                                    @php
                                                                        $data_peserta = explode(',', $order->detail_karyawan);
                                                                    @endphp

                                                                    @foreach ($data_peserta as $item)
                                                                        {{ $item }} <br>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" style="margin-left: 5%">
                                                                <div class="justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark">
                                                                        Menu Makanan
                                                                    </p>
                                                                    <div
                                                                        style="max-height: 300px; overflow-y: auto;">
                                                                        @if ($order->jenis_pesanan == 'Menu Spesial')
                                                                            @php
                                                                                $menu = json_decode($order->id_menu, true);
                                                                                $menus = Menu::whereIn('id', $menu)->get();
                                                                                $k = 0;
                                                                                $i = 0;

                                                                            @endphp
                                                                            @foreach ($menus as $namaMenu)
                                                                                @php
                                                                                    $indeksMenu = 0;
                                                                                    $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                    $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                @endphp
                                                                                <b
                                                                                    class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                <br>

                                                                                <span class="text-muted"
                                                                                    style="margin-bottom: 7%">
                                                                                    <p class="text-sm"
                                                                                        style="margin-bottom: auto">
                                                                                        1,5
                                                                                        Main Course</p>
                                                                                    <b
                                                                                        class="">{{ $nmakanan[0] }}</b>
                                                                                    :
                                                                                    <b
                                                                                        class="">{{ $detail_porsi[$i] }}</b>
                                                                                    porsi
                                                                                    <br>
                                                                                    @php
                                                                                        $k++;
                                                                                        $i++;
                                                                                    @endphp
                                                                                    <p class="text-sm"
                                                                                        style="margin-bottom: auto">
                                                                                        2,5
                                                                                        Main Course</p>
                                                                                    <b
                                                                                        class="">{{ $nmakanan[1] }}</b>
                                                                                    :
                                                                                    <b
                                                                                        class="">{{ $detail_porsi[$i] }}</b>
                                                                                    porsi
                                                                                    <br>
                                                                                    @php
                                                                                        $k++;
                                                                                        $i++;
                                                                                    @endphp
                                                                                </span>
                                                                                <br>
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($order->jenis_pesanan == 'Snack')
                                                                            @php
                                                                                $menu = json_decode($order->id_menu, true);
                                                                                $menus = Menu::whereIn('id', $menu)
                                                                                    ->orderBy('tanggal_berlaku', 'asc')
                                                                                    ->get();
                                                                                $k = 0;
                                                                                $i = 0;
                                                                            @endphp

                                                                            @foreach ($menus as $namaMenu)
                                                                                @php
                                                                                    $indeksMenu = 0;
                                                                                    $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                    $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                @endphp
                                                                                <b
                                                                                    class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                <br>
                                                                                @foreach ($nmakanan as $nm)
                                                                                    <span
                                                                                        class="text-muted mb-5">
                                                                                        <b
                                                                                            class="text-dark">{{ $nm }}</b>
                                                                                        :
                                                                                        <b
                                                                                            class="text-dark">{{ $detail_porsi[$i] }}</b>
                                                                                        porsi
                                                                                    </span>
                                                                                    @if (count($detail_porsi) == 1)
                                                                                    @else
                                                                                        @if ($i < count($detail_porsi) - 1)
                                                                                            <br>
                                                                                        @else
                                                                                        @endif
                                                                                    @endif
                                                                                    @php
                                                                                        $k++;
                                                                                        $i++;
                                                                                    @endphp
                                                                                @endforeach
                                                                                <br>
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($order->jenis_pesanan == 'Others')
                                                                            @php
                                                                                $kirim = json_decode($order->tanggal_pesanan, true);
                                                                                $tanggalAwal = new DateTime($kirim[0]);
                                                                                $tanggalAkhir = new DateTime($kirim[1]);

                                                                                $tanggalAkhir->modify('+1 day');

                                                                                $interval = new DateInterval('P1D'); // Interval 1 hari
                                                                                $daterange = new DatePeriod($tanggalAwal, $interval, $tanggalAkhir);
                                                                                $k = 0;
                                                                                $i = 0;
                                                                                $namaMakanan = json_decode($order->makanan, true);
                                                                            @endphp

                                                                            @foreach ($daterange as $tglPes)
                                                                                @php
                                                                                    $indeksMenu = 0;
                                                                                    $tanggalPes = $tglPes->format('Y-m-d');
                                                                                    $pesanDate = \Carbon\Carbon::parse($tanggalPes);
                                                                                    // $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                    // $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                                @endphp
                                                                                <b
                                                                                    class="text-dark">{{ $pesanDate->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                                <br>
                                                                                <span
                                                                                    class="text-muted mb-5">
                                                                                    <b
                                                                                        class="text-dark">{{ $namaMakanan[$i] }}</b>
                                                                                    :
                                                                                    <b
                                                                                        class="text-dark">{{ $detail_porsi[$k] }}</b>
                                                                                    porsi
                                                                                </span>
                                                                                @if (count($detail_porsi) == 1)
                                                                                @else
                                                                                    @if ($k < count($detail_porsi) - 1)
                                                                                        <br>
                                                                                    @else
                                                                                    @endif
                                                                                @endif
                                                                                @php
                                                                                    $k++;
                                                                                    $i++;
                                                                                @endphp
                                                                                <br>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="horizontal dark">
                                                            <div class="col-md-4">
                                                                <div class="justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark ">
                                                                        Alasan
                                                                        Pemesanan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        {{ $order->alasan_pemesanan }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="justify-content-between mb-3">
                                                                    <p
                                                                        class="fw-bold mb-0 text-lg text-dark ">
                                                                        Catatan
                                                                        Pemesanan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        @if ($order->catatan == null)
                                                                            <div class="text-sm text-danger"
                                                                                style="font-style: italic">
                                                                                Kosong
                                                                            </div>
                                                                        @else
                                                                            {{ $order->catatan }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @if ($order->status == 'Dibatalkan')
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="justify-content-between mb-3">
                                                                        <p
                                                                            class="fw-bold mb-0 text-lg text-dark ">
                                                                            Alasan
                                                                            Pembatalan
                                                                        </p>
                                                                        <p class="text-muted mb-0 text-md">
                                                                            @if ($order->alasan == null)
                                                                                <div class="text-sm text-danger"
                                                                                    style="font-style: italic">
                                                                                    Kosong
                                                                                </div>
                                                                            @else
                                                                                {{ $order->alasan }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($order->status == 'Ditolak')
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="justify-content-between mb-3">
                                                                        <p
                                                                            class="fw-bold mb-0 text-lg text-dark ">
                                                                            Alasan
                                                                            Penolakan
                                                                        </p>
                                                                        <p class="text-muted mb-0 text-md">
                                                                            @if ($order->alasan == null)
                                                                                <div class="text-sm text-danger"
                                                                                    style="font-style: italic">
                                                                                    Kosong
                                                                                </div>
                                                                            @else
                                                                                {{ $order->alasan }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
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

                                        <div class="modal fade modal-md"
                                            id="cancelPesanan{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalSignTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-body pb-3">
                                                                <form role="form text-left"
                                                                    id="form-alasan" method="POST"
                                                                    action="/cancel-pesanan/{{ $order->id }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="example-text-input"
                                                                                    class="form-control-label"><span
                                                                                        class="text-xxs"
                                                                                        style="vertical-align: top;"><i
                                                                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                    Alasan Penolakan</label>
                                                                                <input class="form-control"
                                                                                    type="text"
                                                                                    placeholder="Masukkan alasan"
                                                                                    name="alasan"
                                                                                    id="alasan">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div
                                                                                class="d-flex align-items-center">
                                                                                <button
                                                                                    class="btn btn-sm ms-auto bg-gradient-danger"
                                                                                    type="submit"">Batalkan
                                                                                    Pesanan</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                        function showcancelConfirmation() {
                                                                            Swal.fire({
                                                                                title: 'Konfirmasi',
                                                                                text: 'Apakah Anda Yakin Ingin Membatalkan Pesanan?',
                                                                                icon: 'warning',
                                                                                showCancelButton: true,
                                                                                confirmButtonText: 'Ya',
                                                                                cancelButtonText: 'Batal',
                                                                            }).then((result) => {
                                                                                if (result.isConfirmed) {
                                                                                    document.getElementById('form-alasan').submit();
                                                                                }
                                                                            });
                                                                        }
                                                                    </script>
                                                                </form>
                                                            </div>
                                                        </div>
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
@endif


    <script>
        $(document).ready(function() {
            var table = $('#data_pes').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "order": [
                    [3, "desc"]
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
            $('#min, #max').on('change', function() {
                var minDate = $('#min').val();
                var maxDate = $('#max').val();

                table.columns(3).search('')
                    .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

                $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var currentDate = new Date(data[
                            3]); // Mengambil nilai tanggal pada kolom keenam (indeks 3)
                        console.log(currentDate);
                        var selectedDate = new Date(minDate);
                        if (isNaN(selectedDate.getTime()))
                            return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                        if (minDate && !maxDate) {
                            return currentDate >= selectedDate;
                        } else if (!minDate && maxDate) {
                            return currentDate <= new Date(maxDate);
                        } else {
                            var endDate = new Date(maxDate);
                            endDate.setDate(endDate.getDate() + 1);
                            return currentDate > selectedDate && currentDate <= endDate;
                        }
                    }
                );

                table.draw();
            });

            // Reset filter saat salah satu input dikosongkan
            $('#min, #max').on('keyup', function() {
                if ($('#min').val() === '' && $('#max').val() === '') {
                    table.columns(5).search('').draw();
                }
            });

            var table2 = $('#riwayat_pes').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "order": [
                    [5, "desc"]
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
            $('#minRiwayat, #maxRiwayat').on('change', function() {
                var minTgl = $('#minRiwayat').val();
                var maxTgl = $('#maxRiwayat').val();

                console.log(minTgl, maxTgl);

                table2.columns(4).search('')
                    .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

                $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var sekarang = new Date(data[
                            3]); // Mengambil nilai tanggal pada kolom keenam (indeks 3)
                        var pilih = new Date(minTgl);
                        if (isNaN(pilih.getTime()))
                            return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                        if (minTgl && !maxTgl) {
                            return sekarang >= pilih;
                        } else if (!minTgl && maxTgl) {
                            return sekarang <= new Date(maxTgl);
                        } else {
                            var tglAkhir = new Date(maxTgl);
                            tglAkhir.setDate(tglAkhir.getDate() + 1);
                            return sekarang > pilih && sekarang <= tglAkhir;
                        }
                    }
                );

                table.draw();
            });

            // Reset filter saat salah satu input dikosongkan
            $('#minRiwayat, #maxRiwayat').on('keyup', function() {
                if ($('#minRiwayat').val() === '' && $('#maxRiwayat').val() === '') {
                    table.columns(3).search('').draw();
                }
            });
        });
    </script>
